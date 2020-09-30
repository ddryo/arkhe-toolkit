<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

trait Utility {

	/**
	 * 設定メニューの項目を追加
	 */
	public static function add_menu_section( $args ) {

		extract( array_merge( [
			'title'      => '',
			'key'        => '',
			'section_cb' => '',
			'page_name'  => '',
			'page_cb'    => '',
		], $args ) );

		$section_name = 'arkhe_' . $key . '_section';

		add_settings_section(
			$section_name,
			$title,
			$section_cb,
			$page_name
		);

		// コールバック関数の指定が特になければ、ファイルを読み込む
		$page_cb = $page_cb ?: function( $args ) {
			include ARKHE_TOOLKIT_PATH . 'inc/admin_menu/tabs/section/' . $args['filename'] . '.php';
		};

		add_settings_field(
			$section_name . '_fields',
			'',
			$page_cb,
			$page_name,
			$section_name,
			[ 'filename' => $key ]
		);
	}


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
	 * キャッシュのクリア
	 */
	public static function clear_cache( $cache_keys = [], $prefix = 'arkhe_parts_' ) {

		// キャッシュキーの指定がなければ全てのキーを取得
		if ( [] === $cache_keys ) {
			foreach ( \Arkhe_Toolkit::CACHE_KEYS as $type => $keys ) {
				$cache_keys = array_merge( $cache_keys, $keys );
			}
		}

		// 指定されたキャッシュキーを順に削除
		foreach ( $cache_keys as $index => $key ) {
			delete_transient( $prefix . $key );
		}
	}


	/**
	 * AJAXのNonceチェック
	 */
	public static function check_ajax_nonce( $request_key = 'nonce', $nonce_key = 'arkhe-toolkit-ajax-nonce' ) {
		if ( ! isset( $_POST[ $request_key ] ) ) return false;

		$nonce = $_POST[ $request_key ];

		if ( wp_verify_nonce( $nonce, $nonce_key ) ) {
			return true;
		}

		return false;
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
