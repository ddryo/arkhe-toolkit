<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * ファイルの読み込み
 */
add_action( 'wp_enqueue_scripts', '\Arkhe_Toolkit\enqueue_front_scripts', 20 );
add_action( 'admin_enqueue_scripts', '\Arkhe_Toolkit\enqueue_admin_scripts', 20 );


/**
 * フロントで読み込むファイル
 */
function enqueue_front_scripts() {
	wp_enqueue_style( 'arkhe-toolkit-front', ARKHE_TOOLKIT_URL . 'dist/css/front.css', [], ARKHE_TOOLKIT_VERSION );

	if ( is_user_logged_in() ) {
		// ajax関連処理
		wp_enqueue_script( 'arkhe-toolkit-ajax', ARKHE_TOOLKIT_URL . 'dist/js/ajax.js', ['jquery' ], ARKHE_TOOLKIT_VERSION, true );
		wp_localize_script( 'arkhe-toolkit-ajax', 'arkheAjaxVars', [
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'ajaxNonce' => wp_create_nonce( 'arkhe-toolkit-ajax-nonce' ),
		] );
	}
}


/**
 * 管理画面で読み込むファイル
 */
function enqueue_admin_scripts( $hook_suffix ) {

	$is_arkhe_page = strpos( $hook_suffix, 'arkhe_' ) !== false;

	if ( $is_arkhe_page || 'edit.php' === $hook_suffix ) {
		wp_enqueue_style( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/css/admin.css', [], ARKHE_TOOLKIT_VERSION );
	}

	// Arkhe設定ページのみ
	if ( $is_arkhe_page ) {
		wp_enqueue_script( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/js/admin.js', ['jquery' ], ARKHE_TOOLKIT_VERSION, true );

		// ajax関連処理
		wp_enqueue_script( 'arkhe-toolkit-ajax', ARKHE_TOOLKIT_URL . 'dist/js/ajax.js', ['jquery' ], ARKHE_TOOLKIT_VERSION, true );
		wp_localize_script( 'arkhe-toolkit-ajax', 'arkheAjaxVars', [
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'ajaxNonce' => wp_create_nonce( 'arkhe-toolkit-ajax-nonce' ),
		] );
	}

}
