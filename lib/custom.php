<?php
// Custom functions
class themeslug_walker_nav_menu extends Walker_Nav_Menu {
  
// add classes to ul sub-menus
function start_lvl( &$output, $depth ) {
    // depth dependent classes
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array(
        'sub-menu',
        ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
        ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
        'menu-depth-' . $display_depth
        );
    $class_names = implode( ' ', $classes );
  
    // build html
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}
  
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth, $args ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
  
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'menu-block' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
  
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
  
    // build html
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
  
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
  
    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

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