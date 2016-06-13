<footer id="footer_wrap">
    <section id="content-info" class="container" role="contentinfo">
    <?php /*?><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer') ) ?><?php */?>

<?php /*?> 
<div id="footer_programs">
   
            <nav id="nav-main" role="navigation">
              <?php
                if (has_nav_menu('primary_navigation')) {
                  wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav'));
                }
              ?>
            </nav>       +
		<?php */?>
<?php /*?>  
 <nav id="nav-secondary" role="navigation">
 
            <?php
                if (has_nav_menu('primary_navigation')) {
                  wp_nav_menu(array(
				  'theme_location' => 'primary_navigation', 'menu_class' => 'nav',
				  'walker' => new SH_Child_Only_Walker(),'depth' => 2
				  
				  ));
                }
              ?>
              
</nav> 

<?php */?> 
            
<?php /*?><?php             
wp_nav_menu( array(
    'theme_location'    => 'secondary_navigation',
    'container'     => '',
    'container_id'      => 'top-navigation-primary',
    'conatiner_class'   => 'top-navigation',
    'menu_class'        => 'block-menu',
    'echo'          => true,
    'items_wrap'        => '<ul id="page_map" class="%2$s">%3$s</ul>',
    'depth'         => 2,
    'walker'        => new themeslug_walker_nav_menu
) ); // thanks nick
?>
			
</div>

     <div id="social">
        <h2> Join Us </h2>
        <ul class="footer_social">
            <li><a class="facebook" target="_blank" href="http://www.facebook.com/IWES.NOLA">IWES on Facebook</a></li>
            <li><a class="twitter" target="_blank" href="http://twitter.com/#!/IWESNOLA/">IWES on Twitter</a></li>
            <li><a class="youtube" target="_blank" href="http://www.youtube.com/user/IwesNola/">IWES on Youtube</a></li>
    	</ul>
      </div><?php */?>

<article id="copyright">         
    <p> &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
</article>

    </section>
</footer>
<?php wp_footer(); ?>
