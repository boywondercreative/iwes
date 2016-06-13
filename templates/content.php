<?php if (!have_posts()) : ?>
  <div class="alert alert-block fade in">
    <a class="close" data-dismiss="alert">&times;</a>
    <p><?php _e('Sorry, no results were found.', 'roots'); ?></p>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a class="short-post" title="<?php the_permalink() ?>" href="<?php the_permalink() ?>">  
        <header>
            <h2><?php the_title(); ?></h2>
            <?php recent_meta(); ?>
        </header>
        <?php the_excerpt(); ?>
    </a>    
</article>
<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>
  <nav id="post-nav" class="pager">
    <div class="previous"><?php next_posts_link(__('<i class="icon-chevron-left"></i> Older posts', 'roots')); ?></div>
    <div class="next"><?php previous_posts_link(__('Newer posts <i class="icon-chevron-right"></i>', 'roots')); ?></div>
  </nav>
<?php endif; ?>
