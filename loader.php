<?php         

if ( is_front_page() ) 
{?>

<div id="cover">
    <div class="coverr_content">
    <p class="load_head"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/hamrony_logo_load.png" id="loader"></p>
    <p class="load_spin"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/camera-loader.gif" id="loader"></p>
    </div>
</div>

<?php } 
else 
{
   // This is a paginated page.

}
?>
