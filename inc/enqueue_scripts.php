<?php
namespace Arkhe_Toolkit;

/**
 * ファイルの読み込み
 */
add_action( 'wp_enqueue_scripts', '\Arkhe_Toolkit\enqueue_front_scripts', 20 );
add_action( 'admin_enqueue_scripts', '\Arkhe_Toolkit\enqueue_admin_scripts', 20 );


/**
 * フロントで読み込むファイル
 */
function enqueue_front_scripts() {
	wp_enqueue_style( 'arkhe-toolkit-front', ARKHE_TOOLKIT_URL . 'dist/css/front.css', [], ARKHE_TOOLKIT_VER );

	if ( is_user_logged_in() ) {
		// ajax関連処理
		wp_enqueue_script( 'arkhe-toolkit-ajax', ARKHE_TOOLKIT_URL . 'dist/js/ajax.js', ['jquery' ], ARKHE_TOOLKIT_VER, true );
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
	$is_edit_page  = 'edit.php' === $hook_suffix || 'edit-tags.php' === $hook_suffix;
	$is_post_page  = 'post.php' === $hook_suffix || 'post-new.php' === $hook_suffix;

	if ( $is_arkhe_page || $is_edit_page ) {
		wp_enqueue_style( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/css/admin.css', [], ARKHE_TOOLKIT_VER );
	}

	// Arkhe設定ページのみ
	if ( $is_arkhe_page ) {

		wp_enqueue_style( 'arkhe-toolkit-menu', ARKHE_TOOLKIT_URL . 'dist/css/menu.css', [], ARKHE_TOOLKIT_VER );
		wp_enqueue_script( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/js/admin.js', ['jquery' ], ARKHE_TOOLKIT_VER, true );

		// ajax関連処理
		wp_enqueue_script( 'arkhe-toolkit-ajax', ARKHE_TOOLKIT_URL . 'dist/js/ajax.js', ['jquery' ], ARKHE_TOOLKIT_VER, true );
		wp_localize_script( 'arkhe-toolkit-ajax', 'arkheAjaxVars', [
			'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
			'ajaxNonce'      => wp_create_nonce( 'arkhe-toolkit-ajax-nonce' ),
			'confirmMessage' => __( 'Will you really reset it?', 'arkhe-toolkit' ),
		] );
	} elseif ( $is_post_page ) {

		// メディアアップローダー
		wp_enqueue_media();
		wp_enqueue_script( 'arkhe-mediauploader', ARKHE_TOOLKIT_URL . 'dist/js/media.js', ['jquery' ], ARKHE_TOOLKIT_VER, true );

		wp_enqueue_script( 'arkhe-toolkit-editor', ARKHE_TOOLKIT_URL . 'dist/js/editor.js', ['jquery' ], ARKHE_TOOLKIT_VER, true );
		wp_enqueue_style( 'arkhe-toolkit-editor', ARKHE_TOOLKIT_URL . 'dist/css/editor.css', [], ARKHE_TOOLKIT_VER );
	}

	// カスタマイザー
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'arkhe-toolkit-customizer', ARKHE_TOOLKIT_URL . 'dist/css/customizer.css', [], ARKHE_TOOLKIT_VER );
	}

}
