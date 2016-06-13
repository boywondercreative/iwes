<?php
/*
Template Name: Staff Page
*/
?>

<div id="page">
	<?php include (TEMPLATEPATH . '/pageheader.php'); ?>
    <div id="pg_main" class="full">       
        <ul id="staff"> <!--START OF STAFF LIST-->
        
        <?php global $person_mb;
        if(isset($person_mb)){
        $person_mb->the_meta(); 
        $counter = 0;
        while($person_mb->have_fields('person')){ ?>
        
        <li class="person <?php if ($person_mb->get_the_value('nofollow')) echo 'no_show';?>">
            <div class="person_before">
                <a href="#<?php echo $counter ;?>"class="supernote-click-<?php echo $counter ;?>"> 
                <div class="thumb thumbnail">
                <?php $person_mb->the_field('image_src'); ?>
                <img src="<?php if($person_mb->get_the_value()){$person_mb->the_value();}else { echo get_template_directory_uri().'/assets/img/silo.png';}?>"/>
                </div>
                <p class="name"><?php echo $person_mb->the_value('name'); ?></p>
                <p class="title"><?php echo $person_mb->the_value('position'); ?></p>
                </a>
            </div> <!--END OF PERSON BEFORE-->
        
            <div id="supernote-note-<?php echo $counter ;?>" class="snb-pinned notedefault person_after_container"> 
            <div class="shroud"></div>
                <div class="person_after"> 
                    <a href="#" class="note-close">&times;</a>     
                    <div class="pull-left">
                        <div class="thumb"><!--start of thumb-->
                            <img src="<?php echo $person_mb->the_value('image_src'); ?>"/>
                        
                            <div class="person_caption">
                            <p class="name"><?php echo $person_mb->the_value('name'); ?></p>
                            <p class="title"><?php echo $person_mb->the_value('position'); ?></p>
							<?php if($person_mb->get_the_value('email')){ ?>
                            <p class="email"><a href="mailto:<?php echo $person_mb->the_value('email'); ?>"><i class="icon-envelope-alt"></i><?php echo $person_mb->the_value('email'); ?></a></p>
                            <?php } ?>                          
                            <?php /*?><p class="phone"><i class="icon-phone icon-white"></i><?php echo $person_mb->the_value('phone'); ?></p><?php */?>
                            </div>
                        
                        </div><!--end of thumb-->
                    </div>
                
                    <div class="pull-right">
                        <?php /*?><p class="bio"><?php echo $person_mb->the_value('bio'); ?></p><?php */?>
                       <div class="bio"><?php echo apply_filters('meta_content',$person_mb->get_the_value('bio')); ?></div>
                    </div>
                </div><!--END OF PERSON AFTER-->
            </div>
        <?php $counter++ ?>
        </li>
        <?php } 
        }?>  
        </ul><!--END OF STAFF LIST-->
        
    </div>
</div>