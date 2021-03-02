<?php
namespace Arkhe_Toolkit;

/**
 * ファイルの読み込み
 */
add_action( 'wp_enqueue_scripts', '\Arkhe_Toolkit\enqueue_front_scripts', 20 );
add_action( 'admin_enqueue_scripts', '\Arkhe_Toolkit\enqueue_admin_scripts', 20 );
add_action( 'wp_footer', '\Arkhe_Toolkit\hook_wp_footer_1', 1 );

/**
 * フロントで読み込むファイル
 */
function enqueue_front_scripts() {
	wp_enqueue_style( 'arkhe-toolkit-front', ARKHE_TOOLKIT_URL . 'dist/css/front.css', [], ARKHE_TOOLKIT_VER );

	// Luminous 使用するかどうか
	$use_luminous = apply_filters( 'arkhe_toolkit_use_luminous', \Arkhe_Toolkit::get_data( 'extension', 'use_luminous' ) );
	if ( $use_luminous ) {
		wp_enqueue_style( 'arkhe-toolkit-luminous', ARKHE_TOOLKIT_URL . 'dist/css/luminous.css', [], ARKHE_TOOLKIT_VER );
		wp_enqueue_script( 'arkhe-toolkit-luminous', ARKHE_TOOLKIT_URL . 'dist/js/luminous.js', [], ARKHE_TOOLKIT_VER, true );
	}

	// Prefetch 使用するかどうか
	if ( \Arkhe_Toolkit::get_data( 'extension', 'use_prefetch' ) ) {
		wp_enqueue_script( 'arkhe-toolkit-prefetch', ARKHE_TOOLKIT_URL . 'dist/js/prefetch.js', [], ARKHE_TOOLKIT_VER, true );

		$prefetch_prevent_keys = \Arkhe_Toolkit::get_data( 'extension', 'prefetch_prevent_keys' );
		$prefetch_prevent_keys = str_replace( ["\r", "\n" ], '', $prefetch_prevent_keys );

		wp_localize_script( 'arkhe-toolkit-prefetch', 'arkhePrefetchVars', [
			'ignorePrefetchKeys' => $prefetch_prevent_keys,
		] );
	}

	if ( is_user_logged_in() ) {

		// ツールバー用CSS
		wp_enqueue_style( 'arkhe-toolkit-toolbar', ARKHE_TOOLKIT_URL . 'dist/css/toolbar.css', [], ARKHE_TOOLKIT_VER );

		// ajax関連処理
		wp_enqueue_script( 'arkhe-toolkit-ajax', ARKHE_TOOLKIT_URL . 'dist/js/admin/ajax.js', [ 'jquery' ], ARKHE_TOOLKIT_VER, true );
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

	$is_arkhe_page = strpos( $hook_suffix, \Arkhe_Toolkit::MENU_SLUG ) !== false;
	$is_term_page  = 'term.php';
	$is_edit_page  = 'edit.php' === $hook_suffix || 'edit-tags.php' === $hook_suffix;
	$is_post_page  = 'post.php' === $hook_suffix || 'post-new.php' === $hook_suffix;

	wp_enqueue_style( 'arkhe-toolkit-toolbar', ARKHE_TOOLKIT_URL . 'dist/css/toolbar.css', [], ARKHE_TOOLKIT_VER ); // ログイン時のフロントでも読み込む
	wp_enqueue_style( 'arkhe-toolkit-admin', ARKHE_TOOLKIT_URL . 'dist/css/admin.css', [], ARKHE_TOOLKIT_VER ); // 管理画面での共通CSS

	// Arkhe設定ページのみ
	if ( $is_arkhe_page ) {

		wp_enqueue_style( 'arkhe-toolkit-menu', ARKHE_TOOLKIT_URL . 'dist/css/menu.css', [], ARKHE_TOOLKIT_VER );
		// wp_enqueue_script( 'arkhe-toolkit-setting', ARKHE_TOOLKIT_URL . 'dist/js/admin/setting.js', [ 'jquery' ], ARKHE_TOOLKIT_VER, true );

		// ajax関連処理
		wp_enqueue_script( 'arkhe-toolkit-ajax', ARKHE_TOOLKIT_URL . 'dist/js/admin/ajax.js', [ 'jquery' ], ARKHE_TOOLKIT_VER, true );
		wp_localize_script( 'arkhe-toolkit-ajax', 'arkheAjaxVars', [
			'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
			'ajaxNonce'      => wp_create_nonce( 'arkhe-toolkit-ajax-nonce' ),
			'confirmMessage' => __( 'Will you really reset it?', 'arkhe-toolkit' ),
		] );
	} elseif ( $is_post_page ) {

		wp_enqueue_script( 'arkhe-toolkit-post_editor', ARKHE_TOOLKIT_URL . 'dist/js/admin/post_editor.js', [ 'jquery' ], ARKHE_TOOLKIT_VER, true );
		wp_enqueue_style( 'arkhe-toolkit-post_editor', ARKHE_TOOLKIT_URL . 'dist/css/post_editor.css', [], ARKHE_TOOLKIT_VER );
	}

	// 投稿の編集ページ & ターム編集ページ
	if ( $is_term_page || $is_post_page ) {
		// メディアアップローダー
		wp_enqueue_media();
		wp_enqueue_script( 'arkhe-mediauploader', ARKHE_TOOLKIT_URL . 'dist/js/admin/media.js', [ 'jquery' ], ARKHE_TOOLKIT_VER, true );
	}

	// カスタマイザー
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'arkhe-toolkit-customizer', ARKHE_TOOLKIT_URL . 'dist/css/customizer.css', [], ARKHE_TOOLKIT_VER );
	}

}


/**
 * wp_footerフック 優先度:1
 */
function hook_wp_footer_1() {
	if ( \Arkhe_Toolkit::$use_clipboard_js ) {
		wp_enqueue_script( 'clipboard' );
		wp_enqueue_script(
			'arkhe-toolkit-clipboard',
			ARKHE_TOOLKIT_URL . 'dist/js/clipboard.js',
			[ 'clipboard' ],
			ARKHE_TOOLKIT_VER,
			true
		);
	}

	if ( \Arkhe_Toolkit::$use_pinterest ) {
		// phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedScript
		echo '<script async defer src="//assets.pinterest.com/js/pinit.js"></script>';
	}
}
