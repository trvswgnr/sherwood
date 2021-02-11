<?php
/**
 * Theme Setup Class
 *
 * @package sherwood
 */

/**
 * Theme Setup
 */
class Theme {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->set_vars();
		add_action(
			'wp_enqueue_scripts',
			function() {
				$this->styles();
				$this->scripts();
				wp_dequeue_style( 'wp-block-library' );
			}
		);
		$this->clean_head();
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
		add_action( 'customize_register', array( $this, 'customizer' ) );
		add_filter(
			'excerpt_length',
			function( $length ) {
				return 20;
			}
		);
		add_filter( 'body_class', array( $this, 'add_slug_body_class' ) );
		add_filter( 'upload_mimes', function($mimes) {
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		} );
		add_action( 'admin_head', function() {
			echo '<style type="text/css">
				.attachment-266x266, .thumbnail img {
					width: 100% !important;
					height: auto !important;
				}
				</style>';
		} );
		add_filter( 'body_class', array( $this, 'conditional_classes' ) );

		add_filter( 'get_the_archive_title', array( $this, 'emma_archive_title' ), 10, 3 );
	}

	function emma_archive_title ($title, $original_title, $prefix) {
		return str_replace($prefix, '', $title);
	}

	public function set_vars() {
		$this->theme   = wp_get_theme();
		$this->version = $this->theme->get( 'Version' );
	}

	public static function get_asset_version( $path ) {
		return filemtime( get_template_directory() . '/' . ltrim( $path, '/' ) );
	}

	/**
	 * Front-end Styles
	 */
	public function styles() {
		// add main stylesheet with dynamic versioning based on modified date.
		$handle = 'main-style';
		$ver    = '1.' . filemtime( get_template_directory() . '/assets/css/main.css' );
		$src    = get_template_directory_uri() . '/assets/css/main.css?ver=' . $ver;
		$deps   = array();
		$media  = 'all';
		wp_enqueue_style(
			$handle,
			$src,
			$deps,
			"$ver",
			$media
		);
	}

	/**
	 * Front-end Scripts
	 */
	public function scripts() {
		// @note(travis): if no scripts have jquery as a dependency then WP will not load jquery.
		// add main script file.
		$file = '/assets/js/index.js';
		$version = $this->get_asset_version($file);
		wp_enqueue_script(
			'main',
			get_template_directory_uri() . $file . '?ver=' . $version,
			array(),
			$version,
			true
		);
	}

	/**
	 * Theme Support
	 */
	public function theme_support() {
		// translation support.
		load_theme_textdomain( 'emma' );

		// default posts and comments RSS feed links in head.
		add_theme_support( 'automatic-feed-links' );

		// dynamic title tags.
		add_theme_support( 'title-tag' );
		add_filter(
			'document_title_separator',
			function() {
				return '|';
			}
		);

		// switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		// featured images.
		add_theme_support( 'post-thumbnails' );

		// full and wide align images.
		add_theme_support( 'align-wide' );

		// adds `async` and `defer` support for scripts registered or enqueued by the theme.
		$loader = new Script_Loader();
		add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

		// wp nav menu.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary', 'emma' ),
				'mobile'  => esc_html__( 'Mobile', 'emma' ),
			)
		);

		// add ACF options page.
		// usage within template file: the_field( 'some_field', 'option' ).
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page();
		}
	}

	/**
	 * Front-end Styles
	 */
	public function admin_styles() {
		// add main stylesheet with dynamic versioning based on modified date.
		$handle = 'admin-style';
		$ver    = '1.' . filemtime( get_stylesheet_directory() . '/admin/style.css' );
		$src    = get_stylesheet_directory_uri() . '/admin/style.css?ver=' . $ver;
		$deps   = array();
		$media  = 'all';
		wp_enqueue_style(
			$handle,
			$src,
			$deps,
			"$ver",
			$media
		);
	}

	/**
	 * Get Rid of Extra Junk in <head>
	 */
	public function clean_head() {
		// remove wp emoji.
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// remove all the RSS feed links.
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		// remove dns-prefetch, preconnect, prefetch, and prerender.
		remove_action( 'wp_head', 'wp_resource_hints', 2 );

		// remove link header for the REST API.
		remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

		// remove REST API link tag.
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

		// remove discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

		// remove WordPress page/post shortlinks.
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );

		// remove Weblog Client Link.
		remove_action( 'wp_head', 'rsd_link' );

		// remove Windows Live Writer Manifest Link.
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// remove WordPress Generator.
		remove_action( 'wp_head', 'wp_generator' );

		// remove adjacent post links.
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

		// remove WP Embed.
		add_action(
			'wp_footer',
			function() {
				wp_deregister_script( 'wp-embed' );
			}
		);
	}

	/**
	 * Customizer Settings
	 *
	 * @param Object $wp_customize Customizer object.
	 */
	public function customizer( $wp_customize ) {
		$args = array(
			'label'    => 'Upload Logo',
			'section'  => 'title_tagline',
			'settings' => 'theme_logo',
		);

		// add a setting for the site logo.
		$wp_customize->add_setting( $args['settings'] );

		// add a control to upload the logo.
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$args['settings'],
				$args
			)
		);
	}

	/**
	 * Remove Empty Paragraph Tags
	 */
	public static function remove_empty_p() {
		add_filter(
			'the_content',
			function ( $content ) {
				$content = force_balance_tags( $content );
				$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
				return $content;
			},
			7
		);
	}

	public static function get_post_type_labels( $_post = false ) {
		global $wp_post_types;
		global $post;
		if ( ! $_post && isset( $post ) ) {
			$_post = $post;
		}
		$post_type_name = get_post_type($_post);
		$labels = &$wp_post_types[$post_type_name]->labels;
		return $labels;
	}

	/**
	 * Add slug to body class.
	 *
	 * @param array $classes Array of html classes.
	 */
	public function add_slug_body_class( $classes ) {
		global $post;
		if ( isset( $post ) && ! is_archive() ) {
			$classes[] = $post->post_name;
		} elseif (isset( $post ) && is_archive() ) {
			$labels = self::get_post_type_labels( $post );
			$classes[] = strtolower( $labels->name );
		}
		return $classes;
	}

	/**
	 * Add classes based on conditions.
	 *
	 * @param  array $classes Classes.
	 * @return array $classes Modified classes.
	 */
	function conditional_classes( $classes ) {
		$include = array(
			// browsers/devices (https://codex.wordpress.org/Global_Variables).
			'is-iphone'  => $GLOBALS['is_iphone'],
			'is-chrome'  => $GLOBALS['is_chrome'],
			'is-safari'  => $GLOBALS['is_safari'],
			'is-ns4'     => $GLOBALS['is_NS4'],
			'is-opera'   => $GLOBALS['is_opera'],
			'is-mac-ie'  => $GLOBALS['is_macIE'],
			'is-win-ie'  => $GLOBALS['is_winIE'],
			'is-gecko'   => $GLOBALS['is_gecko'],
			'is-lynx'    => $GLOBALS['is_lynx'],
			'is-ie'      => $GLOBALS['is_IE'],
			'is-edge'    => $GLOBALS['is_edge'],

			// mobile/desktop.
			'is-mobile'  => wp_is_mobile(),
			'is-desktop' => ! wp_is_mobile(),
		);

		// add applicable classes.
		foreach ( $include as $class => $condition ) {
			if ( $condition ) {
				$classes[ $class ] = $class;
			}
		}

		return $classes;
	}
}
