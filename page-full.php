<?php
/*
Template Name: Full Page
*/
?>

<div id="page">
	<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu16">
        <div class="page-content clearfix shadow"> 
		<?php get_template_part('templates/content', 'page'); ?>
        </div>
    </div>
</div>