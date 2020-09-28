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
}


/**
 * 管理画面で読み込むファイル
 */
function enqueue_admin_scripts( $hook_suffix ) {

	// 管理画面側で読み込むスタイル
	wp_enqueue_style( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/css/admin.css', [], ARKHE_TOOLKIT_VERSION );

	// ページの種類で分岐
	if ( strpos( $hook_suffix, 'arkhe_' ) !== false ) {
		wp_enqueue_script( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/js/admin.js', ['jquery' ], ARKHE_TOOLKIT_VERSION, true );

		// 管理画面側に渡すグローバル変数
		wp_localize_script( 'arkhe-toolkit-admin', 'arkheToolkitVars', [
			// 'adminUrl' => admin_url(),
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'ajaxNonce' => wp_create_nonce( 'arkhe-toolkit-ajax-nonce' ),
		] );
	}

}
