<?php
/**
 * Related Posts for full post
 * @package Blog_Writer
*/
?>


<?php $related_posts = blog_writer_related_posts(); 
 if ( $related_posts->have_posts() ): ?>

<h4 id="related-posts-heading"><span><?php esc_html_e('You may also like these posts', 'blog-writer'); ?></span></h4>

<ul id="related-posts" class="row">
   <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
  
	<li class="col-lg-4">
		<a href="<?php esc_url(the_permalink()); ?>" title="<?php the_title(); ?>">
			<?php if ( has_post_thumbnail() ): ?>
				<div id="related-posts-thumbnail">          
			<?php the_post_thumbnail('blog-writer-related-posts'); ?>         
				</div>
			<?php else: ?>
				<div id="related-posts-thumbnail">          
					<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/no-related.png" alt="<?php esc_attr_e( 'related-post', 'blog-writer');?>"/>          
				</div>
			<?php endif; ?>
			<div id="related-posts-content">
				<h3 id="related-posts-title">
				<?php the_title(); ?>
				</h3>
			</div>
		</a>
	</li>
	
   <?php endwhile; ?>
</ul>

<?php endif; 
 wp_reset_postdata(); ?>