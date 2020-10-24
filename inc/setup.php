<?php
namespace Arkhe_Toolkit;

add_action( 'init', function() {
	if ( ! class_exists( 'Arkhe' ) ) return;
	\Arkhe::set_plugin_data( 'use_arkhe_toolkit', true );
} );
