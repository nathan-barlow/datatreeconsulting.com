<li class="card">
    <figure class="card-figure">
        <?php the_post_thumbnail('card-small'); ?>
    </figure>
    <div class="card-text">
        <?php $treetype = get_the_terms(get_the_ID(), 'tree-type')[0]->name;

        if($treetype) {
            echo '<p class="blog-category">' . $treetype . '</p>';
        }?>
        <h2 class="card-title">
            <?php the_title(); ?>
        </h2>
        <p class="card-excerpt">
            Price: <span class="c-color-dark"><?php echo get_field('price') ?></span> <br>
            Available: <span class="c-color-dark"><?php echo get_field('available') ?></span>
        </p>
    </div>
</li>