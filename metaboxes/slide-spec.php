<?php

$slide_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_slide_meta',
	'title' => 'Add a slide',
	'template' => get_stylesheet_directory() . '/metaboxes/slide-meta.php',
	'priority' => 'high', // same as above, defaults to "high"	
    'include_template' => array('page-front.php','page-home.php'), // use an array for multiple items
	'hide_editor'	=> false		
));

/* eof */