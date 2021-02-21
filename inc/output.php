<?php
namespace Arkhe_Toolkit;

/**
 * head内コードの出力
 */
add_action( 'wp_head', '\Arkhe_Toolkit\output_wp_head' );
function output_wp_head() {
	$custom_head_code = \Arkhe_Toolkit::get_data( 'code', 'head_code' );
	if ( $custom_head_code ) {
		echo '<!-- Arkhe Toolkit : head code -->' . PHP_EOL .
			$custom_head_code . PHP_EOL . // phpcs:ignore
			'<!-- / Arkhe Toolkit -->' . PHP_EOL;
	}
}


/**
 * bodyタグ開始後コードの出力
 */
add_action( 'wp_body_open', '\Arkhe_Toolkit\output_wp_body_open' );
function output_wp_body_open() {
	$custom_body_code = \Arkhe_Toolkit::get_data( 'code', 'body_code' );
	if ( $custom_body_code ) {
		echo PHP_EOL . '<!-- Arkhe Toolkit : body open code -->' . PHP_EOL .
			$custom_body_code . PHP_EOL . // phpcs:ignore
			'<!-- / Arkhe Toolkit -->' . PHP_EOL;
	}
}


/**
 * bodyタグ終了前コードの出力
 */
add_action( 'wp_footer', '\Arkhe_Toolkit\output_wp_footer__99', 99 );
function output_wp_footer__99() {
	$custom_foot_code = \Arkhe_Toolkit::get_data( 'code', 'foot_code' );
	if ( $custom_foot_code ) {
		echo '<!-- Arkhe Toolkit : foot code -->' . PHP_EOL .
			$custom_foot_code . PHP_EOL . // phpcs:ignore
			'<!-- / Arkhe Toolkit -->' . PHP_EOL;
	}
}
