<?php
namespace Arkhe_Toolkit\Shortcode;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * ショートコードを登録する
 */

// <br> 系
function spbr( $args ) {
	return '<br class="u-only-sp">';
}
add_shortcode( 'spbr', '\Arkhe_Toolkit\Shortcode\spbr' );

function pcbr( $args ) {
	return '<br class="u-only-pc">';
}
add_shortcode( 'pcbr', '\Arkhe_Toolkit\Shortcode\pcbr' );

// アイコン
function icon( $args ) {
	if ( empty( $args ) ) return;

	$iconname = isset( $args['class'] ) ? $args['class'] : $args[0];
	return '<i class="' . $iconname . '"></i>';
}
add_shortcode( 'icon', '\Arkhe_Toolkit\Shortcode\icon' );
