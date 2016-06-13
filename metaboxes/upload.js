jQuery(document).ready(function($) {

				
			/*
			 * Upload function
			 */
			 
			 
			var form_src, form_alt, form_id, button, tbframe_interval;
			

			$('.my_meta_control').delegate('.upload_image_button','click', function() { 
				form_src = $(this).prevAll('input.image_src');
				form_alt = $(this).prevAll('input.image_alt');
				form_id = $(this).prevAll('input.image_id');
								
				button = $(this);
				
				tbframe_interval = setInterval(function() {
					//change button text
					$('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');
					//remove url, alignment and size fields- auto set to null, none and full respectively
					$('#TB_iframeContent').contents().find('.url').hide().find('input').val('');
					$('#TB_iframeContent').contents().find('.align').hide().find('input:radio').filter('[value="none"]').attr('checked', true);
					$('#TB_iframeContent').contents().find('.image-size').hide().find('input:radio').filter('[value="full"]').attr('checked', true);
				}, 2000);
				tb_show('', 'media-upload.php?type=image&tab=library&TB_iframe=true');
				//tb_show('', 'media-upload.php?type=image&TB_iframe=true');
				return false;
			});

			window.original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html){
				clearInterval(tbframe_interval);
				if (form_src) {
				
					//if image links somewhere then the img node will be a child of the returned html
					if ( $(html).children().length > 0)	{ 
						src = $('img',html).attr('src');
						imgclass = $('img',html).attr('class');
						alt = $('img',html).attr('alt');
						href = $('a',html).attr('href');
					} else { //img node IS the returned html
						src = $(html).attr('src');
						imgclass = $(html).attr('class');
						alt = $(html).attr('alt');
					}
					
					if(typeof imgclass != 'undefined') {
					var imageID = imgclass.match(/([0-9]+)/i);
						imageID = (imageID && imageID[1]) ? imageID[1] : '' ;
					}
						
					var url = src ? src : href ;
								
					form_src.val(url);
					form_alt.val(alt);
					form_id.val(imageID);
					form_src.prevAll('.preview_wrap').children('img').attr('src',url).fadeIn();
					button.html('<span class="icon change"></span><?php _e('Change Image');?>').next('.delete_image_button').fadeIn();
					tb_remove();
					form_src = ''; //reset form_src to null so original works
				} else {
					window.original_send_to_editor(html);
				}
			};

			
			/*
			 * Remove Function
			 */
			 
		
			$('.my_meta_control').delegate('.delete_image_button','click', function() {
				form_src = $(this).prevAll('input.image_src').val('');
				form_alt = $(this).prevAll('input.image_alt').val('');
				form_id = $(this).prevAll('input.image_id').val('');
				
				var img = form_src.prevAll('.preview_wrap').children('img');
				
				if( img.hasClass('photo')){
					img.attr('src','<?php echo WPALCHEMY; ?>/images/default_photo.png').fadeIn();
				} else {
					img.attr('src','<?php echo WPALCHEMY; ?>/images/default_preview.png').fadeIn();
				}
				
				$(this).prev().html('<span class="icon upload"></span><?php _e('Upload Image');?>');
				$(this).fadeOut();
				return false;
			});
			
			$('.slide_preview').each(function(){
				var src = $(this).find('.image_src').val();
				if(src) { $(this).find('.delete_image_button').show(); } else { $(this).find('.delete_image_button').hide(); }
			});
	
			
			}); //end doc ready


