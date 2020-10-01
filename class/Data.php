<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

class Data {

	// private static $instance;

	// 設定データを保持する変数
	protected static $data     = [];
	protected static $defaults = [];

	// DB名
	// const DB_NAME_OPTIONS = 'arkhe_toolkit_options';
	const DB_NAMES = [
		'extension' => 'arkhe_toolkit_extension',
		'cache'     => 'arkhe_toolkit_cache',
		'remove'    => 'arkhe_toolkit_remove',
	];

	// キャッシュキー
	const CACHE_KEYS = [
		'header'  => [
			'front'  => 'header_front',
			'page'   => 'header_page',
			'single' => 'header_single',
			'other'  => 'header_other',
		],
		'sidebar' => [
			'front'   => 'sidebar_front',
			'page'    => 'sidebar_page',
			'single'  => 'sidebar_single',
			'other'   => 'sidebar_other',
		],
		'footer'  => [
			'front'   => 'footer_front',
			'page'    => 'footer_page',
			'single'  => 'footer_single',
			'other'   => 'footer_other',
		],
		// 'other' => [
		// 	'hoge',
		// ],

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

		self::$defaults['cache'] = [
			'cache_header'       => '',
			'cache_footer'       => '',
			'cache_sidebar'      => '',
		];

		self::$defaults['remove'] = [
			'remove_wpver'       => '',
			'remove_rel_link'    => '',
			'remove_wlwmanifest' => '',
			'remove_rsd_link'    => '',
			'remove_emoji'       => '',
			'remove_self_ping'   => '',
			'remove_sitemap'     => '',
			'remove_rest_link'   => '',
			'remove_srcset'      => '',
			'remove_wptexturize' => '',
			'remove_feed_link'   => '',
		];

	}


	/**
	 * 設定データのデフォルト値を取得
	 *   キーが指定されていればそれを、指定がなければ全てを返す。
	 */
	public static function get_default_data( $name_key = '', $key = '' ) {

		// DBのID名の指定なければ全部返す
		if ( '' === $name_key ) return self::$defaults;

		// DBのID名が存在しない時
		if ( ! isset( self::$defaults[ $name_key ] ) ) return null;

		// ID指定のみでキーの指定がない時
		if ( '' === $key ) return self::$defaults[ $name_key ];

		// 指定されたIDのデータの中に指定されたキーが存在しない時
		if ( ! isset( self::$defaults[ $name_key ][ $key ] ) ) return '';

		// id, key がちゃんとある時
		return self::$defaults[ $name_key ][ $key ];
	}


	/**
	 * 設定データ取得
	 */
	public static function get_data( $name_key = '', $key = '' ) {

		// DBのID名の指定なければ全部返す
		if ( '' === $name_key ) return self::$data;

		// DBのID名が存在しない時
		if ( ! isset( self::$data[ $name_key ] ) ) return null;

		// ID指定のみでキーの指定がない時
		if ( '' === $key ) return self::$data[ $name_key ];

		// 指定されたIDのデータの中に指定されたキーが存在しない時
		if ( ! isset( self::$data[ $name_key ][ $key ] ) ) return '';

		// id, key がちゃんとある時
		return self::$data[ $name_key ][ $key ];
	}


	/**
	 * 設定データを強制セット
	 */
	public static function set_data( $name_key = '', $key = '', $val = '' ) {
		if ( '' === $name_key || '' === $key ) return;

		// データのセット
		self::$data[ $name_key ][ $key ] = $val;

	}

	/**
	 * 設定データをリセット
	 */
	public static function reset_data( $id = '' ) {
		if ( $id ) {
			// 指定されたものだけ削除
			delete_option( \Arkhe_Toolkit::DB_NAMES[ $id ] );
		} else {
			// 全削除
			foreach ( \Arkhe_Toolkit::DB_NAMES as $db_name ) {
				delete_option( $db_name );
			}
		}

	}
}
