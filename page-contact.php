<?php
/*
Template Name: Contact Page
*/
?>

<div id="page">
<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="contact-body" class="gu16 shadow">
    <div class="contact-padding clearfix">
        <div class="contact-left"><?php get_template_part('templates/content', 'page'); ?></div>
        <div class="contact-right">
<?php
global $contact_mb; 
$contact_mb->the_meta(); 
?>		
        <dl>
            <dt>Phone</dt>
                <dd><?php $contact_mb->the_value('phone');?></dd>
            <dt>Fax</dt>
                <dd><?php $contact_mb->the_value('fax');?></dd>
            <dt>Location</dt>
                <dd>
                    <address class="office">
                        <?php $contact_mb->the_value('org-name');?><br>
                        <?php $contact_mb->the_value('addy1');?><br>
                        <?php $contact_mb->the_value('addy2');?><br>
                        <?php $contact_mb->the_value('addy3');?>
                    </address>
                </dd>
        </dl>		
		
		<div class="contact-map">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('contact') ) ?>
            <p class="directions">Click map for directions</p>
        </div>
        </div>
    </div>
    </div>
</div>

<?php /*?>        <dl>
            <dt>Phone</dt>
                <dd>504-599-7712</dd>
            <dt>Fax</dt>
                <dd>504-599-7713</dd>
            <dt>Location</dt>
                <dd>
                    <address class="office">
                        Institute for Women & Ethnic Studies<br>
                        935 Gravier Street<br>
                        Suite 1140<br>
                        New Orleans, LA 70112
                    </address>
                </dd>
        </dl>		
		<?php */?>
        
<?php /*?><div id="page">
<?php get_template_part('templates/page', 'custom-header'); ?>
<div class="container shadow">
    <div id="contact-body" class="gu16 clearfix shadow">
        <div id="contact-content" class="gu8">                 
        <?php get_template_part('templates/content', 'page'); ?>
        </div>
        <aside id="contact_sb" class="gu8">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('contact') ) ?>
        </aside>
    </div>
</div>

</div><?php */?>



<?php /*?><div id="page">
	<?php get_template_part('templates/page', 'custom-header'); ?>

    <div id="pg_main" class="gu12 shadow">
        <div class="page-content">
                 
		<?php get_template_part('templates/content', 'page'); ?>
        </div>
    </div>

    <aside id="page_sb" class="gu4 sidebar">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div><?php */?>