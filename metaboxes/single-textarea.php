<div class="my_meta_control">
 
	<p><?php _e('Primary Sidebar for Inside Pages.');?></p>
    <p class="instructions"><span>1)</span> Enter a header title and content.</p> 
    <p class="instructions"><span>2)</span> In order to save the information you just entered, be sure to click the blue "Update" button.</p> 
    	<?php while($mb->have_fields_and_multi('single_textarea')): ?>
		
		<?php $mb->the_group_open(); ?>    
 
        <p>
        <label>Header</label>
		<input type="text" name="<?php $metabox->the_name('header'); ?>" value="<?php $metabox->the_value('header'); ?>"/>
        </p> 
 
        <p>
		<?php $mb->the_field('test_editor'); 
		$settings = array( 
			'textarea_rows' => '10',
			'media_buttons' => 'false',
			'tabindex' =>2
		);

		$val =  html_entity_decode($mb->get_the_value()); 
		$id = $mb->get_the_name();
		
		wp_editor($val,  $id , $settings );
		?>		 
        </p>
    
	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>
    	
	<p class="meta-save"><button type="submit" class="button-primary" name="save"><?php _e('Update');?></button></p>

</div>