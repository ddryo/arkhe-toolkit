<?php
namespace Arkhe_Toolkit;

defined( 'ABSPATH' ) || exit;

class Data {

	// private static $instance;

	// 設定データを保持する変数
	protected static $data     = [];
	protected static $defaults = [];

	// ページ種別判定用のスラッグ(キャッシュキーの取得などに使う)
	public static $page_type_slug = '';

	// DB名
	// const DB_NAME_OPTIONS = 'arkhe_toolkit_options';
	const DB_NAMES = [
		'customizer' => 'arkhe_toolkit_customizer',
		'extension'  => 'arkhe_toolkit_extension',
		'cache'      => 'arkhe_toolkit_cache',
		'remove'     => 'arkhe_toolkit_remove',
	];

	// キャッシュキー
	const CACHE_KEYS = [
		'header'  => [
			'front'  => 'arkhe_parts_header_front',
			'page'   => 'arkhe_parts_header_page',
			'single' => 'arkhe_parts_header_single',
			'other'  => 'arkhe_parts_header_other',
		],
		'sidebar' => [
			'front'   => 'arkhe_parts_sidebar_front',
			'page'    => 'arkhe_parts_sidebar_page',
			'single'  => 'arkhe_parts_sidebar_single',
			'other'   => 'arkhe_parts_sidebar_other',
		],
		'footer'  => [
			'front'   => 'arkhe_parts_footer_front',
			'page'    => 'arkhe_parts_footer_page',
			'single'  => 'arkhe_parts_footer_single',
			'other'   => 'arkhe_parts_footer_other',
		],
		// 'other' => [
		// 	'hoge',
		// ],
	];

	// JSの読み込みを制御する変数
	public static $use_pinterest    = false;
	public static $use_clipboard_js = false;

	// メニューのページスラッグ
	const MENU_SLUG = 'arkhe_settings';

	// メニューの設定タブ
	public static $menu_tabs = [];

	// 外部からインスタンス化させない
	private function __construct() {}


	// init()
	public static function init() {

		// 設定データセット
		add_action( 'after_setup_theme', [ '\Arkhe_Toolkit', 'data_init' ], 9 );
		add_action( 'wp', [ '\Arkhe_Toolkit', 'set_page_type_slug' ] );
		add_action( 'wp_loaded', [ '\Arkhe_Toolkit', 'customizer_data_init' ] );

	}


	/**
	 * 設定データの初期セット
	 */
	public static function data_init() {

		// デフォルト値
		self::set_defaults();

		foreach ( self::DB_NAMES as $key => $db_name ) {
			if ( 'customizer' === $key ) continue;
			$db_data            = get_option( $db_name ) ?: [];
			self::$data[ $key ] = array_merge( self::$defaults[ $key ], $db_data );
		}
	}

	/**
	 * ページ種別判定用のスラッグをセット
	 */
	public static function set_page_type_slug() {
		if ( is_front_page() ) {
			self::$page_type_slug = 'front';
		} elseif ( is_page() || is_home() ) {
			self::$page_type_slug = 'page';
		} elseif ( is_single() ) {
			self::$page_type_slug = 'single';
		} else {
			self::$page_type_slug = 'other';
		}
	}

	/**
	 * カスタマイザーデータの初期セット
	 */
	public static function customizer_data_init() {
		$db_data                  = get_option( self::DB_NAMES['customizer'] ) ?: [];
		self::$data['customizer'] = array_merge( self::$defaults['customizer'], $db_data );
	}


	/**
	 * デフォルト値をセット
	 */
	private static function set_defaults() {

		self::$defaults['customizer'] = [
			'drawer_move'           => 'fade',
			'header_btn_layout'     => 'l-r',
			'header_above_drawer'   => false,

			// シェアボタン
			'show_sharebtns_top'    => false,
			'show_sharebtns_bottom' => true,
			'show_share_fb'         => true,
			'show_share_tw'         => true,
			'show_share_hatebu'     => true,
			'show_share_pocket'     => true,
			'show_share_pin'        => true,
			'show_share_line'       => true,
			'show_share_urlcopy'    => true,
		];

		self::$defaults['extension'] = [
			'use_page_widget'   => '1',
			'use_post_widget'   => '1',
			'use_home_widget'   => '1',
			'use_luminous'      => '1',
			'use_lazysizes'     => '1',
			'remove_emp_p'      => '1',

			'use_user_urls'     => '1',
			'use_user_position' => '1',
		];

		self::$defaults['cache'] = [
			'cache_header'       => '',
			'cache_footer'       => '',
			'cache_sidebar'      => '',
		];

		self::$defaults['remove'] = [
			'remove_wpver'         => '1',
			'remove_emoji'         => '1',
			'remove_core_patterns' => '',
			'remove_rel_link'      => '',
			'remove_wlwmanifest'   => '',
			'remove_rsd_link'      => '',
			'remove_self_ping'     => '',
			'remove_sitemap'       => '',
			'remove_rest_link'     => '',
			'remove_srcset'        => '',
			'remove_wptexturize'   => '',
			'remove_feed_link'     => '',
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
			// カスタマイザー以外全削除
			foreach ( \Arkhe_Toolkit::DB_NAMES as $key => $db_name ) {
				if ( 'customizer' === $key ) continue;
				delete_option( $db_name );
			}
		}

	}
}
