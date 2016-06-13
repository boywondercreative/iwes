<?php
/*
Template Name: Media Page
*/
?>

<?php /*?><?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?><?php */?>
<div id="page">
	<?php include (TEMPLATEPATH . '/pageheader.php'); ?>
    <div class="half post_behave">

<?php
$catname = wp_title('', false);
$new_query = new WP_Query();
$new_query->query('category_name=press&showposts=10'.'&paged='.$paged);
?>

<?php while ($new_query->have_posts()) : $new_query->the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="byline">
								<?php $key = get_post_meta($post->ID, '_format_quote_source_name', true);
                                if ($key != '') {
                                      echo 'Written by<span class="italics">' .$key . '</span>';
                                } else {}?>
                                
                                <?php
                                $key = get_post_meta($post->ID, '_format_quote_source_url', true);
                                if ($key != '') {
                                      echo 'for<span class="italics">' .$key .'</span>';
                                   } else {
                                     
                                   }
                                ?>
                            </p>
                        </header>
                        
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    
                        <ul class="press-links">
                        <li class="actual_press"> <a href="<?php the_permalink(); ?>">View archived verison</a> </li>
                        <li class="archived_press"> 
                                                        <?php
                                $key = get_post_meta($post->ID, '_format_link_url', true);
                                if ($key != '') {
                                      echo '<a href="'.$key.'" target="_blank">View actual version</a>';
                                   } else {} ?>        
                                 </li>
                        </ul>
                    </article>

<?php endwhile; wp_reset_query(); ?> 


<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($new_query->max_num_pages) { ?>
<nav id="post-nav" class="pager">
    <div class="previous"><?php next_posts_link('&lt; Older Entries', $new_query->max_num_pages) ?></div>
    <div class="next"><?php previous_posts_link('Newer Entries &gt;') ?></div>
</nav>
<?php } ?>

    </div>

    <div id="sidebar" class="native page_sb">
		<?php include (TEMPLATEPATH . '/custom_sb.php'); ?>  
    </div>
</div>