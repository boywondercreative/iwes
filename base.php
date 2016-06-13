<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

<?php /*?><div id="cover">
    <div class="coverr_content">
    <p class="load_head"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/hamrony_logo_load.png" id="loader"></p>
    <p class="load_spin"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/camera-loader.gif" id="loader"></p>
    </div>
</div><?php */?>


<!--[if lt IE 7]><div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</div><![endif]-->


  <?php
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <div id="wrap" class="container" role="document">
    <div id="content" class="row">
        <?php include roots_template_path(); ?>
    </div><!-- /#content -->
  </div><!-- /#wrap -->

  <?php get_template_part('templates/footer'); ?>
</body>
</html>
