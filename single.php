
<?php
get_header();
?>
<main class="single">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="wrapper grid grid-3">
        <div class="span-2">
            <figure class="blog-title-image">
                <?php the_post_thumbnail( 'card-large' ) ?>
            </figure>
            <section>
                <?php $categories = get_the_category();
                if(!empty( $categories )) {
                    echo '<p class="blog-category">' . $categories[0]->name . '</p>';
                }?>
                <h1 class="left"><?php the_title(); ?></h1>
                <?php the_content(); ?>

                <hr>

                <div class="research-meta">
                    <p class="c-color-neutral-600">
                        <?php echo get_the_date( 'F Y' ) ?>
                    </p>
                    <?php $tags = get_the_tags();
                    if( $tags ) { ?>
                        <ul class="tags">
                            <?php foreach ($tags as $tag) {
                                echo "<li><a href='/tag/" . $tag->slug . "'>" . $tag->name . "</a></li>";
                            }?>
                        </ul>
                    <?php } ?>
                </div>
            </section>
            <?php endwhile; else: endif; ?>
        </div>
        <aside>
            <div class="widget">
                <?php dynamic_sidebar('mailing_list'); ?>
            </div>
            <div class="widget">
                <?php dynamic_sidebar( 'recent-posts' ) ?>
            </div>
        </aside>
    </div>
    <div class="wrapper comments">
        <?php comments_template( '', true ); ?>
    </div>
</main>

<?php
get_footer();
?>
