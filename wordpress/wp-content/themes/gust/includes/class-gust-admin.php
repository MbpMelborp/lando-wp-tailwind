<?php
/**
 * Gust admin specific functionality
 *
 * @package Gust
 */

defined( 'ABSPATH' ) || die();

class Gust_Admin {

	const NONCE_KEY         = 'GUST_NONCE';
	const CONTENT_META_KEY  = '_gust_content';
	const USE_GUST_META_KEY = '_use_gust';
	const SAFELIST_META_KEY = '_gust_safelist';
	const PAGE_NAME         = 'gust';
	private $components;
	private $url;
	private $path;
	private $upload_path;
	private $upload_url;
	private $api;
	private $ui_script_url;
	private $regions;
	private $is_free;
	private $version;

	public function __construct( $components, $url, $path, $upload_url, $upload_path, $api, $regions, $is_free, $version, $ui_script_url ) {
		$this->components    = $components;
		$this->url           = $url;
		$this->path          = $path;
		$this->upload_path   = $upload_path;
		$this->upload_url    = $upload_url;
		$this->api           = $api;
		$this->ui_script_url = $ui_script_url;
		$this->regions       = $regions;
		$this->is_free       = $is_free;
		$this->version       = $version;

		add_action( 'after_switch_theme', array( $this, 'activate' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_gust_save_content', array( $this, 'save_content' ) );
		add_action( 'wp_ajax_gust_save_component', array( $this, 'save_component' ) );
		add_action( 'wp_ajax_gust_save_css', array( $this, 'ajax_save_css' ) );
		add_action( 'wp_ajax_gust_get_templates', array( $this, 'get_templates' ) );
		add_action( 'wp_ajax_gust_get_template', array( $this, 'get_template' ) );
		add_action( 'wp_ajax_gust_get_safelist', array( $this, 'ajax_get_site_safelist' ) );
		add_action( 'wp_ajax_gust_get_nodelist_safelist', array( $this, 'ajax_get_nodelist_safelist' ) );
		add_action( 'wp_ajax_gust_get_tw_css', array( $this, 'ajax_get_tw_css' ) );
		add_action( 'wp_ajax_gust_reset_region', array( $this, 'ajax_reset_region' ) );
		add_action( 'init', array( $this, 'add_row_actions' ) );
		add_action( 'load-post.php', array( $this, 'hook_add_meta_box' ) );
		add_action( 'load-post-new.php', array( $this, 'hook_add_meta_box' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'update_option_Gust_colour_primary', array( $this, 'sync_config' ), 10, 2 );
		add_action( 'update_option_Gust_colour_secondary', array( $this, 'sync_config' ), 10, 2 );
		add_action( 'update_option_Gust_font_family', array( $this, 'sync_config' ), 10, 2 );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
	}

	/**
	 * Runs on activation and sets some defaults.
	 */
	public function activate() {
		// check for the upload directory
		// and create it if need be.
		$upload_dir = $this->upload_path;
		if ( ! file_exists( $upload_dir ) ) {
			mkdir( $upload_dir, 0777, true );
		}

		// check if our style is there.
		if ( ! file_exists( $upload_dir . 'develop.css' ) ) {
			copy( $this->path . 'defaults/develop.css', $upload_dir . 'develop.css' );
		}

		if ( ! file_exists( $upload_dir . 'prod.css' ) ) {
			copy( $this->path . 'defaults/prod.css', $upload_dir . 'prod.css' );
		}

		// check if we have a default config.
		if ( ! $this->get_option( 'config' ) ) {
			$config = file_get_contents( $this->path . 'defaults/config.json' );
			$this->update_option( 'config', $config, false );
		}

		if ( ! $this->get_option( 'tw_css' ) ) {
			$tw_css = file_get_contents( $this->path . 'defaults/tw.css' );
			$this->update_option( 'tw_css', $tw_css, false );
		}

		// check if the user has a config.
		if ( ! $this->get_option( 'user_config' ) ) {
			$config = file_get_contents( $this->path . 'defaults/userConfig.json' );
			$this->update_option( 'user_config', $config, false );
		}

		// maybe set the css versions.
		if ( ! $this->get_option( 'dev_css_version' ) ) {
			$this->update_option( 'dev_css_version', 1, false );
		}

		if ( ! $this->get_option( 'prod_css_version' ) ) {
			$this->update_option( 'prod_css_version', 1, true );
		}

		// default to version 3.
		if ( ! $this->get_option( 'tw_version' ) ) {
			$this->update_option( 'tw_version', '3', true );
		}

		$this->activate_free();

		do_action( 'gust_post_activate' );
	}

	/**
	 * Runs any activation tasks specific to the free version
	 */
	private function activate_free() {
		$free_defaults = array(
			'colour_primary'   => '#1976D2',
			'colour_secondary' => '#424242',
			'font_family'      => "'Inter', sans-serif",
		);

		foreach ( $free_defaults as $key => $value ) {
			if ( ! $this->get_option( $key ) ) {
				$this->update_option( $key, $value, false );
			}
		}
	}

	public function get_option( $option, $default = false ) {
		return get_option( 'Gust_' . $option, $default );
	}

	public function update_option( $option, $value, $autoload = null ) {
		return update_option( 'Gust_' . $option, $value, $autoload );
	}

	public function admin_enqueue_scripts( $hook_suffix ) {
		if ( $hook_suffix === 'toplevel_page_gust' ) {
			wp_enqueue_style( 'gust-codemirror', $this->url . 'assets/css/vendors/codemirror.min.css', array(), '5.60.0' );
			wp_enqueue_style( 'gust-cm-darcula', $this->url . 'assets/css/vendors/darcula.min.css', array(), '5.60.0' );
			wp_enqueue_style( 'gust-cm-lint', $this->url . 'assets/css/vendors/lint.min.css', array(), '5.60.0' );

			wp_enqueue_script( 'gust-codemirror', $this->url . 'assets/js/vendors/codemirror.min.js', array(), '5.60.0', true );
			wp_enqueue_script( 'gust-cm-mode-js', $this->url . 'assets/js/vendors/codemirror-mode-javascript.min.js', array(), '5.60.0', true );
			wp_enqueue_script( 'gust-cm-lint', $this->url . 'assets/js/vendors/lint.min.js', array(), '5.60.0', true );
			wp_enqueue_script( 'gust-jsonlint', $this->url . 'assets/js/vendors/jsonlint.js', array(), '1.6.3', true );
			wp_enqueue_script( 'gust-cm-lint-json', $this->url . 'assets/js/vendors/codemirror-json-lint.min.js', array(), '5.60.0', true );
			wp_enqueue_script( 'gust-worker', $this->ui_script_url . '/wp.js', array(), $this->version );
			wp_register_script( 'gust-settings', $this->url . 'assets/js/settings.js', array( 'jquery', 'gust-codemirror', 'gust-worker' ), $this->version, true );
			wp_localize_script(
				'gust-settings',
				'Gust',
				array(
					'adminUrl'          => admin_url( 'admin-ajax.php' ),
					'config'            => $this->get_config(),
					'css'               => $this->get_tw_css(),
					'nonce'             => wp_create_nonce( self::NONCE_KEY ),
					'safelist'          => implode( ' ', $this->get_class_safelist() ),
					'tailwindVersion'   => $this->get_option( 'tw_version' ),
				)
			);
			wp_enqueue_script( 'gust-settings' );
		}
		if ( $hook_suffix === 'toplevel_page_gust' ) {
			// check that we have a post ID
			if ( ( ! isset( $_REQUEST['post'] ) || ! $_REQUEST['post'] ) && ( ! isset( $_REQUEST['region'] ) || ! $_REQUEST['region'] ) ) {
				return;
			}
			wp_enqueue_media();
			$post_id = isset( $_REQUEST['post'] ) ? absint( $_REQUEST['post'] ) : 0;
			$region = isset( $_REQUEST['region'] ) ? $_REQUEST['region'] : '';
			wp_register_script( 'gust-builder', $this->ui_script_url . '/builder.js', array(), $this->version, true );
			wp_enqueue_style( 'gust-builder-css', $this->url . 'assets/css/builder.css', array(), $this->version);

			function map_object_to_key_label( $obj ) {
				return array(
					'key'   => $obj->name,
					'label' => $obj->label,
				);
			}

			// get a list of all the post types
			$post_types = get_post_types( array(), 'objects' );

			// convert them to something useable
			// maybe just the name and label
			$post_types = array_values( array_map( 'map_object_to_key_label', $post_types ) );

			$taxs = get_taxonomies( array(), 'objects' );
			$taxs = array_values( array_map( 'map_object_to_key_label', $taxs ) );

			// get a list of colours to use.
			$config  = json_decode( $this->get_option( 'config', '{}' ) );
			$colours = $this->get_colour_list( $config->theme->textColor );

			$back_url = get_edit_post_link( $post_id );
			if ( $region ) {
				$back_url = menu_page_url( self::PAGE_NAME, false );
			}

			// check if the user has seen the tour.
			$seen_tour = get_user_meta( get_current_user_id(), 'gust_seen_tour', true );
			if ( ! $seen_tour ) {
				update_user_meta( get_current_user_id(), 'gust_seen_tour', 1 );
			}

			$content = '';
			if ( $post_id ) {
				$content = $this->get_gust_content( $post_id );
			} elseif ( $region ) {
				$content = $this->get_gust_region_content( $region );
			}

			wp_localize_script(
				'gust-builder',
				'Gust',
				array(
					'adminUrl'          => admin_url( 'admin-ajax.php' ),
					'backUrl'           => $back_url,
					'builderStyle'      => 'advanced',
					'canUseGust'        => $this->page_can_use_gust( $post_id ),
					'colours'           => $colours,
					'components'        => $this->components->components,
					'config'            => $this->get_config(),
					'content'           => $content,
					'css'               => $this->get_tw_css(),
					'isAdmin'           => current_user_can( 'administrator' ),
					'isFree'            => $this->is_free,
					'nonce'             => wp_create_nonce( self::NONCE_KEY ),
					'postId'            => $post_id,
					'postTypes'         => $post_types,
					'region'            => $region,
					'runTour'           => ! $seen_tour,
					'tailwindVersion'   => $this->get_option( 'tw_version' ),
					'taxonomies'        => $taxs,
					'themeUrl'          => $this->url,
				)
			);
			wp_enqueue_script( 'gust-builder' );
			wp_enqueue_style( 'gust-inter', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;800&display=swap' );
			// remove default WordPress styles
			wp_deregister_style( 'wp-admin' );
		}
	}

	public function admin_menu() {
		add_menu_page(
			__( 'Gust', 'gust' ),
			__( 'Gust', 'gust' ),
			'edit_posts',
			self::PAGE_NAME,
			array( $this, 'render_admin_menu' ),
			"data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQwIiBoZWlnaHQ9IjE2NCIgdmlld0JveD0iMCAwIDI0MCAxNjQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNLTAuMDAwMTIyMDcgOTQuMzE4N0MtMC4wMDAxMjIwNyA3Mi4yMDA4IDkuNjI5MjcgNDEuMDIwNSAyOS40NDQ4IDIxLjA0MzFDNDkuMjYwMyAxLjA2NTc3IDEwMC45NzcgLTkuODcxNTcgMTQ0LjcyOSAxMy4wNTQ5QzE4OC40ODEgMzUuOTgxNCAyMTcuNzMxIDEzLjA1NDkgMjMzLjQ3IDcuODQ5NDlDMjQyLjg1MyAzOC4zNTI1IDI0MC43IDYxLjI1NjUgMjI3LjQzMyA4MC4xMzU0QzIxNC4xNjUgOTkuMDE0MyAxNjQuOTUxIDExNy40NzggMTEwLjMyMSA4Ny44NjIxQzc3LjM5MjUgNzAuMDExMiA0MS41NjYzIDUxLjcyMzggLTAuMDAwMTIyMDcgOTQuMzE4N1oiIGZpbGw9IiNGQUZERkYiLz4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0yLjMzMTQ2IDE1NC43MTFDLTEuMTkyMDkgMTM5LjQzIC0xLjk4ODQ0IDEyMy4yNDggOS4xNTYxNyAxMDguOTYzQzI0Ljc3NDUgODkuNTIyNyA2My44MDA4IDgyLjk4NjMgODcuMzc1NyA5OC41ODEzQzExMC45NTEgMTE0LjE3NiAxMzQuNjI1IDEyMy4zNDkgMTQxLjk2OSAxMjMuMzQ5QzE0My44MjQgMTM4Ljk1OSAxMjYuMDgyIDE1OS44MTUgMTEyLjM0OSAxNjIuNTg5Qzk4LjYxNjEgMTY1LjM2MiA4NC4yODM5IDE2My44MjggNjcuNzE2IDE1Ny4xNzhDNTEuMTQ4MSAxNTAuNTI5IDM4LjU1NyAxMjkuMjM1IDIuMzMxNDYgMTU0LjcxMVoiIGZpbGw9IiNGQUZERkYiLz4KPC9zdmc+Cg=="
		);
	}

	public function render_admin_menu() {
		if ( ! isset( $_REQUEST['post'] ) && ! isset( $_REQUEST['region'] ) ) {
			$this->render_settings_page();
			return;
		}
		ob_start();
		include $this->path . 'templates/admin-page.php';
		echo ob_get_clean();
	}

	public function save_content() {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], self::NONCE_KEY ) ) {
			wp_send_json_error( array( 'error' => 'Invalid nonce' ), 403 );
		}
		if ( ! isset( $_REQUEST['postId'] ) && ! isset( $_REQUEST['region'] ) ) {
			wp_send_json_error( array( 'error' => 'Missing post ID or region' ), 400 );
		}
		if ( ! isset( $_REQUEST['css'] ) ) {
			wp_send_json_error( array( 'error' => 'Missing CSS' ), 400 );
		}
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( array( 'error' => 'You do not have permission to edit this post' ), 400 );
		}

		// save the post or region content.
		$id = $_REQUEST['postId'];
		$use_region = false;
		if ( $_REQUEST['region'] ) {
			$id = $_REQUEST['region'];
			$use_region = true;
		}

		$content = isset( $_REQUEST['content'] )
			? $_REQUEST['content']
			: '';

		$safelist = isset( $_REQUEST['safelist'] )
			? $_REQUEST['safelist']
			: '';

		$css = $_REQUEST['css'];
		$this->save_post_content( $id, $content, $safelist, $css, $use_region );

		wp_send_json_success(
			array(
				'status' => 'saved',
			)
		);
	}

	public function save_post_content( $id, $content, $safelist, $css, $use_region = false ) {
		if ( $use_region ) {
			$region_data = array(
				'content'  => $content,
				'safelist' => $safelist,
			);
			$this->regions->update_region( $id, $region_data );
		} else {
			$abs_post_id = absint( $id );
			update_post_meta( $abs_post_id, self::CONTENT_META_KEY, $content );
			update_post_meta( $abs_post_id, self::USE_GUST_META_KEY, 1 );
			update_post_meta( $abs_post_id, self::SAFELIST_META_KEY, $safelist );
		}

		$this->save_css( stripslashes( $css ) );
	}

	/**
	 * Returns the content for a region
	 * 
	 * @param string $slug The region name.
	 */
	public function get_gust_region_content( $slug ) {
		$region = $this->regions->get_region( $slug );
		if ( ! $region ) {
			return '[]';
		}

		return $region['content'] ? $region['content'] : '[]';
	}

	public function get_gust_content( $post_id ) {
		$meta = get_post_meta( absint( $post_id ), self::CONTENT_META_KEY, true );
		return $meta ? $meta : '[]';
	}

	public function save_component() {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], self::NONCE_KEY ) ) {
			wp_send_json_error( array( 'error' => 'Invalid nonce' ), 403 );
		}
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( array( 'error' => 'You do not have permission to edit this post' ), 400 );
		}

		if ( ! isset( $_REQUEST['node'] ) || ! isset( $_REQUEST['id'] ) || empty( $_REQUEST['node'] ) || empty( $_REQUEST['id'] ) ) {
			wp_send_json_error( array( 'error' => 'Missing required data' ), 400 );
		}

		// update our store of components
		// I'm really not sure options is the best place to do this
		// but maybe it's fine for now?
		// could be a custom post type too...
		$components   = get_option( 'gust_components', array() );
		$components[] = $_REQUEST['id'];
		update_option( 'gust_components', $components );
		update_option( "gust_component_{$_REQUEST['id']}", $_REQUEST['node'] );
		wp_send_json_success();
	}

	public function get_valid_post_types() {
		return apply_filters( 'gust_enable_post_types', array( 'post', 'page' ) );
	}

	public function add_row_actions() {
		$valid_post_types = $this->get_valid_post_types();
		foreach ( $valid_post_types as $post_type ) {
			add_filter( "{$post_type}_row_actions", array( $this, 'row_actions' ), 10, 2 );
		}
	}

	public function get_post_edit_url( $post_id = 0 ) {
		return add_query_arg(
			array(
				'page' => self::PAGE_NAME,
				'post' => $post_id,
			),
			get_admin_url()
		);
	}

	public function get_region_edit_url( $region ) {
		return add_query_arg(
			array(
				'page' => self::PAGE_NAME,
				'region' => $region,
			),
			get_admin_url()
		);
	}

	public function row_actions( $actions, $post ) {
		$href      = $this->get_post_edit_url( $post->ID );
		$actions[] = '<a href="' . esc_attr( $href ) . '">Gust Page Builder</a>';
		return $actions;
	}

	public function hook_add_meta_box() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
	}

	public function add_meta_boxes() {
		add_meta_box(
			'gust_use_builder',
			'Gust',
			array( $this, 'render_builder_metabox' ),
			$this->get_valid_post_types(),
			'side'
		);
	}

	/**
	 * Returns whether a post uses the Gust page build
	 * 
	 * @param int $post_id The post ID.
	 */
	public function does_post_use_gust( $post_id = 0 ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		return get_post_meta( $post_id, self::USE_GUST_META_KEY, true ) || 0;
	}

	/**
	 * Returns a count of how many posts are using Gust
	 */
	public function count_posts_using_gust() {
		global $wpdb;
		$response = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT COUNT(*) AS post_count
				FROM $wpdb->postmeta
				WHERE meta_key = %s AND meta_value = 1",
				self::USE_GUST_META_KEY
			)
		);
		return $response->post_count;
	}

	/**
	 * Determines whether a page can use the gust page builder.
	 * 
	 * @param int $post_id The post ID.
	 */
	public function page_can_use_gust( $post_id = 0 ) {
		if ( ! $post_id ) {
			return true;
		}
		$gust_count     = $this->count_posts_using_gust();
		$post_uses_gust = $this->does_post_use_gust( $post_id );
		return $gust_count <= 1 || $post_uses_gust;
	}

	public function render_builder_metabox( $post ) {
		if ( $this->does_post_use_gust( $post->ID ) ) {
			echo '<p>This page uses the Gust page builder</p>';
		} else {
			echo '<p>This page does not use the Gust page builder</p>';
		}
		$href = $this->get_post_edit_url( $post->ID );
		echo '<p><a class="button" href="' . esc_attr( $href ) . '">Use Gust</a></p>';
	}

	public function register_settings() {
		register_setting( 'gust', 'Gust_user_config' );
		register_setting( 'gust', 'Gust_safelist' );
		
		// START free settings.
		register_setting( 'gust', 'Gust_colour_primary' );
		register_setting( 'gust', 'Gust_colour_secondary' );
		register_setting( 'gust', 'Gust_font_family' );
		// END free settings.

		register_setting( 'gust', 'Gust_dev_mode' );
		register_setting( 'gust', 'Gust_tw_css' );
		register_setting( 'gust', 'Gust_tw_version' );

		add_settings_section(
			'gust_general_settings',
			__( 'General Settings', 'gust' ),
			array( $this, 'render_setting_section_general' ),
			'gust'
		);

		add_settings_field(
			'tw_version',
			__( 'Tailwind CSS Version', 'gust' ),
			array( $this, 'render_setting_field_select' ),
			'gust',
			'gust_general_settings',
			array(
				'name'    => 'tw_version',
				'options' => array(
					'3' => '3.1.3',
					'2' => '2.2.15',
				),
			)
		);

		add_settings_field(
			'user_config',
			__( 'Tailwind Config', 'gust' ),
			array( $this, 'render_config_upsell' ),
			'gust',
			'gust_general_settings',
			array(
				'name'   => 'user_config',
			)
		);

		// START free settings.
		add_settings_field(
			'colour_primary',
			__( 'Primary colour', 'gust' ),
			array( $this, 'render_setting_field_text' ),
			'gust',
			'gust_general_settings',
			array(
				'name'        => 'colour_primary',
				'description' => __( 'The primary colour is used for things like buttons, links, etc. Upgrade to premium to have full control over your Tailwind config', 'gust' ),
			)
		);

		add_settings_field(
			'colour_secondary',
			__( 'Secondary colour', 'gust' ),
			array( $this, 'render_setting_field_text' ),
			'gust',
			'gust_general_settings',
			array(
				'name' => 'colour_secondary',
			)
		);

		add_settings_field(
			'font_family',
			__( 'Font family', 'gust' ),
			array( $this, 'render_setting_field_text' ),
			'gust',
			'gust_general_settings',
			array(
				'name'        => 'font_family',
				'description' => __( 'This will change the font family set in the CSS. You will still need to ensure the font is correctly loaded.', 'gust' ),
			)
		);

		add_settings_field(
			'tw_css',
			__( 'Tailwind CSS', 'gust' ),
			array( $this, 'render_css_upsell' ),
			'gust',
			'gust_general_settings',
			array(
				'name'   => 'tw_css',
				'codeMirror' => 'css',
			)
		);
		// END free settings.

		add_settings_field(
			'safelist',
			__( 'Safelist', 'gust' ),
			array( $this, 'render_setting_field_text' ),
			'gust',
			'gust_general_settings',
			array(
				'name'        => 'safelist',
				'description' => __( 'Gust will run Purge CSS against the class names used on your pages to strip any unused CSS. You can whitelist any class names here that you need to keep if the are not picked up automatically', 'gust' ),
			)
		);

		add_settings_field(
			'dev_mode',
			__( 'Dev Mode', 'gust' ),
			array( $this, 'render_setting_field_checkbox' ),
			'gust',
			'gust_general_settings',
			array(
				'name'        => 'dev_mode',
				'description' => __( 'When enabled, Dev mode will load development styles when viewing the website. This allows you to work with Tailwind CSS classes in templates and PHP files without rebuilding styles after each change. See the docs for more info.', 'gust' ),
			)
		);
	}

	public function render_config_upsell() {
		echo '<div>';
		echo '<p><a href="https://www.getgust.com?utm_source=gust&utm_medium=settings&utm_campaign=setting_config" target="_blank" rel="noopener noreferrer">Upgrade to premium</a> to have full control over your Tailwind config.</p>';
		echo '</div>';
	}

	public function render_css_upsell() {
		echo '<div>';
		echo '<p><a href="https://www.getgust.com?utm_source=gust&utm_medium=settings&utm_campaign=setting_css" target="_blank" rel="noopener noreferrer">Upgrade to premium</a> to have full control over your Tailwind CSS.</p>';
		echo '</div>';
	}

	public function render_settings_page() {
		$gust    = array(
			'urls' => array(
				'header' => '',
				'footer' => '',
			),
		);
		$regions = $this->regions->get_regions();
		foreach ( $regions as $region_key ) {
			$gust['urls'][ $region_key ] = $this->get_region_edit_url( $region_key );
		}
		ob_start();
		include $this->path . 'templates/settings.php';
		echo ob_get_clean();
	}

	public function render_setting_section_general() {
	}

	public function render_setting_field_text( $args ) {
		$option = $this->get_option( $args['name'] );
		echo '<input id="' . esc_attr( $args['name'] ) . '" name="Gust_' . $args['name'] . '" value="' . esc_attr( $option ) . '">';
		if ( isset( $args['description'] ) && $args['description'] ) {
			echo '<p>' . $args['description'] . '</p>';
		}
	}

	public function render_setting_field_textarea( $args ) {
		$option  = $this->get_option( $args['name'] );
		$code_mirror_mode = '';
		$classes = array();
		if ( $args['codeMirror'] ) {
			$classes[] = 'gust-cm';
			$code_mirror_mode = $args['codeMirror'];
		}

		echo '<textarea class="' . esc_attr( implode( ' ', $classes ) ) . '" id="' . esc_attr( $args['name'] ) . '" name="Gust_' . $args['name'] . '"  data-cm-mode="' . esc_attr( $code_mirror_mode ) . '" >' . esc_textarea( $option ) . '</textarea>';
	}

	/**
	 * Displays a setting checkbox field.
	 * 
	 * @param array $args Options passed in from add_settings_field.
	 */
	public function render_setting_field_checkbox( $args ) {
		$option  = $this->get_option( $args['name'] );
		$checked = $option ? 'checked' : '';
		echo '<input id="' . esc_attr( $args['name'] ) . '" name="Gust_' . $args['name'] . '" value="1" type="checkbox" ' . esc_attr( $checked ) . '>';
		if ( isset( $args['description'] ) && $args['description'] ) {
			echo '<p>' . esc_html( $args['description'] ) . '</p>';
		}
	}

	/**
	 * Displays a setting select box
	 * 
	 * @param array $args Options passed in from add_settings_field.
	 */
	public function render_setting_field_select( $args ) {
		$option = $this->get_option( $args['name'] );
		echo '<select name="Gust_' . esc_attr( $args['name'] ) . '">';
		foreach ( $args['options'] as $value => $label ) {
			$selected = $option === strval($value) ? 'selected' : '';
			echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
		}
		echo '</select>';
	}

	/**
	 * Returns the config
	 */
	public function get_config() {
		return array(
			'theme' => array(
				'extend' => array(
					'colors' => array(
						'primary'   => $this->get_option( 'colour_primary', '#1976D2' ),
						'secondary' => $this->get_option( 'colour_secondary', '#424242' ),
						'accent'    => '#82B1FF',
						'error'     => '#FF5252',
						'info'      => '#2196F3',
						'success'   => '#4CAF50',
						'warning'   => '#FFC107',
					),
				),
				'fontFamily' => array(
					'sans' => $this->get_option( 'font_family', "'Inter', sans-serif" ),
				),
			),
		);
	}

	public function sync_config( $old_value, $new_value ) {
		// check if the options have changed
		$encoded_old = wp_json_encode( $old_value );
		$encoded_new = wp_json_encode( $new_value );

		// if not, go no further
		// if they have, we need the updated version
		if ( $encoded_old == $encoded_new ) {
			return;
		}

		// make a request to the API with the updated config
		$response = $this->api->get_config( $new_value );
		if ( ! is_wp_error( $response ) && $response['response']['code'] == 200 ) {
			$this->update_option( 'config', $response['body'] );
		}
	}

	/**
	 * Get an array of unique class names used on the site.
	 *
	 * @param array $exclude_ids An array of IDs to exclude from the query.
	 */
	public function get_class_safelist( $exclude_ids = array() ) {
		// get all the safelist metas.
		global $wpdb;

		$safelist_query_and_list = array();
		if ( ! empty( $exclude_ids ) ) {
			$escaped_ids = array_map( 'esc_sql', $exclude_ids );
			$safelist_query_and_list[] = 'post_id NOT IN(' . implode( ', ', $escaped_ids ) . ')';
		}
		$safelist_query_and = empty( $safelist_query_and_list )
			? ''
			: 'AND ' . implode( ' AND ', $safelist_query_and_list );

		$safelists = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT meta_value
      FROM {$wpdb->postmeta}
      WHERE meta_key = %s {$safelist_query_and}",
				self::SAFELIST_META_KEY
			)
		);
		$safelist  = explode( ' ', join( ' ', $safelists ) );

		// also add our own safelist.
		$gust_safelist = $this->get_option( 'safelist' );
		$safelist      = array_merge( $safelist, explode( ' ', $gust_safelist ) );

		// get the safelist from any regions.
		foreach ( $this->regions->get_regions() as $region_key ) {
			$region = $this->regions->get_region( $region_key );
			if ( ! $region ) {
				continue;
			}
			$safelist = array_merge( $safelist, explode( ' ', $region['safelist'] ) );
		}

		// get the safelist from any template files.
		$template_safelist = $this->get_safelist_from_templates();
		$safelist          = array_merge( $safelist, $template_safelist );

		// and finally, this is the safelist from our default theme.
		$theme_safelist = 'block md:inline-block border border-t border-2 border-b-2 border-transparent border-primary hover:border-primary bg-gray-200 border-gray-200 flex flex-wrap flex-1 font-bold font-medium grid grid-cols-1 md:grid-cols-2 gap-8 hover:opacity-70 max-w-screen-lg mx-auto mb-2 mb-8 my-2 my-8 md:mb-0 w-full md:w-1/4 md:w-auto md:ml-8 p-2 px-4 py-2 rounded space-x-2 space-x-4 space-y-8 text-lg text-2xl text-3xl text-4xl text-xs text-sm text-gray-500 text-gray-700 text-gray-900 uppercase rounded-r rounded-l text-gray-900';
		$theme_safelist .= ' gust-posts-navigation gust-mobile-nav--closed gust-mobile-nav--open gust-search--closed gust-search--open prose aligncenter alignright alignleft wp-caption-text avatar';

		// added by comment template walker.
		$theme_safelist .= ' pl-2 mt-2 ml-2 border-l';

		// screen reader.
		$theme_safelist .= ' screen-reader-text';

		$theme_safelist = explode( ' ', $theme_safelist );
		$theme_safelist = apply_filters( 'gust_theme_safelist', $theme_safelist );

		// sometimes multiple class names may be passed as a single string
		// let's join and re-split.
		$theme_safelist = implode( ' ', $theme_safelist );
		$theme_safelist = explode( ' ', $theme_safelist );
		$safelist       = array_merge( $safelist, $theme_safelist );

		$unique = array_unique( $safelist );
		$unique = apply_filters( 'gust_safelist', $unique );
		return array_values( $unique );
	}

	/**
	 * Searches any templates and attempts to extract CSS class names
	 */
	private function get_safelist_from_templates() {
		$templates_to_check = array(
			'404.php',
			'archive.php',
			'attachment.php',
			'author.php',
			'category.php',
			'comments.php',
			'date.php',
			'embed.php',
			'footer.php',
			'frontpage.php',
			'header.php',
			'home.php',
			'index.php',
			'page.php',
			'paged.php',
			'privacypolicy.php',
			'search.php',
			'searchform.php',
			'sidebar.php',
			'single.php',
			'singular.php',
			'tag.php',
			'taxonomy.php',
			'template-parts/content/post-latest.php',
			'template-parts/content/post-list-item.php',
			'template-parts/content/content-single.php',
			'template-parts/content/content-none.php',
			'template-parts/content/post-tags.php',
			'template-parts/content/post-categories.php',
		);
		$templates_to_check = apply_filters( 'gust_safelist_templates', $templates_to_check );
		$files              = array();
		foreach ( $templates_to_check as $template ) {
			$path = locate_template( $template, false, false );
			if ( '' !== $path ) {
				$files[] = $path;
			}
		}

		$files    = apply_filters( 'gust_safelist_files', $files );
		$safelist = array();
		foreach ( $files as $file ) {
			if ( ! file_exists( $file ) ) {
				continue;
			}
			$file_content = file_get_contents( $file );
			// this is a very rudimentary implementation. It's Purge CSS's default extractor.
			// let's work on a more comprehensive PHP extractor.
			preg_match_all( '/[A-Za-z0-9:[%\]#_.-]+/m', $file_content, $matches );
			if ( ! empty( $matches ) && ! empty( $matches[0] ) ) {
				$safelist = array_merge( $safelist, $matches[0] );
			}
		}
		return $safelist;
	}

	private function get_colour_list( $colours = array() ) {
		$list = array();
		foreach ( $colours as $key => $value ) {
			if ( is_object( $value ) ) {
				$list = array_merge( $list, $this->get_colour_list( $value ) );
			} else {
				if ( preg_match( '/^#/', $value ) !== 1 ) {
					continue;
				}
				$list[] = $value;
			}
		}
		return $list;
	}

	public function admin_notices() {
		$screen = get_current_screen();
		if ( $screen->id === 'toplevel_page_gust' ) {
			$remote = $this->api->get_theme_info(
				$this->get_option( 'purchase_code' ),
				true
			);
			if ( $remote ) {
				  $theme_info = json_decode( $remote['body'] );
				if ( property_exists( $theme_info, 'error_code' ) && ! empty( $theme_info->error_code ) ) {
					echo '<div class="notice notice-error">';
					$message = __( 'You need a valid licence key to receive updates.', 'gust' );
					switch ( $theme_info->error_code ) {
						case 'INVALID_PURCHASE_CODE': 
							$message = __( 'That licence key is invalid. Please double check and if you are still having trouble, get in touch with support.', 'gust' );
							break;
						
						case 'PURCHASE_CODE_IN_USE': 
							$message = __( 'That licence key appears to be used on another website. First remove it there and then try again. If you are still having trouble, please get in touch with support', 'gust' );
							break;

						case 'EXPIRED': 
							$message = __( 'Your licence has expired', 'gust' );
							break;
						
					}
					echo '<p>' . $message . '</p>';
					echo '</div>';
				}
			}
		}
	}

	public function get_templates() {
		$templates = $this->api->get_templates();
		if ( ! $templates ) {
			return wp_send_json_error( array( 'error' => 'Not found' ), 404 );
		}
		$templates = apply_filters( 'gust_templates', $templates );
		wp_send_json( $templates );
	}

	public function get_template() {
		if ( ! isset( $_REQUEST['templateId'] ) || empty( $_REQUEST['templateId'] ) ) {
			return wp_send_json_error( array( 'error' => 'Missing template ID' ), 400 );
		}
		$id       = $_REQUEST['templateId'];
		$template = $this->api->get_template( $id );
		if ( ! $template ) {
			return wp_send_json_error( array( 'error' => 'Not found' ), 404 );
		}
		$template = apply_filters( 'gust_template_detail', $template, $_REQUEST['templateId'] );
		wp_send_json( $template );
	}

	/**
	 * Saves the production CSS
	 * @param string $css the CSS to save
	 */
	public function save_css( $css ) {
		$file_name = 'prod.css';
		$final_path = $this->upload_path . $file_name;

		$option_name = 'prod_css_version';
		$v = $this->get_option( $option_name, 1 );
		$this->update_option( $option_name, $v + 1 );
		file_put_contents( $final_path, $css );
	}

	/**
	 * Returns the current safelist of the site
	 */
	public function ajax_get_site_safelist() {
		$exclude       = isset( $_REQUEST['excludePost'] )
			? array( absint( $_REQUEST['excludePost'] ) )
			: array();
		$safelist = $this->get_class_safelist( $exclude );
		wp_send_json( array( 'safelist' => $safelist ) );
	}

	/**
	 * Saves the CSS
	 */
	public function ajax_save_css() {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], self::NONCE_KEY ) ) {
			wp_send_json_error( array( 'error' => 'Invalid nonce' ), 403 );
		}
		if ( ! isset( $_REQUEST['css'] ) || empty( $_REQUEST['css'] ) ) {
			wp_send_json_error( array( 'error' => 'Invalid CSS' ), 403 );
		}
		$this->save_css( stripslashes( $_REQUEST['css'] ) );
		wp_send_json( array( 'saved' => true ) );
	}

	/**
	 * Returns the current parsed Tailwind CSS of the site
	 */
	public function get_tw_css() {
		$css = $this->get_option( 'tw_css' );
		$gust_css = file_get_contents( $this->path . 'defaults/gust-css.css' );
		if ( $this->is_wc_active() && apply_filters( 'gust_include_wc_styles', true ) ) {
			$woo_css = file_get_contents( $this->path . 'defaults/woo.css' );
			$gust_css .= "\r\n";
			$gust_css .= $woo_css;
		}
		return str_replace( '@gust;', $gust_css, $css );
	}

	/**
	 * Returns the current Tailwind CSS of the site from an AJAX request
	 */
	public function ajax_get_tw_css() {
		$out = array(
			'css' => $this->get_tw_css(),
		);
		wp_send_json( $out );
	}

	/**
	 * Resets a region
	 */
	public function ajax_reset_region() {
		if ( ! wp_verify_nonce( $_REQUEST['nonce'], self::NONCE_KEY ) ) {
			wp_send_json_error( array( 'error' => 'Invalid nonce' ), 403 );
		}
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json_error( array( 'error' => 'You do not have permission to edit this post' ), 400 );
		}
		if ( !isset( $_POST['payload'] ) || empty( $_POST['payload'] ) ) {
			wp_send_json_error( array( 'error' => 'Empty region' ) );
		}
		$region = (string) $_POST['payload'];
		$this->regions->reset_region( $region );
	}

	/**
	 * Returns whether WC is active
	 */
	public function is_wc_active() {
		return in_array( 'woocommerce/woocommerce.php', apply_filters( "active_plugins", get_option( "active_plugins" ) ) );
	}

	/**
	 * Given a list of nodes, returns the safelist for those nodes
	 */
	public function ajax_get_nodelist_safelist() {
		if ( ! isset( $_REQUEST['nodes'] ) ) {
			wp_send_json_error( array( 'error' => 'Missing Nodes' ), 400 );
		}

		$nodes = json_decode( stripslashes( $_REQUEST['nodes'] ), true );
		$safelist = apply_filters( 'gust_content_safelist', array(), $nodes );

		wp_send_json(
			array(
				'safelist' => array_values( $safelist ),
			)
		);
	}
}
