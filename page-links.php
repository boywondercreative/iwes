<?php
/*
Template Name: Helpful Links Page
*/
?>
<div id="page">
	<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu12">
		<?php get_template_part('templates/page', 'subpagenav'); ?>   
        	<div class="page-content clearfix shadow"> 
           
                <ul id="helpful_links">        
                        <?php global $link_mb;
                        if(isset($link_mb)){
                        $link_mb->the_meta(); 
                        $counter = 0;
                        while($link_mb->have_fields('link')){ ?>
                        
                        <li class="helpful_link">
                            <p class="name"><?php echo $link_mb->the_value('org'); ?></p>
                            <p class="title"><?php echo $link_mb->the_value('addy'); ?></p>
                            <p class="title"><?php echo $link_mb->the_value('phone'); ?></p>
                            <p class="title"><?php echo $link_mb->the_value('days'); ?></p>
                            <p class="title"><?php echo $link_mb->the_value('hours'); ?></p>
                            <p class="title"><?php echo $link_mb->the_value('services'); ?></p>
                            <p class="title"><?php echo $link_mb->the_value('site'); ?></p>
                        </li>
                        <?php } } ?>  
                </ul>           
                
                <ul class="list-ensemble">
                <?php query_posts('post_type=person&post_status=publish&meta_key=last_name&orderby=meta_value&order=ASC'); 
                $current_letter = '';
                if ( have_posts() ) while ( have_posts() ) : the_post();
                    $last_name = get_post_meta( $post->ID, 'org', true );
                    $letter = strtolower( substr( $last_name, 0, 1 ) );
                    if ( $letter != $current_letter ) {
                        $current_letter = $letter; ?>
                        <li class="letter">
                            <img src="<?php echo $letter; ?>.jpg" alt="<?php echo $letter; ?>" title="<?php echo $letter; ?>">
                        </li>
                    <?php } ?>
                    <li data-id="<?php the_ID(); ?>">
                        <a href="<?php the_permalink(); ?>" class="ensemble-single-link">
                            <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'thumbnail' ); } ?>
                        </a>
                    </li>
                <?php endwhile; // end of the loop. ?>
                </ul>           
           
		</div><!--END TAB CONTAINER-->
    </div><!--END PAGE MAIN-->
    <aside id="primary_sb" class="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><!--END PAGE-->


