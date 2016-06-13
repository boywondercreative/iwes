                <?php global $simple_textarea, $repeating_textareas;
                
                if(isset($simple_textarea)){
                    $simple_textarea->the_meta(); 
					while($simple_textarea->have_fields('single_textarea')){ ?>                    
						<div class="inside_sb_widget widget">
                        <h3 class="inside_sb_head"><?php echo $simple_textarea->get_the_value('header'); ?></h3> 
                        <div class="widget"><?php echo apply_filters('meta_content',$simple_textarea->get_the_value('test_editor')); ?></div>
                        </div>
					
					<?php } } ?>
                
                <?php if(isset($repeating_textareas)){
                    $repeating_textareas->the_meta(); 
                    while($repeating_textareas->have_fields('repeating_textareas')){ ?>
                        <div class="inside_sb_widget widget">
                        <h3 class="inside_sb_head"><?php echo $repeating_textareas->get_the_value('header'); ?></h3> 
                        <div class="inside_sb_inner"><?php echo $repeating_textareas->get_the_value('textarea'); ?></div>
                        </div>
                    <?php } } ?>