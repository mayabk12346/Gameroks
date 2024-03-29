<?php

function mh_cicero_lite_customize_register($wp_customize) {

	/***** Register Custom Controls *****/

	class MH_Cicero_Lite_Upgrade extends WP_Customize_Control {
        public function render_content() {  ?>
        	<p class="mh-upgrade-thumb">
        		<img src="<?php echo get_template_directory_uri(); ?>/images/mh_cicero.png" />
        	</p>
        	<p class="customize-control-title mh-upgrade-title">
        		<?php esc_html_e('MH Cicero Pro', 'mh-cicero-lite'); ?>
        	</p>
        	<p class="textfield mh-upgrade-text">
        		<?php esc_html_e('If you like the free version of this theme, you will LOVE the full version of MH Cicero which includes unique custom widgets, additional features and more useful options to customize your website.', 'mh-cicero-lite'); ?>
			</p>
			<p class="customize-control-title mh-upgrade-title">
        		<?php esc_html_e('Additional Features:', 'mh-cicero-lite'); ?>
        	</p>
        	<ul class="mh-upgrade-features">
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Options to modify color scheme', 'mh-cicero-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Typography options', 'mh-cicero-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Additional custom widgets', 'mh-cicero-lite'); ?>
	        	</li>
	        	<li class="mh-upgrade-feature-item">
	        		<?php esc_html_e('Social buttons, related articles, and more...', 'mh-cicero-lite'); ?>
	        	</li>
        	</ul>
			<p class="mh-button mh-upgrade-button">
				<a href="https://www.mhthemes.com/themes/mh/cicero/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Upgrade to MH Cicero Pro', 'mh-cicero-lite'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/themes/showcase/" target="_blank" class="button button-secondary">
					<?php esc_html_e('MH Themes Showcase', 'mh-cicero-lite'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://www.mhthemes.com/support/documentation-mh-cicero/" target="_blank" class="button button-secondary">
					<?php esc_html_e('Theme Documentation', 'mh-cicero-lite'); ?>
				</a>
			</p>
			<p class="mh-button">
				<a href="https://wordpress.org/support/theme/mh-cicero-lite" target="_blank" class="button button-secondary">
					<?php esc_html_e('Support Forum', 'mh-cicero-lite'); ?>
				</a>
			</p><?php
        }
    }

	/***** Add Panels *****/

	$wp_customize->add_panel('mh_theme_options', array('title' => esc_html__('Theme Options', 'mh-cicero-lite'), 'description' => '', 'capability' => 'edit_theme_options', 'theme_supports' => '', 'priority' => 1,));

	/***** Add Sections *****/

	$wp_customize->add_section('mh_cicero_lite_general', array('title' => esc_html__('General', 'mh-cicero-lite'), 'priority' => 1, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_cicero_lite_layout', array('title' => esc_html__('Layout', 'mh-cicero-lite'), 'priority' => 2, 'panel' => 'mh_theme_options'));
	$wp_customize->add_section('mh_cicero_lite_upgrade', array('title' => esc_html__('More Features', 'mh-cicero-lite'), 'priority' => 3, 'panel' => 'mh_theme_options'));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_cicero_lite_options[excerpt_length]', array('default' => 50, 'type' => 'option', 'sanitize_callback' => 'mh_cicero_lite_sanitize_integer'));
    $wp_customize->add_setting('mh_cicero_lite_options[excerpt_more]', array('default' => esc_html__('Read More', 'mh-cicero-lite'), 'type' => 'option', 'sanitize_callback' => 'mh_cicero_lite_sanitize_text'));
    $wp_customize->add_setting('mh_cicero_lite_options[sidebar]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_cicero_lite_sanitize_select'));
	$wp_customize->add_setting('mh_cicero_lite_options[premium_version_upgrade]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => esc_html__('Custom Excerpt Length in Words', 'mh-cicero-lite'), 'section' => 'mh_cicero_lite_general', 'settings' => 'mh_cicero_lite_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => esc_html__('Custom Excerpt More-Text', 'mh-cicero-lite'), 'section' => 'mh_cicero_lite_general', 'settings' => 'mh_cicero_lite_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('sidebar', array('label' => esc_html__('Sidebar', 'mh-cicero-lite'), 'section' => 'mh_cicero_lite_layout', 'settings' => 'mh_cicero_lite_options[sidebar]', 'priority' => 1, 'type' => 'select', 'choices' => array('right' => esc_html__('Right Sidebar', 'mh-cicero-lite'), 'left' => esc_html__('Left Sidebar', 'mh-cicero-lite'))));
	$wp_customize->add_control(new MH_Cicero_Lite_Upgrade($wp_customize, 'premium_version_upgrade', array('section' => 'mh_cicero_lite_upgrade', 'settings' => 'mh_cicero_lite_options[premium_version_upgrade]', 'priority' => 1)));
}
add_action('customize_register', 'mh_cicero_lite_customize_register');

/***** Data Sanitization *****/

function mh_cicero_lite_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_cicero_lite_sanitize_integer($input) {
    return strip_tags(intval($input));
}
function mh_cicero_lite_sanitize_select($input) {
    $valid = array(
        'right' => esc_html__('Right Sidebar', 'mh-cicero-lite'),
        'left' => esc_html__('Left Sidebar', 'mh-cicero-lite')
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_cicero_lite_theme_options')) {
	function mh_cicero_lite_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_cicero_lite_options', array()),
			mh_cicero_lite_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_cicero_lite_default_options')) {
	function mh_cicero_lite_default_options() {
		$default_options = array(
			'excerpt_length' => 50,
			'excerpt_more' => __('Read More', 'mh-cicero-lite'),
			'sidebar' => 'right'
		);
		return $default_options;
	}
}

/***** Enqueue Customizer CSS *****/

function mh_cicero_lite_customizer_css() {
	wp_enqueue_style('mh-customizer', get_template_directory_uri() . '/admin/customizer.css', array());
}
add_action('customize_controls_print_styles', 'mh_cicero_lite_customizer_css');

?>