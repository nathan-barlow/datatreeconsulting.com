<?php
get_header();
?>
<main class="tree">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="wrapper">
        <section>
            <h1><?php the_title() ?></h1>
            <?php the_content(); ?>
        </section>
    <?php endwhile; else: endif; ?>

    <?php $nearby = new WP_Query(array(
            'post_type' => 'tree',
            'post_status' => 'publish',
        )); ?>
        <ol class="cards grid grid-3">
            <?php if ( $nearby->have_posts() ) : while ( $nearby->have_posts() ) : $nearby->the_post();
                get_template_part( 'template-parts/tree-card', get_post_format() );
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
