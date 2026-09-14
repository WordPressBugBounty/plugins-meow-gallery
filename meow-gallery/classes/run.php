<?php

/*
	Meow_MGL_Run is the single place where the assets of the plugin (everything under app/) are
	registered and enqueued. Nothing else should call wp_enqueue_* / wp_register_* for them.

	What exists, and when it gets loaded:

	  app/style.min.css       'mgl-css'                 front-end + admin, always
	  app/style-pro.min.css   'mgl-pro-css'             same, but Pro only
	  app/galleries.js        'mgl-js'                  front-end: in the footer, once a gallery or
	                                                    a collection has been built
	                                                    admin: in the header, as a dependency of
	                                                    the admin bundle
	  app/admin.js            'mgl-admin-js'            admin only (settings, dashboard, block)
	  Lato (Google Fonts)     'meow-neko-ui-lato-font'  admin only

	To add data to the gallery bundle from somewhere else (the Pro class does it for the map
	settings), hook 'mgl_scripts_registered' and localize on the handle it passes.
*/

class Meow_MGL_Run {

	const SCRIPT_HANDLE = 'mgl-js';
	const ADMIN_SCRIPT_HANDLE = 'mgl-admin-js';
	const STYLE_HANDLE = 'mgl-css';
	const PRO_STYLE_HANDLE = 'mgl-pro-css';
	const FONT_STYLE_HANDLE = 'meow-neko-ui-lato-font';

	private $core;
	private $isRegistered = false;

	public function __construct( $core ) {
		$this->core = $core;

		$override_disabled = get_option( 'mgl_options', [] )[ 'gallery_shortcode_override_disabled' ] ?? false;
		if ( !$override_disabled ) { add_shortcode( 'gallery', array( $core, 'gallery' ) ); }
		add_shortcode( 'meow-gallery', array( $core, 'gallery' ) );

		if ( is_admin() ) {
			// The gallery bundle is only registered: the admin bundle depends on it, so WordPress
			// loads it for us, once, and in the right order.
			add_action( 'init', array( $this, 'register_gallery_script' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );

			add_action( 'mgl_gallery_created', array( $this, 'enqueue_gallery_script' ), 10, 0 );
			add_action( 'mgl_collection_created', array( $this, 'enqueue_gallery_script' ), 10, 0 );
		}

		// Yoast: Some people really want this, but it needs to be reviewed as Yoast changed its API
		//add_filter( 'wpseo_sitemap_urlimages', array( $this, 'wpseo_siteimap' ), 10, 2 );
	}

	/*
		Assets
	*/

	private function asset_url( $file ) {
		return MGL_URL . 'app/' . $file;
	}

	// The file modification time is used as a cache buster, so a rebuild is picked up right away.
	private function asset_version( $file ) {
		$physical_file = MGL_PATH . '/app/' . $file;
		return file_exists( $physical_file ) ? filemtime( $physical_file ) : MGL_VERSION;
	}

	// Styles, on the front-end as well as in the admin.
	function enqueue_styles() {
		wp_enqueue_style( self::STYLE_HANDLE, $this->asset_url( 'style.min.css' ), null,
			$this->asset_version( 'style.min.css' ) );

		if ( class_exists( 'MeowPro_MGL_Core' ) ) {
			wp_enqueue_style( self::PRO_STYLE_HANDLE, $this->asset_url( 'style-pro.min.css' ), null,
				$this->asset_version( 'style-pro.min.css' ) );
		}
	}

	// Declares app/galleries.js and its settings. Safe to call more than once, and required before
	// anything can enqueue or localize that script.
	function register_gallery_script() {
		if ( $this->isRegistered ) {
			return;
		}
		$this->isRegistered = true;

		// In the admin, the block editor bundle runs in the header, so this one cannot be deferred.
		$in_footer = !is_admin();

		wp_register_script( self::SCRIPT_HANDLE, $this->asset_url( 'galleries.js' ), array(),
			$this->asset_version( 'galleries.js' ), $in_footer );

		wp_localize_script( self::SCRIPT_HANDLE, 'mgl_settings',
			array(
				'infinite_buffer' => $this->core->get_option( 'infinite_buffer', 0 ),
				'disable_right_click' => !$this->core->get_option( 'right_click', false ),
				'tiles' => array( 'density' => Meow_MGL_Core::get_tiles_density() ),
				'api_url' => get_rest_url( null, '/meow-gallery/v1/' ),
				'rest_nonce' => wp_create_nonce( 'wp_rest' ),
				'options' => $this->core->get_all_options(),
			)
		);

		do_action( 'mgl_scripts_registered', self::SCRIPT_HANDLE );
	}

	// Front-end: called once a gallery or a collection has been built.
	function enqueue_gallery_script() {
		$this->register_gallery_script();
		wp_enqueue_script( self::SCRIPT_HANDLE );
	}

	// Admin: the styles, the fonts and app/admin.js (settings, Meow dashboard, Gutenberg block).
	// The gallery bundle comes along as a dependency, since the block editor renders galleries.
	function enqueue_admin_assets() {
		$this->enqueue_styles();

		wp_enqueue_style( self::FONT_STYLE_HANDLE,
			'//fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap' );

		wp_register_script( self::ADMIN_SCRIPT_HANDLE, $this->asset_url( 'admin.js' ),
			array( self::SCRIPT_HANDLE, 'wp-editor', 'wp-i18n', 'wp-element' ),
			$this->asset_version( 'admin.js' ) );

		global $wplr;
		wp_localize_script( self::ADMIN_SCRIPT_HANDLE, 'mgl_meow_gallery',
			array(
				'api_url' => get_rest_url( null, '/meow-gallery/v1/' ),
				'rest_url' => get_rest_url(),
				'plugin_url' => MGL_URL,
				'prefix' => MGL_PREFIX,
				'domain' => MGL_DOMAIN,
				'is_pro' => class_exists( 'MeowPro_MGL_Core' ),
				// Same check as MeowKit_MGL_Admin::is_registered(), which lives in another class.
				'is_registered' => !!apply_filters( MGL_PREFIX . '_meowapps_is_registered', false, MGL_PREFIX ),
				'rest_nonce' => wp_create_nonce( 'wp_rest' ),
				'wplr_collections' => $wplr ? $wplr->read_collections_recursively() : [],
				'options' => $this->core->get_all_options(),
				// Names only: the selectors don't need the medias (see get_gallery_names).
				'galleries' => $this->core->get_gallery_names(),
				'collections' => $this->core->get_collection_names(),
			)
		);

		wp_enqueue_script( self::ADMIN_SCRIPT_HANDLE );
	}

	/*
		For Yoast SEO
	*/

	function wpseo_siteimap( $images, $post_id ) {
		$galleries = get_post_galleries( $post_id );
		$images_ids = array();
		foreach ( $galleries as $gallery ) {
			preg_match_all( '/wp\-image\-([0-9]{1,16})/', $gallery, $matches );
			if ( !empty( $matches ) ) {
				foreach ( $matches[1] as $id )
					array_push( $images_ids, $id );
			}
		}
		$images_ids = array_unique( $images_ids );
		foreach ( $images_ids as $id ) {
			array_push( $images, array(
				'src' => wp_get_attachment_url( $id ),
				'title' => get_the_title( $id ),
				'alt' => get_post_meta( $id, '_wp_attachment_image_alt', true )
			) );
		}
		return $images;
	}

}

?>
