
<?php
get_header();
?>

<main>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="wrapper">
        <section>
            <?php the_content(); ?>
        </section>
    <?php endwhile; else: endif; ?>

    <h2 class="heading-underline has-large-font-size">Posts and Publications</h2>
    <?php $query = new WP_Query(array(
            'post_type' => array('post', 'publication'),
            'post_status' => 'publish',
            'posts_per_page' => 2,
        )); ?>
        <ol class="cards grid grid-3">
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                get_template_part( 'template-parts/home-card', get_post_format() );
            endwhile; ?>
            <li>
                <div class="widget">
                    <?php dynamic_sidebar('mailing_list'); ?>
                </div>
            </li>
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
