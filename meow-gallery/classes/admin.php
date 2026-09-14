<?php

class Meow_MGL_Admin extends MeowKit_MGL_Admin {

	private $core;
	
	public function __construct($core) {
		parent::__construct( MGL_PREFIX, MGL_ENTRY, MGL_DOMAIN, class_exists( 'MeowPro_MGL_Core' ) );
		$this->core = $core;
		add_action( 'admin_menu', array( $this, 'app_menu' ) );
		$blocks_enabled = function_exists( 'register_block_type' );
		if ( $blocks_enabled ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'register_block' ) );
		}
		$options = $this->core->get_all_options();
		if ( ( $options['captions'] ?? 'notset' ) === 'notset' ) {
			// MEOMO: mgl_captions_enabled option is used only here. Also, it deletes soon after being used.
			//        So we keep this option what it is (not migrated to the mgl_options).
			$captions_enabled = get_option( 'mgl_captions_enabled' );
			$this->core->update_options( array_merge(
				$options,
				[ 'captions' => $captions_enabled ? 'hover-only' : false ]
			) );
			delete_option( 'mgl_captions_enabled' );
		}
	}

	public function mgl_settings() {
		echo '<div id="mgl-admin-settings"></div>';
	}

	// The scripts and styles are all handled by Meow_MGL_Run; the block only needs to point at
	// the admin bundle it registers.
	function register_block() {
		register_block_type( 'meow-gallery/gallery', array(
			'editor_script' => Meow_MGL_Run::ADMIN_SCRIPT_HANDLE,
		) );
	}

	function app_menu() {
		add_submenu_page( 'meowapps-main-menu', __( 'Gallery', MGL_DOMAIN ), __( 'Gallery', MGL_DOMAIN ), 
			'manage_options', 'mgl_settings', array( $this, 'mgl_settings' )
		);
	}
}

?>
