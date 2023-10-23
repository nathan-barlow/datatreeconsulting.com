<?php
get_header();
?>

    <div class="wrapper page-header">
        <h1><?php the_title(); ?></h1>
    </div>
</header>
<main>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="wrapper">
        <section>
            <?php the_content(); ?>
        </section>
        <?php endwhile; else: endif; ?>

        <section class="grid grid-3">
            <article class="span-2">
                <h2 class="heading-underline has-large-font-size">Published Research</h2>
                <?php $query = new WP_Query(array(
                    'post_type' => array('publication'),
                    'post_status' => 'publish',
                    'posts_per_page' => 2,
                )); ?>
                <ol class="research-archive">
                    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                    <li class="research-item">
                        <a class="card-link" href="<?php the_permalink(); ?>" title="Read More About:  <?php the_title_attribute(); ?>">
                            <div class="card-text">
                                <h3 class="card-title">
                                    <?php the_title(); ?>
                                </h3>
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
                    <? endwhile; endif; ?>
                </ol>

                <a class="button" href="publications">View All Publications</a>
            </article>
            <aside>
                <div class="cards">
                    <?php $query = new WP_Query(array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 1,
                    ));
                    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                        get_template_part( 'template-parts/blog-card', get_post_format() );
                    endwhile; else: ?>
                    <section style="grid-column: 1 / 4" class="card-section">
                        <p class="card-section-excerpt"><?php _e( 'Sorry, no posts yet!' ); ?></p>
                    </section>
                    <?php endif; ?>

                    <div class="center">
                        <a class="button" href="blog">View All Posts</a>
                    </div>
                </div>
                <div>
                    <div class="widget">
                        <?php dynamic_sidebar('mailing_list'); ?>
                    </div>
                </div>
            </aside>
        </section>
    </div>
</main>

<?php
get_footer();
?>
