<?php
namespace Arkhe_Toolkit;

/**
 * キャッシュ生成フック
 * Toolkitの設定データを受け取れるタイミングで
 */
add_action( 'wp_loaded', function() {

	// ヘッダーキャッシュ
	if ( \Arkhe_Toolkit::get_data( 'cache', 'cache_header' ) ) {
		add_filter( 'arkhe_get_cache_header', '\Arkhe_Toolkit\hook_header_cache', 10, 4 );
	}

	// フッターキャッシュ
	if ( \Arkhe_Toolkit::get_data( 'cache', 'cache_footer' ) ) {
		add_filter( 'arkhe_get_cache_footer', '\Arkhe_Toolkit\hook_footer_cache', 10, 4 );
	}

	// サイドバー
	if ( \Arkhe_Toolkit::get_data( 'cache', 'cache_sidebar' ) ) {
		add_filter( 'arkhe_get_cache_sidebar_content', '\Arkhe_Toolkit\hook_sidebar_cache', 10, 4 );
	}

}, 20 );


// ヘッダー
function hook_header_cache( $return, $path_key, $include_path, $args ) {

	$header_cache_keys = \Arkhe_Toolkit::CACHE_KEYS['header'];

	// ページ種別ごとのキャッシュキーを取得
	$cache_key = $header_cache_keys[ \Arkhe_Toolkit::$page_type_slug ];

	$cache_data = \Arkhe_Toolkit::get_parts_cache( $path_key, $include_path, $args, $cache_key );
	return $cache_data;
}

// フッター
function hook_footer_cache( $return, $path_key, $include_path, $args ) {

	$footer_cache_keys = \Arkhe_Toolkit::CACHE_KEYS['footer'];

	// ページ種別ごとのキャッシュキーを取得
	$cache_key = $footer_cache_keys[ \Arkhe_Toolkit::$page_type_slug ];

	$cache_data = \Arkhe_Toolkit::get_parts_cache( $path_key, $include_path, $args, $cache_key );
	return $cache_data;
}

// サイドバー
function hook_sidebar_cache( $return, $path_key, $include_path, $args ) {

	$sidebar_cache_keys = \Arkhe_Toolkit::CACHE_KEYS['sidebar'];

	// ページ種別ごとのキャッシュキーを取得
	$cache_key = $sidebar_cache_keys[ \Arkhe_Toolkit::$page_type_slug ];

	$cache_data = \Arkhe_Toolkit::get_parts_cache( $path_key, $include_path, $args, $cache_key );
	return $cache_data;
}
