<?php

/***** Register Widgets *****/

function mh_cicero_lite_register_widgets() {
	register_widget('mh_cicero_lite_custom_posts_widget');
}
add_action('widgets_init', 'mh_cicero_lite_register_widgets');

/***** Include Widgets *****/

require_once('widgets/mh-custom-posts.php');

?>