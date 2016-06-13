<?php
/*
Template Name: Tabbed Subnav Page
*/
?>
<div id="page">
<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu12">
	 <?php get_template_part('templates/page', 'subpagenav'); ?>   
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
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><!--END PAGE-->


