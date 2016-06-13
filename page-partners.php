<?php
/*
Template Name: Partners Page
*/
?>
<div id="page">
	<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu12">
		<?php get_template_part('templates/page', 'subpagenav'); ?>   
        	<div id="partners" class="page-content clearfix shadow"> 
                <ul id="funders">
                    <?php global $funder_mb;
                    if(isset($funder_mb)){
                    $funder_mb->the_meta(); 
                    $counter = 0;
                    while($funder_mb->have_fields('funder')){ ?>    
                        <li class="<?php if ($funder_mb->get_the_value('nofollow')) echo 'no_show';?> funder">
                        <a href="<?php echo $funder_mb->the_value('url'); ?>" target="_blank">
                        <div class="thumb">
                        <img src="<?php echo $funder_mb->the_value('image_src'); ?>"/>
                        </div>
                        </a>
                        <?php /*?><p class="">AIDSUnited</p>
                        <p class="">Past</p><p class="">Funder</p><?php */?>
                        </li>
                    <?php } } ?>  
                </ul>  
        </div>
    </div><!--END PAGE MAIN-->
    <aside id="primary_sb" class="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><!--END PAGE-->

