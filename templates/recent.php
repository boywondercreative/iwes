<?php $loop = new WP_Query(array('post_type' => 'post', 'category_name' => 'news',  'posts_per_page' => 3)); ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a class="short-post" title="<?php the_permalink() ?>" href="<?php the_permalink() ?>">  
        <header>
            <h2><?php the_title(); ?></h2>
            <?php recent_meta(); ?>
        </header>
        <?php the_excerpt(); ?>
    </a>    
</article>
<?php endwhile; wp_reset_query(); ?> 
