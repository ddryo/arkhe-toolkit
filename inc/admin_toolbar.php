<?php
namespace Arkhe_Toolkit;

// 「カスタマイズ」を管理画面側にも追加
add_filter( 'admin_bar_menu', function ( $wp_admin_bar ) {
	if ( ! is_admin() ) return;
	$wp_admin_bar->add_menu(
		[
			'id'    => 'customize',
			// phpcs:ignore WordPress.WP.I18n.MissingArgDomain
			'title' => '<span class="ab-label">' . __( 'Customize' ) . '</span>',
			'href'  => admin_url( 'customize.php' ),
		]
	);
}, 50);

// Toolkitツールバー
add_filter( 'admin_bar_menu', function ( $wp_admin_bar ) {

	$arkhe_menu_id = 'arkhe_toolkit';

	// 親メニュー
	$wp_admin_bar->add_menu(
		[
			'id'    => $arkhe_menu_id,
			'title' => '<span class="ab-icon -arkhe">' . \Arkhe_Toolkit::get_svg_icon( 'arkhe' ) . '</span><span class="ab-label">' . __( 'Arkhe Toolkit', 'arkhe-toolkit' ) . '</span>',
			'href'  => admin_url( 'admin.php?page=' . \Arkhe_Toolkit::MENU_SLUG ),
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
			'href'   => admin_url( 'admin.php?page=' . \Arkhe_Toolkit::MENU_SLUG ),
		]
	);
	$wp_admin_bar->add_menu(
		[
			'parent' => $arkhe_menu_id,
			'id'     => $arkhe_menu_id . '_theme_page',
			'meta'   => [],
			'title'  => __( 'To theme page', 'arkhe-toolkit' ),
			'href'   => admin_url( 'themes.php?page=arkhe' ),
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

	// プロライセンス購入ページへの導線
	if ( ! \Arkhe::get_plugin_data( 'added_toolbar_to_pro' ) && ! \Arkhe::$has_pro_licence ) {
		\Arkhe::set_plugin_data( 'added_toolbar_to_pro', 1 );

		$licence_shop_url = \Arkhe::$is_ja ? '/ja/product/arkhe-licence/' : '/ja/product/arkhe-licence/'; // 英語ページ用意できたら変更

		// 親メニュー
		$wp_admin_bar->add_menu(
			[
				'id'    => 'arkhe_to_pro',
				'title' => '<span class="ab-icon "></span><span class="ab-label">' . __( 'Get license', 'arkhe-toolkit' ) . '</span>',
				'href'  => 'https://arkhe-theme.com' . $licence_shop_url,
				'meta'  => [
					'class'  => 'arkhe-menu',
					'target' => '_blank',
					'rel'    => 'noopener',
				],
			]
		);
		$wp_admin_bar->add_menu(
			[
				'parent' => 'arkhe_to_pro',
				'id'     => 'arkhe_to_pro_menu',
				'meta'   => [],
				'title'  => __( 'License key registration', 'arkhe-toolkit' ),
				'href'   => admin_url( 'themes.php?page=arkhe&tab=licence' ),
			]
		);
	}
}, 99 );
