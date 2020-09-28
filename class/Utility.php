<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

trait Utility {

	/**
	 * キャッシュの取得 & 生成
	 */
	public static function get_parts_cache( $path_key, $include_path, $args, $cache_key = '', $days = 30 ) {

		if ( '' === $cache_key || is_customize_preview() ) return '';

		// キャッシュの取得
		$cache_data = get_transient( $cache_key );

		// キャッシュあればすぐ返す
		if ( ! empty( $cache_data ) ) return $cache_data;

		// キャッシュが消えていれば生成
		ob_start();
		\ARKHE_THEME::the_parts_content( $path_key, $include_path, $args );
		$cache_data = \Arkhe_Toolkit::minify_html_code( ob_get_clean() );

		// キャッシュ保存期間
		$expiration = 30 * DAY_IN_SECONDS;

		// キャッシュデータの生成
		set_transient( $cache_key, $cache_data, $expiration );

		// 生成したキャッシュデータを返す
		return $cache_data;
	}


	/**
	 * HTMLソースのminify化
	 */
	public static function minify_html_code( $src ) {
		$search  = [
			'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
			'/[^\S ]+\</s',  // strip whitespaces before tags, except space
			'/(\s)+/s',       // shorten multiple whitespace sequences
			'/<!--[\s\S]*?-->/s', // コメントを削除
		];
		$replace = [
			'>',
			'<',
			'\\1',
			'',
		];
		return preg_replace( $search, $replace, $src );
	}
}
