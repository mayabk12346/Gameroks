<?php get_header(); ?>
    <div class="az-single-has-sidebar">
        <div class="row">
            <div class="col-md-9 col-sm-8">
            <?php
                while ( have_posts() ) {
                    the_post();
                    get_template_part('template-parts/content');
                }
            ?>
            </div>
            <div class="col-md-3 col-sm-4 sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
