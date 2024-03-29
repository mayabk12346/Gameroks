<?php /* Template for author box */ ?>
<?php $author_ID = get_the_author_meta('ID'); ?>
<?php if (!is_attachment() && get_the_author_meta('description', $author_ID)) { ?>
	<?php $name = get_the_author_meta('display_name', $author_ID); ?>
	<section class="author-box content-margin content-background clearfix">
		<div class="author-box-avatar image-frame"><a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>"><?php echo get_avatar($author_ID, 100); ?></a></div>
		<h5 class="author-box-name"><a href="<?php echo esc_url(get_author_posts_url($author_ID)); ?>"><?php printf(esc_html__('About %s', 'mh-cicero-lite'), esc_attr($name)); ?></a></h5>
		<div class="author-box-desc"><?php echo wp_kses_post(get_the_author_meta('description', $author_ID)); ?></div>
	</section>
<?php } ?>