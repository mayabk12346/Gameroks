<?php /* Comments Template */
if (post_password_required()) {
	return;
}
if (comments_open() || have_comments()) { ?>
	<div class="comment-section">
		<h4 class="comment-section-title"><?php comments_number(esc_html__('No Comments, Be The First!', 'mh-cicero-lite'), esc_html__('1 Comment', 'mh-cicero-lite'), esc_html__('% Comments', 'mh-cicero-lite')); ?></h4> <?php
}
if (have_comments()) { ?>
	<ol class="commentlist">
		<?php echo wp_list_comments('callback=mh_cicero_lite_comments'); ?>
	</ol>
	<?php if (get_comments_number() > get_option('comments_per_page')) { ?>
		<div class="comments-pagination content-margin">
			<?php paginate_comments_links(array('prev_text' => esc_html__('&laquo;', 'mh-cicero-lite'), 'next_text' => esc_html__('&raquo;', 'mh-cicero-lite'))); ?>
		</div>
	<?php } ?>
	<?php if (!comments_open()) { ?>
		<p class="no-comments"><?php esc_html_e('Comments are closed.', 'mh-cicero-lite'); ?></p>
	<?php }
}
if (comments_open() || have_comments()) { ?>
	</div> <?php
}
if (comments_open()) {
	$commenter = wp_get_current_commenter();
	$req = get_option('require_name_email');
	$aria_req = ($req ? " aria-required='true'" : '');
	$consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
	$custom_args = array(
    	'title_reply' 			=> '',
    	'title_reply_to' 		=> esc_html__('Leave a Reply to %s', 'mh-cicero-lite'),
        'comment_notes_before' 	=> '<p class="comment-notes">' . esc_html__('Your email address will not be published.', 'mh-cicero-lite') . '</p>',
        'comment_notes_after'  	=> '',
        'id_submit' 			=> 'comment-submit',
        'label_submit' 			=> esc_html__('Send Comment', 'mh-cicero-lite'),
        'comment_field' 		=> '<textarea id="comment" name="comment" placeholder="' . esc_html__('Enter Message Here', 'mh-cicero-lite') . '" class="comment-text-area" cols="45" rows="5" aria-required="true"></textarea></p>',
        'fields' 				=> apply_filters( 'comment_form_default_fields', array(
			'author'	=>	'<input type="text" id="author" name="author" placeholder="' . esc_html__('Enter Name', 'mh-cicero-lite') . '" class="comment-name" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' />',
			'email' 	=>	'<input type="text" id="email" name="email" placeholder="' . esc_html__('Enter Email', 'mh-cicero-lite') . '" class="comment-email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' />',
			'url' 		=>	'<input type="text" id="url" name="url" placeholder="' . esc_html__('Enter URL', 'mh-cicero-lite') . '" class="comment-url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" />',
			'cookies' 	=>  '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">' . esc_html__('Save my name, email, and website in this browser for the next time I comment.', 'mh-cicero-lite') . '</label></p>'
		))
    );
	comment_form($custom_args);
}
?>