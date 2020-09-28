<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

class Data {

	// private static $instance;

	// 設定データを保持する変数
	protected static $data     = [];
	protected static $defaults = [];

	// DB名
	const DB_NAME_OPTIONS = 'arkhe_toolkit_options';
	const DB_NAMES        = [
		'extension' => 'arkhe_toolkit_extension',
		'remove'    => 'arkhe_toolkit_remove',
	];

	// キャッシュキー
	const CACHE_KEYS = [
		'header'  => [
			'front' => 'arkhe_parts_cache_header_front',
			'page'  => 'arkhe_parts_cache_header_page',
			'other' => 'arkhe_parts_cache_header_other',
		],
		'sidebar' => [
			'top'     => 'arkhe_parts_cache_sidebar_top',
			'single'  => 'arkhe_parts_cache_sidebar_single',
			'page'    => 'arkhe_parts_cache_sidebar_page',
			'archive' => 'arkhe_parts_cache_sidebar_archive',
		],
		'footer'  => 'arkhe_parts_cache_footer',
	];

	// メニューのページスラッグ
	const MENU_SLUG = 'arkhe_settings';

	// メニューの設定タブ
	public static $menu_tabs = [];

	// 外部からインスタンス化させない
	private function __construct() {}


	// init()
	public static function init() {

		add_action( 'init', [ '\Arkhe_Toolkit', 'data_init' ], 9 ); // テーマ側の set_settings よりも前で。
	}


	/**
	 * 設定データの初期セット
	 */
	public static function data_init() {

		// デフォルト値
		self::set_defaults();

		foreach ( self::DB_NAMES as $key => $db_name ) {
			$db_data            = get_option( $db_name ) ?: [];
			self::$data[ $key ] = array_merge( self::$defaults[ $key ], $db_data );
		}
	}


	/**
	 * デフォルト値をセット
	 */
	private static function set_defaults() {

		self::$defaults['extension'] = [
			'cache_header'       => '',
			'cache_footer'       => '',
		];

		self::$defaults['remove'] = [
			'remove_wpver'       => '1',
			'remove_rel_link'    => '1',
			'remove_wlwmanifest' => '1',
			'remove_rsd_link'    => '1',
			'remove_emoji'       => '1',
			'remove_srcset'      => '',
			'remove_wptexturize' => '',
			'remove_feed_link'   => '',
		];

	}


	/**
	 * 設定データのデフォルト値を取得
	 *   キーが指定されていればそれを、指定がなければ全てを返す。
	 */
	public static function get_default_data( $id = '', $key = '' ) {

		// DBのID名の指定なければ全部返す
		if ( '' === $id ) return self::$defaults;

		// DBのID名が存在しない時
		if ( ! isset( self::$defaults[ $id ] ) ) return null;

		// ID指定のみでキーの指定がない時
		if ( '' === $key ) return self::$defaults[ $id ];

		// 指定されたIDのデータの中に指定されたキーが存在しない時
		if ( ! isset( self::$defaults[ $id ][ $key ] ) ) return '';

		// id, key がちゃんとある時
		return self::$defaults[ $id ][ $key ];
	}


	/**
	 * 設定データ取得
	 */
	public static function get_data( $id = '', $key = '' ) {

		// DBのID名の指定なければ全部返す
		if ( '' === $id ) return self::$data;

		// DBのID名が存在しない時
		if ( ! isset( self::$data[ $id ] ) ) return null;

		// ID指定のみでキーの指定がない時
		if ( '' === $key ) return self::$data[ $id ];

		// 指定されたIDのデータの中に指定されたキーが存在しない時
		if ( ! isset( self::$data[ $id ][ $key ] ) ) return '';

		// id, key がちゃんとある時
		return self::$data[ $id ][ $key ];
	}


	/**
	 * 設定データを強制セット
	 */
	public static function set_option( $id = '', $key = '', $val = '' ) {
		if ( '' === $id || '' === $key ) return;

		// データのセット
		self::$data[ $id ][ $key ] = $val;

	}
}
