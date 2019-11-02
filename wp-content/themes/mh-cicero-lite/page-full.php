<?php /* Template Name: Page - Full Width */ ?>
<?php get_header(); ?>
<div class="mh-content-section clearfix">
   	<?php while (have_posts()) : the_post(); ?>
    	<header class="page-title-wrap content-background">
    	 	<h1 class="page-title"><?php the_title(); ?></h1>
    	</header>
		<?php get_template_part('content', 'page'); ?>
		<?php comments_template(); ?>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>