<?php
/*
Template Name: Default Page w/ Custom Sidebars
*/
?>

<div id="page">
    <div id="pg_main" class="gu12">
        <div class="page-content"> 
		<?php get_template_part('templates/content', 'page'); ?>
        </div>
    </div><!--END PAGE MAIN-->
    <aside id="primary_sb" class="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><!--END PAGE-->


