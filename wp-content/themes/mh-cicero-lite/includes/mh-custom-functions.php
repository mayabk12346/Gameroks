<?php

/***** Page Title Output *****/

if (!function_exists('mh_cicero_lite_page_title')) {
	function mh_cicero_lite_page_title() {
		if (!is_front_page()) {
			echo '<h1 class="page-title content-margin content-background">';
			if (is_archive()) {
				if (is_category() || is_tax()) {
					single_cat_title();
				} elseif (is_tag()) {
					single_tag_title();
				} elseif (is_author()) {
					global $author;
					$user_info = get_userdata($author);
					printf(_x('Articles by %s', 'post author', 'mh-cicero-lite'), esc_attr($user_info->display_name));
				} elseif (is_day()) {
					echo get_the_date();
				} elseif (is_month()) {
					echo get_the_date('F Y');
				} elseif (is_year()) {
					echo get_the_date('Y');
				} elseif (is_post_type_archive()) {
					global $post;
					$post_type = get_post_type_object(get_post_type($post));
					echo $post_type->labels->name;
				} else {
					esc_html_e('Archives', 'mh-cicero-lite');
				}
			} else {
				if (is_home()) {
					echo get_the_title(get_option('page_for_posts', true));
				} elseif (is_404()) {
					esc_html_e('Page not found (404)', 'mh-cicero-lite');
				} elseif (is_search()) {
					printf(esc_html__('Search Results for %s', 'mh-cicero-lite'), esc_attr(get_search_query()));
				} else {
					the_title();
				}
			}
			echo '</h1>' . "\n";
		}
	}
}
add_action('mh_cicero_lite_before_page_content', 'mh_cicero_lite_page_title');

/***** Output Post Meta Data *****/

if (!function_exists('mh_cicero_lite_post_meta')) {
	function mh_cicero_lite_post_meta() {
		echo '<p class="entry-meta">' . "\n";
			echo '<i class="fa fa-clock-o"></i><span class="updated">' . get_the_date() . '</span>' . "\n";
			echo '<i class="fa fa-folder-open-o"></i><span class="entry-category">' . get_the_category_list(', ', '') . '</span>' . "\n";
			echo '<i class="fa fa-comment-o"></i><span>' . sprintf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments number', 'mh-cicero-lite'), number_format_i18n(get_comments_number())) . '</span>' . "\n";
		echo '</p>' . "\n";
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_cicero_lite_featured_image')) {
	function mh_cicero_lite_featured_image() {
		global $page;
		if (has_post_thumbnail() && $page == '1') {
			echo "\n" . '<figure class="entry-thumbnail">' . "\n";
				the_post_thumbnail('large-thumb');
				if (get_the_post_thumbnail_caption()) {
					echo '<i class="fa fa-info"></i>' . "\n";
					echo '<figcaption class="wp-caption-text">' . wp_kses_post(get_the_post_thumbnail_caption()) . '</figcaption>' . "\n";
				}
			echo '</figure>' . "\n";
		}
	}
}

/***** Custom Excerpts *****/

if (!function_exists('mh_cicero_lite_trim_excerpt')) {
	function mh_cicero_lite_trim_excerpt($text = '') {
		$raw_excerpt = $text;
		if ('' == $text) {
			$mh_cicero_lite_options = mh_cicero_lite_theme_options();
			$text = get_the_content('');
			$text = do_shortcode($text);
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters('excerpt_length', esc_attr($mh_cicero_lite_options['excerpt_length']));
			$excerpt_more = apply_filters('excerpt_more', '...');
			$text = wp_trim_words($text, $excerpt_length, $excerpt_more);
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'mh_cicero_lite_trim_excerpt');

/***** Custom Excerpt Length for Featured Content *****/

if (!function_exists('mh_cicero_lite_featured_excerpt_length')) {
	function mh_cicero_lite_featured_excerpt_length($length) {
    	return 20;
	}
}

/***** Pagination *****/

if (!function_exists('mh_cicero_lite_pagination')) {
	function mh_cicero_lite_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => esc_html__('&laquo;', 'mh-cicero-lite'),
	    	'next_text' => esc_html__('&raquo;', 'mh-cicero-lite'),
	    	'total' 	=> $wp_query->max_num_pages)
	    );
		if ($paginate_links) {
	    	echo '<div class="pagination loop-pagination clearfix">';
				echo $paginate_links;
			echo '</div>';
		}
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_cicero_lite_posts_pagination')) {
	function mh_cicero_lite_posts_pagination($content) {
		if (is_singular() && is_main_query()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clear">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => esc_html__('&raquo;', 'mh-cicero-lite'), 'previouspagelink' => esc_html__('&laquo;', 'mh-cicero-lite'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_cicero_lite_posts_pagination', 1);

/***** Post / Image Navigation *****/

if (!function_exists('mh_cicero_lite_postnav')) {
	function mh_cicero_lite_postnav() {
		global $post;
		$parent_post = get_post($post->post_parent);
		$attachment = is_attachment();
		$previous = ($attachment) ? $parent_post : get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);

		if (!$next && !$previous)
		return;

		if ($attachment) {
			$attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $parent_post->ID));
			$count = count($attachments);
		}
		echo '<nav class="post-nav-wrap content-margin content-background" role="navigation">' . "\n";
			echo '<ul class="post-nav clearfix">' . "\n";
				echo '<li class="post-nav-prev">' . "\n";
					if ($attachment) {
						if ($count == 1) {
							$permalink = get_permalink($parent_post);
							echo '<a href="' . $permalink . '"><i class="fa fa-chevron-left"></i>' . esc_html__('Back to post', 'mh-cicero-lite') . '</a>';
						} else {
							previous_image_link('%link', '<i class="fa fa-chevron-left"></i>' . esc_html__('Previous image', 'mh-cicero-lite'));
						}
					} else {
						previous_post_link('%link', '<i class="fa fa-chevron-left"></i>' . esc_html__('Previous post', 'mh-cicero-lite'));
					}
				echo '</li>' . "\n";
				echo '<li class="post-nav-next">' . "\n";
					if ($attachment) {
						next_image_link('%link', esc_html__('Next image', 'mh-cicero-lite') . '<i class="fa fa-chevron-right"></i>');
					} else {
						next_post_link('%link', esc_html__('Next post', 'mh-cicero-lite') . '<i class="fa fa-chevron-right"></i>');
					}
				echo '</li>' . "\n";
			echo '</ul>' . "\n";
		echo '</nav>' . "\n";
	}
}

/***** Custom Commentlist *****/

if (!function_exists('mh_cicero_lite_comments')) {
	function mh_cicero_lite_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="vcard">
					<?php echo get_avatar($comment->comment_author_email, 70); ?>
					<span class="comment-author"><?php echo get_comment_author_link() ?></span> &bull;
					<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(esc_html__('%1$s at %2$s', 'mh-cicero-lite'), get_comment_date(),  get_comment_time()) ?></a>
					<?php edit_comment_link(esc_html__('(Edit)', 'mh-cicero-lite'),'  ','') ?>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
					<div class="comment-info"><?php esc_html_e('Your comment is awaiting moderation.', 'mh-cicero-lite') ?></div>
				<?php endif; ?>
				<div class="comment-text">
					<?php comment_text() ?>
					<?php if (comments_open() && $args['max_depth'] != $depth) { ?>
						<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					<?php } ?>
				</div>
			</div><?php
	}
}

/***** Add CSS classes to body tag *****/

if (!function_exists('mh_cicero_lite_body_class')) {
	function mh_cicero_lite_body_class($classes) {
		$mh_cicero_lite_options = mh_cicero_lite_theme_options();
		$classes[] = 'mh-' . esc_attr($mh_cicero_lite_options['sidebar']) . '-sb';
		return $classes;
	}
}
add_filter('body_class', 'mh_cicero_lite_body_class');

/***** Logo / Header Image Fallback *****/

if (!function_exists('mh_cicero_lite_logo')) {
	function mh_cicero_lite_logo() {
		$header_img = get_header_image();
		$header_title = get_bloginfo('name');
		if ($header_img || display_header_text()) {
			echo '<div class="logo" role="banner">' . "\n";
				echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr($header_title) . '" rel="home">' . "\n";
					if ($header_img) {
						echo '<img src="' . esc_url($header_img) . '" height="' . get_custom_header()->height . '" width="' . get_custom_header()->width . '" alt="' . esc_attr($header_title) . '" />' . "\n";
					} else {
						$text_color = get_header_textcolor();
						if ($text_color != get_theme_support('custom-header', 'default-text-color')) {
							echo '<style type="text/css" id="mh-header-css">';
								echo '.logo-name { color: #' . esc_attr($text_color) . '; }';
							echo '</style>' . "\n";
						}
						echo '<div class="logo-text">' . "\n";
							if ($header_title) {
								if (is_home() || is_front_page()) {
									$before_title = '<h1 class="logo-name">';
									$after_title = '</h1>';
								} else {
									$before_title = '<p class="logo-name">';
									$after_title = '</p>';
								}
								echo $before_title . esc_attr($header_title) . $after_title . "\n";
							}
						echo '</div>' . "\n";
					}
				echo '</a>' . "\n";
			echo '</div>' . "\n";
		}
	}
}

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_cicero_lite_ie_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_cicero_lite_ie_media_queries');

?>