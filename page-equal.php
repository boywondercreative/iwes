<?php
/*
Template Name: Equal Page
*/
?>
	<style media="screen" type="text/css">
/* <!-- */

/* Start of Column CSS */
#container2 {
	clear:left;
	float:left;
	width:100%;
	overflow:hidden;
	background:#ffa7a7; /* column 2 background colour */
}
#container1 {
	float:left;
	width:100%;
	position:relative;
	right:50%;
	background:#fff689; /* column 1 background colour */
}
#col1 {
	float:left;
	width:46%;
	position:relative;
	left:52%;
	overflow:hidden;
}
#col2 {
	float:left;
	width:46%;
	position:relative;
	left:56%;
	overflow:hidden;
}
/* --> */
    </style>
<div id="page">
<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu12">
	 <?php get_template_part('templates/page', 'subpagenav'); ?>   
        <div class="tabbed-page-content clearfix shadow"> 
           
           
<div id="container2">
	<div id="container1">
		<div id="col1"></div>
        <div id="col2"></div>
	</div>
</div>
 
           
           
           
           
           
        </div><!--END TABBED PAGE-->
    </div><!--END PAGE MAIN-->
    <aside id="primary_sb" class="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><!--END PAGE-->


