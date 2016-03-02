<?php if( $my_query->have_posts() ) {
    while ($my_query->have_posts()) : $my_query->the_post(); ?>

        <div class="reviews__carousel--item">
            <div class="reviews__carousel--item--img">
                <div class="reviews__carousel--item--img--box">
                   <?php the_post_thumbnail(); ?>
                </div>
            </div>
            <div class="reviews__carousel--item--desc">
                <h4><?php the_title(); ?></h4>
                <p><?php the_content(); ?></p>
                <p class="reviews--name"><?php echo get_post_meta(get_the_ID(), "name", 1); ?></p>
            </div>
        </div>

    <?php endwhile; }
wp_reset_query(); ?>