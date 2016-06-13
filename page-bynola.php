<?php
/*
Template Name: BY! NOLA Page
*/
?>
<div id="page"><!--START OF PAGE-->
<section id="hero" class="section"><!--START OF HERO-->
    <div id="child_branding" class="gu6 shadow">
		<a class="brand" href="<?php echo home_url(); ?>/"></a>
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

<?php /*?>    <div id="newsletter" class="gu6 shadow">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('newsletter') ) ?>
    </div><?php */?>
            
</section><!--END HERO-->
  

<section id="latest" class="section"><!--START LATEST-->

<?php /*?>    <div id="recent" class="gu6 shadow">  
        <div class="padding">
            <h1 id="news-header">Blog Posts</h1>
              <?php get_template_part('templates/recent'); ?>
        </div> 
    </div>    
    
    <div id="tweets" class="gu6 shadow">
        <div class="padding">
            <h1 class="updates">Updates</h1>
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('twitter') ) ?>
        </div>        
    </div><?php */?>
    
<div id="pg_main" class="gu12">
	 <?php /*?><?php get_template_part('templates/page', 'subpagenav'); ?>  <?php */?> 
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
        </div><!--END TABBED PAGE-->
</div><!--END PAGE MAIN-->    
    
    
    
    
    
    
            
    <aside id="primary_sb" class="sidebar">
	<?php /*?><?php get_template_part('templates/follow'); ?><?php */?>
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('front') ) ?>
    </aside>
    
</section><!--END LATEST-->
</div><!--END PAGE-->