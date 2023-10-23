<?php
get_header();
?>
<main class="blog">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="wrapper">
        <section>
            <h1>Blog</h1>
        </section>
    <?php endwhile; else: endif; ?>

    <?php $query = new WP_Query(array(
            'post_type' => 'post',
            'post_status' => 'publish',
        )); ?>
        <ol class="cards grid grid-3">
            <div>
                <div class="widget">
                    <?php dynamic_sidebar('mailing_list'); ?>
                </div>
            </div>
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                get_template_part( 'template-parts/blog-card' );
            endwhile; ?>
        </ol>
        <?php else: ?>
        <section style="grid-column: 1 / 4" class="card-section">
            <p class="card-section-excerpt"><?php _e( 'Sorry, no posts yet!' ); ?></p>
        </section>
    <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?>
