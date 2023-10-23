<?php 
    if(get_field('publication_url')) {
        $post_url = get_field('publication_url');
    } else {
        $post_url = get_permalink();
    }

?>
<li class="card">
    <a class="card-link" href="<?php echo $post_url; ?>" title="Read More About:  <?php the_title_attribute(); ?>">
        <figure class="card-figure">
            <?php the_post_thumbnail('card-small'); ?>
        </figure>
        <div class="card-text">
            <h3 class="card-title">
                <?php the_title(); ?>
            </h3>
            <p>
                <?php the_excerpt(); ?>
            </p>
        </div>
    </a>
</li>