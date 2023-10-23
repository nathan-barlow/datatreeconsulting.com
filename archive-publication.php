
<?php
get_header();
?>

<main>
    <section>
        <div class="wrapper">
            <h1 class="heading-underline">Published Research</h1>
            <ol class="research-archive">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();

                    if(get_field('publication_url')) {
                        $post_url = get_field('publication_url');
                    } else {
                        $post_url = get_permalink();
                    }
                ?>
                <li class="research-item">
                    <a class="card-link" href="<?php echo $post_url; ?>" title="Read More About:  <?php the_title_attribute(); ?>">
                        <figure class="card-figure">
                            <?php the_post_thumbnail('card-small'); ?>
                        </figure>
                        <div class="card-text">
                            <h2 class="card-title">
                                <?php the_title(); ?>
                            </h2>
                            <div class="research-meta">
                                <p class="c-color-neutral-600">
                                    <?php echo get_the_date( 'F Y' ) ?>
                                </p>
                                <?php $tags = get_the_tags();
                                if( $tags ) { ?>
                                    <ul class="tags">
                                        <?php foreach ($tags as $tag) { ?>
                                            <li><? echo $tag->name; ?></li>
                                        <?}?>
                                    </ul>
                                <?php } ?>
                            </div>
                            <p>
                                <?php the_excerpt(); ?>
                            </p>
                            <p class="c-color-dark"><u>Read the paper</u></p>
                        </div>
                    </a>
                </li>
                <? endwhile; ?>
            </ol>
            <?php
            the_posts_pagination( array(
                'mid_size' => 2,
                'prev_text' => __( '<i class="bi bi-arrow-left"></i>', 'textdomain' ),
                'next_text' => __( '<i class="bi bi-arrow-right"></i>', 'textdomain' ),
            ) );
            else: ?>
            <section style="grid-column: 1 / 4" class="card-section">
                <p class="card-section-excerpt"><?php _e( 'Sorry, no posts yet!' ); ?></p>
            </section>
            
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
?>
