<div id="page">
    <section id="pg_header" class="section">
        <div id="branding" class="gu6 shadow">
            <a class="brand" href="<?php echo home_url(); ?>/"></a>
        </div>
            <div class="pg_title gu10 shadow">
                <h1 style=" margin-left: 260px;">:(</h1> 
            </div> 
    </section><!--END HERO-->


    <div id="pg_main" class="gu16">
       
        <div id="fourohfour" class="page-content clearfix shadow">
            <h1>404</h1>
            <p id="four_4"> Page Not Found </p>
        
                <p style="font-weight:bold;"><?php _e('Please try the following:', 'roots'); ?></p>
                <ul>
                  <li><?php _e('Check your spelling', 'roots'); ?></li>
                  <li><?php printf(__('Return to the <a href="%s">home page</a>', 'roots'), home_url()); ?></li>
                  <li><?php _e('Click the <a href="javascript:history.back()">Back</a> button', 'roots'); ?></li>
                </ul>
                <?php get_search_form(); ?>
        </div>        
    </div>
</div>
        
