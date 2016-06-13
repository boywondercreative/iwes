<?php
/*
Template Name: Redirect To First Child
*/
	$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
	if ($pagekids) {
		$firstchild = $pagekids[0];
		wp_redirect(get_permalink($firstchild->ID));
	} else {
		// Do whatever templating you want as a fall-back.
	}
?>
<?php
/*
Template Name: Redirect To First Child
*/
?>
<?php /*?><?php
if (have_posts()) {
  while (have_posts()) {
    the_post();
    $pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
    $firstchild = $pagekids[0];
    wp_redirect(get_permalink($firstchild->ID));
  }
}
?><?php */?>