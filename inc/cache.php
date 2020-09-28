<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

// キャッシュ削除
// delete_transient( $cache_key );

// Toolkitの設定データを受け取れるタイミングで処理
add_action( 'init', function() {

	if ( \Arkhe_Toolkit::get_data( 'extension', 'cache_header' ) ) {
		add_filter( 'arkhe_get_cache_header', '\Arkhe_Toolkit\hook_header_cache', 10, 4 );
	}

}, 20 );


// ヘッダー
function hook_header_cache( $return, $path_key, $include_path, $args ) {

	$header_cache_keys = \Arkhe_Toolkit::CACHE_KEYS['header'];

	// ヘッダーは top, page, その他でキャッシュを作成する。
	if ( is_front_page() ) {
		$cache_key = $header_cache_keys['front'];
	} elseif ( is_page() || is_home() ) {
		$cache_key = $header_cache_keys['page'];
	} else {
		$cache_key = $header_cache_keys['other'];
	}

	$cache_data = \Arkhe_Toolkit::get_parts_cache( $path_key, $include_path, $args, $cache_key );
	if ( '' === $cache_data ) return $return;
	return $cache_data; // . 'cacheだよ';

}
