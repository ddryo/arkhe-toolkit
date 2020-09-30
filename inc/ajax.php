<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 設定データリセット
 */
add_action( 'wp_ajax_arkhe_toolkit_reset_data', function() {
	if ( \Arkhe_Toolkit::check_ajax_nonce() ) {
	}
	wp_die( '失敗しました。' );
} );


/**
 * キャッシュのクリア
 */
add_action( 'wp_ajax_arkhe_toolkit_clear_cache', function() {

	if ( \Arkhe_Toolkit::check_ajax_nonce() ) {

		// キャッシュクリア
		\Arkhe_Toolkit::clear_cache();

		wp_die( wp_json_encode( __( 'キャッシュクリアに成功しました。', 'arkhe-toolkit' ) ) );

	}

	wp_die( wp_json_encode( 'Nonce error.' ) );

} );
