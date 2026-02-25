<?php

class Meow_MGL_Builders_Collection_Menu extends Meow_MGL_Builders_Core {

    public function __construct( $atts, $isPreview = false ) {
		parent::__construct( $atts, $isPreview );
		$this->layout = 'menu';
	}

    function inline_css() {}
}