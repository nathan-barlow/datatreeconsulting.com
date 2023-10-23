<li class="card">
    <a class="card-link" href="<?php the_permalink(); ?>" title="Read More About:  <?php the_title_attribute(); ?>">
        <figure class="card-figure">
            <?php the_post_thumbnail('card-small'); ?>
        </figure>
        <div class="card-text">
            <?php $categories = get_the_category();
            if(!empty( $categories )) {
                echo '<p class="blog-category">' . $categories[0]->name . '</p>';
            }?>
            <h3 class="card-title">
                <?php the_title(); ?>
            </h3>
            <span class="card-excerpt">
                <?php the_excerpt(); ?>
            </span>
        </div>
    </a>
</li>