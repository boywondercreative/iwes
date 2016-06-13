<?php
function the_slug() {
    $post_data = get_post($post->ID, ARRAY_A);
    $slug = $post_data['post_name'];
    return $slug; 
}
function clean_wp_list_pages($menu) {
    // Remove redundant title attributes
    $menu = remove_title_attributes($menu);
    // Remove protocol and domain name from href values
    $menu = make_href_root_relative($menu);
    // Give the list items containing the current item or one of its ancestors a class name
    $menu = preg_replace('/class="(.*?)current_page(.*?)"/','class="sel"',$menu);
    // Remove all other class names
    $menu = preg_replace('/ class=(["\'])(?!sel).*?\1/','',$menu);
    // Give the current link and the links to its ancestors a class name and wrap their content in a strong element
    $menu = preg_replace('/class="sel"><a(.*?)>(.*?)<\/a>/','class="sel"><a$1 class="sel"><strong>$2</strong></a>',$menu);
    return $menu;
}
add_filter( 'wp_list_pages', 'clean_wp_list_pages' );

function remove_title_attributes($input) {
    return preg_replace('/\s*title\s*=\s*(["\']).*?\1/', '', $input);
}
add_filter( 'wp_list_pages', 'remove_title_attributes' );


function make_href_root_relative($input) {
    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}

function root_relative_permalinks($input) {
    return make_href_root_relative($input);
}
add_filter( 'the_permalink', 'root_relative_permalinks' );

class Clean_Walker extends Walker_Page {
    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }
    function start_el(&$output, $page, $depth, $args, $current_page) {
        if ( $depth )
            $indent = str_repeat("\t", $depth);
        else
            $indent = '';
        extract($args, EXTR_SKIP);
        $class_attr = '';
        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( (isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors)) || ( $page->ID == $current_page ) || ( $_current_page && $page->ID == $_current_page->post_parent ) ) {
                $class_attr = 'sel';
            }
        } elseif ( (is_single() || is_archive()) && ($page->ID == get_option('page_for_posts')) ) {
            $class_attr = 'sel';
        }
        if ( $class_attr != '' ) {
            $class_attr = ' class="' . $class_attr . '"';
            $link_before .= '<strong>';
            $link_after = '</strong>' . $link_after;
        }
        $output .= $indent . '<li' . $class_attr . '><a href="' . make_href_root_relative(get_page_link($page->ID)) . '"' . $class_attr . '>' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';

        if ( !empty($show_date) ) {
            if ( 'modified' == $show_date )
                $time = $page->post_modified;
            else
                $time = $page->post_date;
            $output .= " " . mysql2date($date_format, $time);
        }
    }
}


function rh_get_page_id($name)
{
global $wpdb;
// get page id using custom query
$page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE ( post_name = '".$name."' or post_title = '".$name."' ) and post_status = 'publish' and post_type='page' ");
return $page_id;
}


function rh_get_page_permalink($name)
{
$page_id = rh_get_page_id($name);
return get_permalink($page_id);
}


function wp_list_pages_with_hash( $hash, $args = '' )
{
    $add_hash = create_function( '$link', 'return $link . "#' . $hash . '";' );
    add_filter( 'page_link', $add_hash );
    $result = wp_list_pages( $args );
    remove_filter( 'page_link', $add_hash );
    return $result; // back compat in case 'echo' was null  
}
function wordpress_breadcrumbs() {
  $delimiter = '|';
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div id="crumbs">';
    global $post;
	if ( is_page() && !$post->post_parent ) {
		echo $currentBefore;
		the_title();
		echo $currentAfter; }
	elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    }
    echo '</div>';
  }
}
//-------------------------------------------------------------
// pagesRecursive
//   lists pages of a WP recursively
//-------------------------------------------------------------
function pagesRecursive($parentId, $lvl){ 
	$args=array('child_of' => $parentId, 'parent' => $parentId);
	$pages = get_pages($args); 
	if ($pages) {
		$lvl ++;
		foreach ($pages as $page) {
			print "<div style='margin-left:".($lvl * 30)."; border:solid 1px #000; margin-bottom:10px; '>";
			print $page->ID."<br>";
			print $page->post_date."<br>";
			print $page->post_title."<br>";
			print $page->post_content."<br>";
			print "</div>";
			pagesRecursive($page->ID, $lvl);
		} 
	}
}
pagesRecursive(20, 0);

// Custom functions
function wt_get_ID_by_page_name($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_id;
}
//function get_second_topmost_parent($post_id){
//	$post = get_post($post_id); // get post data
//	$parent_post_id = $post->post_parent; // get posts parent
//	$second_post = get_post($parent_post_id); //get post data of parent
//	$second_parent_post_id = $second_post->post_parent; // get parent of parent
// 
//	if ($second_parent_post_id == 0){
//		// if parent of parent has root id of 0, current page is a grandchild, return id
//		return $post_id;
//	} else {
//		return get_second_topmost_parent($second_parent_post_id);
//	}
//}
///***************************************
// * How to add .pdf support to the WordPress media manager
// * http://www.wprecipes.com/how-to-add-pdf-support-to-the-wordpress-media-manager
//***************************************/
function modify_post_mime_types( $post_mime_types ) {

	// select the mime type, here: 'application/pdf'
	// then we define an array with the label values

	$post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );

	// then we return the $post_mime_types variable
	return $post_mime_types;

}

// Add Filter Hook
add_filter( 'post_mime_types', 'modify_post_mime_types' );



///***************************************
// * DEQUEUE RESPONSIVE STYLESHEET
// *
//***************************************/
//add_action('wp_enqueue_scripts', 'myacronym_enqueue_scripts', 101); 
//// take note of priority
//function myacronym_enqueue_scripts() {
// wp_dequeue_style('roots_bootstrap_responsive');
//}

/***************************************
 * ENABLE POST FORMATS
 *
***************************************/
add_theme_support('post-formats', array('aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio'));

/***************************************
 * REMOVES P TAG FROM IMAGES
 *
***************************************/
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

//ALLOWS WIDGETS TO OUTPUT SHORTCODES
add_filter('widget_text', 'do_shortcode');

//CATCH THAT IMAGE
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "/images/default.jpg";
  }
  return $first_img;
}

/**
 * THIS SCANS FOR IMAGES IN A POST, IF NONE, HIDES ALT TAG
 **/
function image_scan( $args = array() ) {if ( !$post_id  )
global $post;
preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );

if ( isset( $matches ) ) $image = $matches[1][0];

if ( $matches[1][0] )
return array( 'image' => $image );
else
return false;
}

/**
 * Sets the post excerpt length to 40 characters.
 **/
function yoko_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'yoko_excerpt_length' );


// custom excerpt ellipses for 2.9+
function custom_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');


function fix_custom_fields_in_wp342() {
	global $wp_version, $hook_suffix;

	if ( '3.4.2' == $wp_version && in_array( $hook_suffix, array( 'post.php', 'post-new.php' ) ) ) : ?>
<script type="text/javascript">
jQuery(document).delegate( '#addmetasub, #updatemeta', 'hover focus', function() {
	jQuery(this).attr('id', 'meta-add-submit');
});
</script>
<?php
	endif;
}
add_action( 'admin_print_footer_scripts', 'fix_custom_fields_in_wp342' );

function my_admin_print_footer_scripts() { 	?>

<script type="text/javascript">

/* <![CDATA[ */

		
			jQuery(document).ready(function($) {

				
			/*
			 * Upload function
			 */
			 
			 
			var form_src, form_alt, form_id, button, tbframe_interval;
			

			$('.my_meta_control').delegate('.upload_image_button','click', function() { 
				form_src = $(this).prevAll('input.image_src');
				form_alt = $(this).prevAll('input.image_alt');
				form_id = $(this).prevAll('input.image_id');
								
				button = $(this);
				
				tbframe_interval = setInterval(function() {
					//change button text
					$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
					//remove url, alignment and size fields- auto set to null, none and full respectively
					$('#TB_iframeContent').contents().find('.url').hide().find('input').val('');
					$('#TB_iframeContent').contents().find('.align').hide().find('input:radio').filter('[value="none"]').attr('checked', true);
					$('#TB_iframeContent').contents().find('.image-size').hide().find('input:radio').filter('[value="full"]').attr('checked', true);
				}, 2000);
				tb_show('', 'media-upload.php?type=image&tab=type&TB_iframe=true');
				//tb_show('', 'media-upload.php?type=image&TB_iframe=true');
				return false;
			});

			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html){
				clearInterval(tbframe_interval);
				if (form_src) {
				
					//if image links somewhere then the img node will be a child of the returned html
					if ( $(html).children().length > 0)	{ 
						src = $('img',html).attr('src');
						imgclass = $('img',html).attr('class');
						alt = $('img',html).attr('alt');
						href = $('a',html).attr('href');
					} else { //img node IS the returned html
						src = $(html).attr('src');
						imgclass = $(html).attr('class');
						alt = $(html).attr('alt');
					}
					
					if(typeof imgclass != 'undefined') {
					var imageID = imgclass.match(/([0-9]+)/i);
						imageID = (imageID && imageID[1]) ? imageID[1] : '' ;
					}
						
					var url = src ? src : href ;
								
					form_src.val(url);
					form_alt.val(alt);
					form_id.val(imageID);
					form_src.prevAll('.preview_wrap').children('img').attr('src',url).fadeIn();
					button.html('<span class="icon change"></span><?php _e('Change Image');?>').next('.delete_image_button').fadeIn();
					tb_remove();
					form_src = ''; //reset form_src to null so original works
				} else {
					window.original_send_to_editor(html);
				}
			};

			
			/*
			 * Remove Function
			 */
			 
		
			$('.my_meta_control').delegate('.delete_image_button','click', function() {
				form_src = $(this).prevAll('input.image_src').val('');
				form_alt = $(this).prevAll('input.image_alt').val('');
				form_id = $(this).prevAll('input.image_id').val('');
				
				var img = form_src.prevAll('.preview_wrap').children('img');
				
				if( img.hasClass('photo')){
					img.attr('src','<?php echo WPALCHEMY; ?>/images/default_photo.png').fadeIn();
				} else {
					img.attr('src','<?php echo WPALCHEMY; ?>/images/default_preview.png').fadeIn();
				}
				
				$(this).prev().html('<span class="icon upload"></span><?php _e('Upload Image');?>');
				$(this).fadeOut();
				return false;
			});
			
			$('.slide_preview').each(function(){
				var src = $(this).find('.image_src').val();
				if(src) { $(this).find('.delete_image_button').show(); } else { $(this).find('.delete_image_button').hide(); }
			});
	
			
			}); //end doc ready

	
			
		/* ]]> */</script><?php
	}
	
//only load on pages and posts!
add_action('admin_footer-post.php','my_admin_print_footer_scripts',99);
?>