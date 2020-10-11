<?php
namespace Arkhe_Toolkit;

add_filter( 'admin_bar_menu', function ( $wp_admin_bar ) {
	// 「カスタマイズ」
	if ( is_admin() ) {
		$wp_admin_bar->add_menu(
			[
				'id'    => 'customize',
				// phpcs:ignore WordPress.WP.I18n.MissingArgDomain
				'title' => '<span class="ab-icon"></span><span class="ab-label">' . __( 'Customize' ) . '</span>',
				'href'  => admin_url( 'customize.php' ),
			]
		);
	}

	$arkhe_menu_id = 'arkhe_settings';

	// 親メニュー
	$wp_admin_bar->add_menu(
		[
			'id'    => $arkhe_menu_id,
			'title' => '<span class="ab-icon "></span><span class="ab-label">' . __( 'Arkhe Settings', 'arkhe-toolkit' ) . '</span>',
			'href'  => admin_url( 'admin.php?page=arkhe_settings' ),
			'meta'  => [
				'class' => 'arkhe-menu',
			],
		]
	);

	// サブメニュー
	$wp_admin_bar->add_menu(
		[
			'parent' => $arkhe_menu_id,
			'id'     => $arkhe_menu_id . '_menu',
			'meta'   => [],
			'title'  => __( 'To setting page', 'arkhe-toolkit' ),
			'href'   => admin_url( 'admin.php?page=arkhe_settings' ),
		]
	);
	$wp_admin_bar->add_menu(
		[
			'parent' => $arkhe_menu_id,
			'id'     => $arkhe_menu_id . '_clear_cache',
			'meta'   => [
				'class' => 'arkhe-btn-clearCache',
			],
			'title'  => __( 'Clear Cache', 'arkhe-toolkit' ),
			'href'   => '###',
		]
	);

	// プロライセンスの購入を誘導
	// 他のプラグインから追加されていなければ
	// if ( ! \Arkhe::get_plugin_data( 'added_toolbar_btn_to_pro' ) && ! \Arkhe::$has_pro_licence ) {
	// 	// 親メニュー
	// 	$wp_admin_bar->add_menu(
	// 		[
	// 			'id'    => 'arkhe_to_pro',
	// 			'title' => '<span class="ab-icon "></span><span class="ab-label">' . __( 'PROライセンス購入', 'arkhe-toolkit' ) . '</span>',
	// 			'href'  => 'https://arkhe-theme.com/',
	// 			'meta'  => [
	// 				'class'  => 'arkhe-menu',
	// 				'target' => '_blank',
	// 				'rel'    => 'noopener',
	// 			],
	// 		]
	// 	);
	// 	$wp_admin_bar->add_menu(
	// 		[
	// 			'parent' => 'arkhe_to_pro',
	// 			'id'     => 'arkhe_to_pro_menu',
	// 			'meta'   => [],
	// 			'title'  => __( 'ライセンスキー登録', 'arkhe-toolkit' ),
	// 			'href'   => admin_url( 'admin.php?page=arkhe_settings' ),
	// 		]
	// 	);
	// }
}, 99 );
