<?php get_header(); ?>
<div class="container">
    <div class="archive-box">
		<div class="content-text">
        <span><?php esc_html_e( 'Search results for', 'natalielite' ); ?>:&nbsp;</span>
        	<h4><?php echo get_search_query(); ?></h4>
        </div>
        <div class="bg-overlay"></div>
	</div>
    <div class="row">
        <div class="col-md-9 col-sm-8">
            <?php get_template_part('loop/blog', 'standard');  ?>
        </div>
        <div class="col-md-3 col-sm-4 sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>