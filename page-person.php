<?php
/*
Template Name: Person Page
*/
?>

<div id="page">
	<?php get_template_part('templates/page', 'custom-header'); ?>
    <div id="pg_main" class="gu12">
    <?php get_template_part('templates/page', 'subpagenav'); ?>  
        <div id="people" class="page-content clearfix shadow"> 

             <ul id="staff"> <!--START OF STAFF LIST-->
                
                <?php global $person_mb;
                if(isset($person_mb)){
                $person_mb->the_meta(); 
                $counter = 0;
                while($person_mb->have_fields('person')){ ?>
                
                <li class="person <?php if ($person_mb->get_the_value('nofollow')) echo 'no_show';?>">
                        <a href="#person-<?php echo $counter ;?>" class="fancyperson"> 
                        <div class="thumb">
						<?php $person_mb->the_field('image_src'); ?>
                        <img src="<?php if($person_mb->get_the_value()){$person_mb->the_value();}else { echo get_template_directory_uri().'/assets/img/silo.png';}?>"/>
                        </div>
                        <p class="name"><?php echo $person_mb->the_value('name'); ?></p>
                        <p class="title"><?php echo $person_mb->the_value('position'); ?></p>
                        </a>
                        
<div style="display:none">
    <div id="person-<?php echo $counter ;?>" class="personbig"><!--START OF PERSON BIG -->
        <header class="personheader">
        <a class="personclose" href="javascript:parent.$.fancybox.close();"><i class="icon-remove"></i><?php /*?><i class="icon-remove-circle"></i><i class="icon-remove-sign"></i><?php */?></a>
        </header>
        <section class="personbody"><!--START OF PERSON BODY -->
            <article class="persondetails"><!--START OF PERSON META -->
                <div class="personthumb">
                <img src="<?php if($person_mb->get_the_value()){$person_mb->the_value();}else { echo get_template_directory_uri().'/assets/img/silo.png';}?>"/>
                </div>
                <h3 class="personname"><?php echo $person_mb->the_value('name'); ?></h3>
                <h4 class="persontitle"><?php echo $person_mb->the_value('position'); ?></h4>
                <?php if($person_mb->get_the_value('email')){ ?>
                <button type="button" class="personemail">
                <a href="mailto:<?php echo $person_mb->the_value('email'); ?>"><?php /*?><i class="icon-envelope"></i><?php */?> <i class="icon-envelope-alt"></i> <?php echo $person_mb->the_value('email'); ?></a>
                </button>
                <?php } ?>             
            </article><!--END OF PERSON META -->
            <article class="personbio"><p class="scroll-pane"><?php echo apply_filters('meta_content',$person_mb->get_the_value('bio')); ?></p></article>
        </section><!--END OF PERSON BODY -->
        <nav class="personnav">
        <a class="personPrev" href="javascript:parent.$.fancybox.prev();"><i class="icon-chevron-left"></i></a>
        <a class="personNext" href="javascript:parent.$.fancybox.next();"><i class="icon-chevron-right"></i></a>
        </nav>
    </div><!--END OF PERSON BIG -->                    
</div><!--END OF DIV HIDE -->  
                <?php $counter++ ?>
                </li>
                <?php } 
                }?>  
                </ul><!--END OF STAFF LIST-->
        </div>        
    </div>
    <aside id="primary_sb" class="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div>



<?php /*?><div class="entry">
    
    <a href="#cast_376" class="fancybox" rel="all_cast_members" title="feature_0083_Gbenga Akinnagbe">
    <img width="215" height="160" title="feature_0083_Gbenga Akinnagbe" alt="Gbenga Akkinagbe" class="attachment-thumbnail wp-post-image" src="http://www.outsidethewirellc.com/wp-content/uploads/2011/05/feature_0083_Gbenga-Akinnagbe1-215x160.jpg"></a>
	 <p>Akkinagbe, Gbenga</p>
	 
     <div style="display:none">
           <div id="cast_376">
	     <div class="cast_popup">
<h2>Gbenga Akkinagbe</h2>
<div class="info">
<img width="310" height="230" alt="Gbenga Akkinagbe" src="/wp-content/uploads/2011/05/feature_0083_Gbenga-Akinnagbe1.jpg" title="feature_0083_Gbenga Akinnagbe" class="alignnone size-full wp-image-546">

<p></p>
<p>&nbsp;</p>
<p><strong>Gbenga Akkinagbe</strong><br> TV &amp; Film credits include:<br> <em>Edge of Darkness</em><br> <em>The Good Wife</em><br> <em>The Wire</em></p>
<p>&nbsp;</p>
</div>
</div>
	   </div>
	 </div>
</div><?php */?>