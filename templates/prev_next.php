<nav id="post-navigation" class="clearfix">
<?php
$prev_post = get_adjacent_post(false, '', true);
$next_post = get_adjacent_post(false, '', false); ?>
<?php if ($prev_post) : $prev_post_url = get_permalink($prev_post->ID); $prev_post_title = $prev_post->post_title; ?>
<a class="post-prev" href="<?php echo $prev_post_url; ?>"><i class="icon-chevron-left"></i><span>Previous post</span></a>
<?php endif; ?>
<?php if ($next_post) : $next_post_url = get_permalink($next_post->ID); $next_post_title = $next_post->post_title; ?>
<a class="post-next" href="<?php echo $next_post_url; ?>"><span>Next post</span><i class="icon-chevron-right"></i></a>
<?php endif; ?>
</nav>

<?php /*?><div class="post-navigation clear">
<i class="icon-chevron-left"></i>
<i class="icon-chevron-right"></i>

<?php
$prev_post = get_adjacent_post(false, '', true);
$next_post = get_adjacent_post(false, '', false); ?>
<?php if ($prev_post) : $prev_post_url = get_permalink($prev_post->ID); $prev_post_title = $prev_post->post_title; ?>
<a class="post-prev" href="<?php echo $prev_post_url; ?>"><em>Previous post</em><span><?php echo $prev_post_title; ?></span></a>
<?php endif; ?>
<?php if ($next_post) : $next_post_url = get_permalink($next_post->ID); $next_post_title = $next_post->post_title; ?>
<a class="post-next" href="<?php echo $next_post_url; ?>"><em>Next post</em><span><?php echo $next_post_title; ?></span></a>
<?php endif; ?>
</div><?php */?>