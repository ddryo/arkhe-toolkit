<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * テンプレートのリセット
 */
add_action( 'wp_ajax_arkhe_toolkit_reset_data', function() {
	if ( \Arkhe_Toolkit\check_ajax_nonce() ) {
	}
	wp_die( '失敗しました。' );
} );


/**
 * AJAXのNonceチェック
 */
function check_ajax_nonce( $request_key = 'nonce', $nonce_key = 'arkhe-toolkit-ajax-nonce' ) {
	if ( ! isset( $_POST[ $request_key ] ) ) return false;

	$nonce = $_POST[ $request_key ];

	if ( wp_verify_nonce( $nonce, $nonce_key ) ) {
		return true;
	}

	return false;
}
