<?php

/***** MH Custom Posts *****/

class mh_cicero_lite_custom_posts_widget extends WP_Widget {
    function __construct() {
		parent::__construct(
			'mh_custom_posts', esc_html_x('MH Custom Posts (lite)', 'widget name', 'mh-cicero-lite'),
			array(
				'classname' => 'mh_custom_posts',
				'description' => esc_html__('MH Custom Posts Widget to display posts in your sidebar.', 'mh-cicero-lite'),
				'customize_selective_refresh' => true
			)
		);
	}
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $category = isset($instance['category']) ? $instance['category'] : '';
        $postcount = empty($instance['postcount']) ? '5' : $instance['postcount'];
        $sticky = isset($instance['sticky']) ? $instance['sticky'] : 0;

        echo $before_widget;
        if (!empty($title)) { echo $before_title . $title . $after_title; } ?>
        <ul class="cp-widget clearfix"> <?php
		$args = array('posts_per_page' => $postcount, 'cat' => $category, 'ignore_sticky_posts' => $sticky);
		$widget_loop = new WP_Query($args);
		while ($widget_loop->have_posts()) : $widget_loop->the_post(); ?>
			<li class="cp-item clearfix">
				<div class="cp-thumb image-frame"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php if (has_post_thumbnail()) { the_post_thumbnail('small-thumb'); } else { echo '<img src="' . get_template_directory_uri() . '/images/noimage-small.png' . '" alt="No Picture" />'; } ?></a></div>
				<div class="cp-data">
					<p class="cp-widget-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
					<p class="meta"><?php echo get_the_date(); ?></p>
				</div>
			</li><?php
		endwhile;
		wp_reset_postdata(); ?>
        </ul><?php
        echo $after_widget;
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['category'] = absint($new_instance['category']);
        $instance['postcount'] = absint($new_instance['postcount']);
        $instance['sticky'] = isset($new_instance['sticky']) ? strip_tags($new_instance['sticky']) : '';
        return $instance;
    }
    function form($instance) {
        $defaults = array('title' => '', 'category' => '', 'postcount' => '5', 'sticky' => 0);
        $instance = wp_parse_args((array) $instance, $defaults); ?>

        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', 'mh-cicero-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e('Select a Category:', 'mh-cicero-lite'); ?></label>
			<select id="<?php echo $this->get_field_id('category'); ?>" class="widefat" name="<?php echo $this->get_field_name('category'); ?>">
				<option value="0" <?php if (!$instance['category']) echo 'selected="selected"'; ?>><?php esc_html_e('All', 'mh-cicero-lite'); ?></option>
				<?php
				$categories = get_categories(array('type' => 'post'));
				foreach($categories as $cat) {
					echo '<option value="' . $cat->cat_ID . '"';
					if ($cat->cat_ID == $instance['category']) { echo ' selected="selected"'; }
					echo '>' . $cat->cat_name . ' (' . $cat->category_count . ')';
					echo '</option>';
				}
				?>
			</select>
		</p>
	    <p>
        	<label for="<?php echo $this->get_field_id('postcount'); ?>"><?php esc_html_e('Limit Post Number:', 'mh-cicero-lite'); ?></label>
			<input class="widefat" type="text" value="<?php echo esc_attr($instance['postcount']); ?>" name="<?php echo $this->get_field_name('postcount'); ?>" id="<?php echo $this->get_field_id('postcount'); ?>" />
	    </p>
        <p>
      		<input id="<?php echo $this->get_field_id('sticky'); ?>" name="<?php echo $this->get_field_name('sticky'); ?>" type="checkbox" value="1" <?php checked('1', $instance['sticky']); ?>/>
	  		<label for="<?php echo $this->get_field_id('sticky'); ?>"><?php esc_html_e('Ignore Sticky Posts', 'mh-cicero-lite'); ?></label>
    	</p>
    	<p>
    		<strong><?php _e('Info:', 'mh-cicero-lite'); ?></strong> <?php esc_html_e('This is the lite version of this widget with basic features. If you need more professional features and options, you can upgrade to the premium version of this theme.', 'mh-cicero-lite'); ?>
    	</p><?php
    }
}

?>