<?php get_template_part('templates/page', 'header'); ?>
<div class="post_content">
    <div class="post_single shadow gu8">
		<?php while (have_posts()) : the_post(); ?>
          <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <header>
              <h1 class="entry-title"><?php the_title(); ?></h1>
              <?php roots_entry_meta(); ?>
            </header>
            <?php get_template_part('templates/socialshare'); ?>
            <div class="entry-content">
              <?php the_content(); ?>
            </div>
            <footer>
              <?php /*?><?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?><?php */?>
              <?php $tags = get_the_tags(); if ($tags) { ?><p><?php the_tags(); ?></p><?php } ?>
              <?php get_template_part('templates/prev_next'); ?>
            </footer>
            <?php /*?><?php comments_template('/templates/comments.php'); ?><?php */?>
          </article>
        <?php endwhile; ?>
    </div>
    <aside id="secondary_sb" class="sidebar">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('post') ) ?>
    </aside>
    <aside id="primary_sb" class="sidebar">
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('page') ) ?>
    </aside>
</div>
