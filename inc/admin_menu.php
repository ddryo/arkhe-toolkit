<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 管理画面に独自メニューを追加
 */
add_action( 'admin_menu', function () {

	// 「Arkhe設定」を追加
	add_menu_page(
		'Arkhe設定', // ページタイトルタグ
		'Arkhe設定', // メニュータイトル
		'manage_options', // 必要な権限
		\Arkhe_Toolkit::MENU_SLUG, // このメニューを参照するスラッグ名
		'\Arkhe_Toolkit\display_setting_page', // 表示内容
		'', // アイコン
		29 // 管理画面での表示位置
	);

	// トップメニュー複製
	add_submenu_page(
		\Arkhe_Toolkit::MENU_SLUG,
		'Arkhe設定',
		__( 'Arkhe設定', 'arkhe-toolkit' ), // サブ側の名前
		'manage_options',
		\Arkhe_Toolkit::MENU_SLUG, // 親と同じに
		'\Arkhe_Toolkit\display_setting_page'
	);

	// 「再利用ブロック」を追加
	add_menu_page(
		__( '再利用ブロック' ),
		__( '再利用ブロック' ),
		'manage_options',
		'edit.php?post_type=wp_block',
		'',
		'dashicons-image-rotate',
		81 // 「設定」 の下
	);

} );


/**
 * 「Arkhe設定」の内容
 */
function display_setting_page() {
	require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu/menu_page.php';
}


/**
 * 設定の追加
 */
add_action( 'admin_init', function() {

	$menu_tabs = [
		'extension' => __( '拡張機能', 'arkhe-toolkit' ),
		'remove'    => __( '機能停止', 'arkhe-toolkit' ),
		// 'reset'     => __( 'リセット', 'arkhe-toolkit' ),
	];

	\Arkhe_Toolkit::$menu_tabs = $menu_tabs;

	// register_setting
	foreach ( $menu_tabs as $key => $value ) {
		register_setting( 'arkhe_menu_group_' . $key, \Arkhe_Toolkit::DB_NAMES[ $key ] );

		require_once ARKHE_TOOLKIT_PATH . 'inc/admin_menu/tabs/' . $key . '.php';
	}

	// 同じオプションに配列で値を保存するので、register_setting()は１つだけ
	// register_setting( \Arkhe_Toolkit::MENU_GROUPS['options'], \Arkhe_Toolkit::DB_NAME_OPTIONS );

	return;

	/**
	 * 機能停止タブ
	 */
	$page_name = \Arkhe_Toolkit::MENU_PAGE_NAMES['remove'];
	$cb        = [ '\Arkhe_Toolkit', 'basic_cb' ];

	$section_name = 'arkhe_section_remove';
		add_settings_section(
			$section_name,
			'WordPressの機能',
			'',
			$page_name
		);

		$remove_settings = [
			'remove_wpver'       => 'WordPressのバージョン情報を出力しない',
			'remove_rel_link'    => 'rel="prev/next"を出力しない',
			'remove_wlwmanifest' => 'Windows Live Writeの連携停止',
			'remove_rsd_link'    => 'EditURI(RSD Link)の停止',
			'remove_emoji'       => '絵文字用のスクリプトの読み込みをしない',
			'remove_srcset'      => '画像のsrcsetを出力しない',
			'remove_wptexturize' => '記号の自動変換を停止する(wptexturize無効化)',
			'remove_feed_link'   => 'RSSフィードを停止する',
		];

		foreach ( $remove_settings as $key => $label ) {
			add_settings_field(
				$key,
				'', // $label,
				$cb,
				$page_name,
				$section_name,
				[
					'id'    => $key,
					'type'  => 'checkbox',
					'label' => $label,
					// 'desc' => $data[1],
				]
			);
		}

} );
