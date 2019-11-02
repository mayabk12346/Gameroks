<?php get_header(); ?>
<div class="mh-content-section clearfix">
	<div id="main-content"><?php
		while (have_posts()) : the_post();
			get_template_part('content', 'single');
			mh_cicero_lite_postnav();
			get_template_part('template', 'authorbox');
			comments_template();
		endwhile; ?>
	</div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>