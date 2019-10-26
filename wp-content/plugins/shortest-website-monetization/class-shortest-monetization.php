<?php
/**
 * Shortest Monetization Plugin.
 *
 * @package   Shortest_Monetization
 * @author    Dawid Chomicz <chomicz@shorte.st>
 * @license   GPL-2.0+
 * @link      https://shorte.st
 * @copyright 2016 Shortest
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 */
class Shortest_Monetization
{
    /** Front page script selection type include */
    const FPS_SELECTION_TYPE_INCLUDE = 1;
    /** Front page script selection type eclude */
    const FPS_SELECTION_TYPE_EXCLUDE = 2;
    /** Entry script type click */
    const ES_TYPE_CLICK = 1;
    /** Entry script type timeout */
    const ES_TYPE_TIMEOUT = 2;

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.2.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'shortest-website-monetization';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		/* Define custom functionality.
		 * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
        add_action('wp_head', array($this, 'extend_head'));

        if( class_exists( 'WP_Http' ) ) {
            add_option('shst_api_ready', true);
        } else {
            add_option('shst_api_ready', false);
        }

	}

    /**
     * Set Default Options
     */
    private static function set_options(array $defaults)
    {
        foreach($defaults as $key => $value) {
            add_option($key, $value);
        }
    }

    /**
     * @return array
     */
    public static function get_default_options()
    {
        $current_site = parse_url(site_url());
        $current_user = wp_get_current_user();
        $defaults = array(
            'shst_email' => '',
            'shst_token' => '',
            'shst_fps_enabled' => true,
            'shst_fps_domains_list' => $current_site['host'],
            'shst_fps_selection_type' => self::FPS_SELECTION_TYPE_EXCLUDE,
            'shst_fps_capping_enabled' => false,
            'shst_fps_capping_limit' => 1,
            'shst_fps_capping_timeout' => 1,
            'shst_es_enabled' => false,
            'shst_es_type' => self::ES_TYPE_TIMEOUT,
            'shst_es_timeout' => 3000,
            'shst_es_capping_enabled' => false,
            'shst_es_capping_limit' => 1,
            'shst_es_capping_timeout' => 1,
            'shst_exs_enabled' => 1,
            'shst_email_changed' => 1,
            'shst_pop_enabled' => true,
            'shst_connection_method' => 'email'
        );

        return $defaults;
    }

    /**
     * Get API Token by email
     *
     * @return null
     */
    public static function get_api_token()
    {
        $email = get_option('shst_email');
        $connectionMethod = get_option('shst_connection_method');
        $formWasSaved = get_option('shst_email_changed');

        if ($formWasSaved && $connectionMethod == 'email' && get_option('shst_api_ready') && $email) {
            $request = new WP_Http;
            $result = $request->request(sprintf("https://api.shorte.st/users/%s/token", trim($email)));
            if ($result and !($result instanceof WP_Error)) {
                update_option('shst_token', $result['body']);
            }
        }

        if ($formWasSaved) {
            update_option('shst_email_changed', 0);
        }

        if ($formWasSaved && $connectionMethod == 'token' && $email) {
            update_option('shst_email', '');
        }

        if ($formWasSaved && $connectionMethod == 'email' && empty($email) && get_option('shst_token')) {
            update_option('shst_token', '');
        }
    }

    /**
     * Extend site head
     */
    public function extend_head()
    {
        include_once('views/public.php');
    }

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return   string Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

    /**
     * Get Entry script type name
     *
     * @param integer $type_value Type Value
     *
     * @return string Type name
     */
    public static function get_es_type_name($type_value) {
        if (intval($type_value) === self::ES_TYPE_CLICK) {
            return 'click';
        }

        if (intval($type_value) === self::ES_TYPE_TIMEOUT) {
            return 'timeout';
        }

        return '';
    }

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate()
    {
        if (get_option('shst_op_default_set' ) === false) {
            //Full Page Script defaults
            self::set_options(self::get_default_options());

            add_option('shst_op_default_set', true);
        }
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
        delete_option('shst_op_default_set');
        foreach (self::get_default_options() as $option_name => $option_value) {
            delete_option($option_name);
        }
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}
}
