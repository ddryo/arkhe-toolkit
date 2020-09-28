<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * ショートコードを登録する
 */

// <br> 系
if ( ! function_exists( 'arkhe_sc__spbr' ) ) :
	function arkhe_sc__spbr( $args ) {
		return '<br class="u-only-sp">';
	}
endif;
add_shortcode( 'spbr', 'arkhe_sc__spbr' );

if ( ! function_exists( 'arkhe_sc__pcbr' ) ) :
	function arkhe_sc__pcbr( $args ) {
		return '<br class="u-only-pc">';
	}
endif;
add_shortcode( 'pcbr', 'arkhe_sc__pcbr' );

// アイコン
if ( ! function_exists( 'arkhe_sc__icon' ) ) :
	function arkhe_sc__icon( $args ) {
		if ( empty( $args ) ) return;

		$iconname = isset( $args['class'] ) ? $args['class'] : $args[0];
		return '<i class="' . $iconname . '"></i>';
	}
endif;
add_shortcode( 'icon', 'arkhe_sc__icon' );
