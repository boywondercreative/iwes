<?php
/*
Template Name: Program Page
*/
?>


<?php /*?>    <div id="pg_header" class=""> <!--START OF PAGE HEAD-->

        <?php while (have_posts()) : the_post(); ?>
            <div class="img-cotainer">
                <?php the_post_thumbnail(); ?> 
            </div>s
            <div class="pg_title">
                <h1><?php the_title(); ?></h1> 
            </div>     
        <?php endwhile; ?>      
    </div> <!--END OF PAGE HEAD--><?php */?>
    
<div id="page"><!--START OF PAGE-->
<section id="hero" class="section"><!--START OF HERO-->
    <div id="child_branding" class="gu6 shadow">
	 <?php the_post_thumbnail(); ?> 
    </div>
    
        <div id="featured" class="gu10 shadow"> 
            <div class="flexslider">
                <ul class="slides">
					<?php global $slide_mb;
                    if(isset($slide_mb)){
                    $slide_mb->the_meta(); 
                    $counter = 0;
                    while($slide_mb->have_fields('slide')){ ?>   
                             
                    <li class="<?php if ($slide_mb->get_the_value('nofollow')) echo 'no_show';?>">
                        <div class="feat_img">
                        <a href="<?php echo $slide_mb->the_value('url'); ?>" target="">
                        <img src="<?php echo $slide_mb->the_value('image_src'); ?>" />
                        </a>
                        </div>
                        
                        <div class="feat_teaser">
                        <h1 class=""><?php echo $slide_mb->the_value('headline'); ?></h1>
                        <p class=""><?php echo $slide_mb->the_value('caption'); ?></p>
                        </div>
                    </li>
                    <?php } } ?>  
                </ul>
            </div>        
        </div>
</section><!--END HERO-->
<section id="latest" class="section"><!--START LATEST-->
<div id="pg_main" class="gu12">
	 <?php /*?><?php get_template_part('templates/page', 'subpagenav'); ?>  
        <div class="tabbed-page-content clearfix shadow"> 
            <div id="tab-container" class="tab-container"><!--START TAB CONTAINER-->
                <ul class="etabs">
					<?php
                    $pages = get_pages('child_of='.$post->ID.'&sort_column=menu_order&sort_order=asc');
                    $content = $page->ID;
                    foreach($pages as $page)
                    {
                    ?>
                    <li class="tab"><a href="#<?php echo $page->post_name ?>"><span><?php echo $page->post_title ?></span></a></li>
                    <?php } ?>
                </ul>
                <div class="slides-container"><!--SLIDE CONTAINER-->
					<?php
                    foreach($pages as $page)
                    {
                    $content = $page->post_content;
                    $content = apply_filters('the_content', $content);
                    ?>
                    <div id="<?php echo $page->post_name ?>">    
                    <article>
                    <h3><?php echo $page->post_title ?></h3>
                    <?php echo $content ?>
                    </article>
                    </div>
				<?php } ?>
                </div><!--SLIDE CONTAINER-->               
            </div><!--END TAB CONTAINER-->
        </div><!--END TABBED PAGE--><?php */?> 
        
        <div class="page-content clearfix shadow"> 
		<?php get_template_part('templates/content', 'page'); ?>
        </div>        
</div><!--END PAGE MAIN-->    
    <aside id="primary_sb" class="sidebar">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('program') ) ?>
    </aside>
</section><!--END LATEST-->
</div><!--END PAGE-->