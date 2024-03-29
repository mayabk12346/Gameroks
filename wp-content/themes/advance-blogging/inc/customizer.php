<?php
/**
 * Advance Blogging Theme Customizer
 *
 * @package Advance Blogging
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function advance_blogging_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'advance_blogging_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'advance-blogging' ),
	    'description' => __( 'Description of what this panel does.', 'advance-blogging' )
	) );

	//Layouts
	$wp_customize->add_section( 'advance_blogging_left_right', array(
    	'title'      => __( 'Theme Layout Settings', 'advance-blogging' ),
		'priority'   => 30,
		'panel' => 'advance_blogging_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('advance_blogging_theme_options',array(
        'default' => '',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	)  );

	$wp_customize->add_control('advance_blogging_theme_options',
	    array(
	        'type' => 'radio',
	        'label' => __('Do you want this section','advance-blogging'),
	        'section' => 'advance_blogging_left_right',
	        'choices' => array(
	            'Left Sidebar' => __('Left Sidebar','advance-blogging'),
	            'Right Sidebar' => __('Right Sidebar','advance-blogging'),
	            'One Column' => __('One Column','advance-blogging'),
	            'Three Columns' => __('Three Columns','advance-blogging'),
	            'Four Columns' => __('Four Columns','advance-blogging'),
	            'Grid Layout' => __('Grid Layout','advance-blogging')
	        ),
	    )
    );

    $font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Kavoon' =>'Kavoon',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//add home page setting pannel
	$wp_customize->add_panel( 'advance_blogging_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'advance-blogging' ),
	    'description' => __( 'Description of what this panel does.', 'advance-blogging' )
	) );

	//Color / Font Pallete
	$wp_customize->add_section( 'advance_blogging_typography', array(
    	'title'      => __( 'Color / Font Pallete', 'advance-blogging' ),
		'priority'   => 30,
		'panel' => 'advance_blogging_panel_id'
	) );

	// Add the Theme Color Option section.
	$wp_customize->add_setting( 'advance_blogging_theme_color', array(
	    'default' => '#db0607',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_theme_color', array(
  		'label' => 'Theme Color Option',
	    'section' => 'advance_blogging_typography',
	    'settings' => 'advance_blogging_theme_color',
  	)));
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'advance_blogging_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_paragraph_color', array(
		'label' => __('Paragraph Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_paragraph_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'Paragraph Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	$wp_customize->add_setting('advance_blogging_paragraph_font_size',array(
		'default'	=> '12px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'advance_blogging_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_atag_color', array(
		'label' => __('"a" Tag Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_atag_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( '"a" Tag Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'advance_blogging_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_li_color', array(
		'label' => __('"li" Tag Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_li_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( '"li" Tag Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h1_color', array(
		'label' => __('H1 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h1_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'H1 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('advance_blogging_h1_font_size',array(
		'default'	=> '50px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_h1_font_size',array(
		'label'	=> __('H1 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h2_color', array(
		'label' => __('h2 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h2_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h2 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('advance_blogging_h2_font_size',array(
		'default'	=> '45px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_h2_font_size',array(
		'label'	=> __('h2 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h3_color', array(
		'label' => __('h3 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h3_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h3 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('advance_blogging_h3_font_size',array(
		'default'	=> '36px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_h3_font_size',array(
		'label'	=> __('h3 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h4_color', array(
		'label' => __('h4 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h4_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h4 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('advance_blogging_h4_font_size',array(
		'default'	=> '30px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_h4_font_size',array(
		'label'	=> __('h4 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h5_color', array(
		'label' => __('h5 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h5_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h5 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('advance_blogging_h5_font_size',array(
		'default'	=> '25px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_h5_font_size',array(
		'label'	=> __('h5 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h6_color', array(
		'label' => __('h6 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h6_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h6 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('advance_blogging_h6_font_size',array(
		'default'	=> '18px',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('advance_blogging_h6_font_size',array(
		'label'	=> __('h6 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h6_font_size',
		'type'	=> 'text'
	));
  	
	//Top Header
	$wp_customize->add_section('advance_blogging_topbar_header',array(
		'title'	=> __('Top Header','advance-blogging'),
		'description'	=> __('Add Header Content here','advance-blogging'),
		'priority'	=> null,
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_facebook_url',array(
		'label'	=> __('Add Facebook link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_twitter_url',array(
		'label'	=> __('Add Twitter link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_googleplus_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_googleplus_url',array(
		'label'	=> __('Add Google Plus link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_googleplus_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_pinterest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_pinterest_url',array(
		'label'	=> __('Add Pinterest link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_pinterest_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_linkedin_url',array(
		'label'	=> __('Add Linkedin link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_insta_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_insta_url',array(
		'label'	=> __('Add Instagram link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_insta_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_youtube_url',array(
		'label'	=> __('Add Youtube link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_youtube_url',
		'type'		=> 'url'
	));

	//home page slider
	$wp_customize->add_section( 'advance_blogging_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'advance-blogging' ),
		'priority'   => null,
		'panel' => 'advance_blogging_panel_id'
	) );

	$wp_customize->add_setting('advance_blogging_slider_arrows',array(
      'default' => 'false',
      'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_slider_arrows',array(
	      'type' => 'checkbox',
	      'label' => __('Show / Hide slider','advance-blogging'),
	      'section' => 'advance_blogging_slider_section',
	));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'advance_blogging_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'advance_blogging_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'advance_blogging_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'advance-blogging' ),
			'section'  => 'advance_blogging_slider_section',
			'description' => 'Background Image Size (900x450 )',
			'type'     => 'dropdown-pages'
		) );
	}

	// Category Post
	$wp_customize->add_section('advance_blogging_category_post',array(
		'title'	=> __('Category Post','advance-blogging'),
		'description'=> __('This section will appear on the right side of slider.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('advance_blogging_blogcategory_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('advance_blogging_blogcategory_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','advance-blogging'),
			'description' => 'Category Image Size (300x225 )',
		'section' => 'advance_blogging_category_post',
	));

	// Latest Post
	$wp_customize->add_section('advance_blogging_latest_post',array(
		'title'	=> __('Latest Post','advance-blogging'),
		'description'=> __('This section will appear below the slider.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
	if($i==0){
	$default = $category->slug;
	$i++;
	}
	$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('advance_blogging_latest_post_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('advance_blogging_latest_post_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','advance-blogging'),
		'section' => 'advance_blogging_latest_post',
	));

	//Footer
	$wp_customize->add_section('advance_blogging_footer',array(
		'title'	=> __('Footer Text','advance-blogging'),
		'description'=> __('This section will appear in the .','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_footer_copy',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('advance_blogging_footer_copy',array(
		'label'	=> __('Text','advance-blogging'),
		'section'=> 'advance_blogging_footer',
		'setting'=> 'advance_blogging_footer_copy',
		'type'=> 'text'
	));	
}
add_action( 'customize_register', 'advance_blogging_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Advance_Blogging_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );
		
		// Register custom section types.
		$manager->register_section_type( 'Advance_Blogging_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Advance_Blogging_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Advance Blogging', 'advance-blogging' ),
					'pro_text' => esc_html__( 'Go Pro',  'advance-blogging' ),
					'pro_url'  => esc_url( 'https://www.themescaliber.com/themes/blog-wordpress-theme/' ),
		 		)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'advance-blogging-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'advance-blogging-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Advance_Blogging_Customize::get_instance();