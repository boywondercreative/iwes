<div id="page">
	<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu12">
        <div class="page-content clearfix shadow"> 
		<?php get_template_part('templates/content', 'page'); ?>
        </div>
    </div><!--END PAGE MAIN-->
    <aside id="primary_sb" class="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><!--END PAGE-->
