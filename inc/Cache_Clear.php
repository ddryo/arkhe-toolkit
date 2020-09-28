<?php
namespace SWELL_THEME\Hooks;

if ( ! defined( 'ABSPATH' ) ) exit;

class Cache_Clear {

	private static $instance;

	// 外部からインスタンス化させない
	private function __construct() {}

	// インスタンスを取得関数
	public static function get_instance() {
		if ( isset( self::$instance ) ) return self::$instance;
		return false;
	}


	/**
	 * init
	 */
	public static function init() {

		if ( isset( self::$instance ) ) return;
		self::$instance = new Cache_Clear();

		/**
		 * カスタマイザー表示時、一旦全キャッシュ削除
		 */
		// if ( IS_CUSTOMIZER ) \SWELL_FUNC::clear_cache();

		/**
		 * カスタマイザーの設定変更後、キャッシュを削除
		 */
		add_action( 'customize_save_after', function() {
			$keys         = \SWELL_THEME\Data::$cache_keys;
			$cache_keys   = array_merge( $keys['style'], $keys['header'], $keys['post'], $keys['widget'] );
			$cache_keys[] = 'swell_mv';
			\SWELL_FUNC::clear_cache( $cache_keys );
		});

		/**
		 * サイト名・キャッチフレーズの設定更新時
		 */
		add_action( 'update_option', function( $option_name ) {
			if ( $option_name === 'blogname' || $option_name === 'blogdescription' ) {
				$keys = \SWELL_THEME\Data::$cache_keys;
				\SWELL_FUNC::clear_cache( $keys['header'] );
			}
		});

		/**
		 * 投稿の更新時
		 */
		add_action('save_post', function( $post_ID ) {
			$keys       = \SWELL_THEME\Data::$cache_keys;
			$cache_keys = array_merge( $keys['widget'], $keys['post'] );
			\SWELL_FUNC::clear_cache( $cache_keys );
		}, 99);

		/**
		 * カテゴリー・タグの更新時
		 */
		add_action('edited_terms', function( $post_ID ) {
			$keys       = \SWELL_THEME\Data::$cache_keys;
			$cache_keys = array_merge( $keys['header'], $keys['widget'], $keys['post'] );
			\SWELL_FUNC::clear_cache( $cache_keys );
		}, 99);

		/**
		 * ウィジェット更新時
		 */
		add_filter('widget_update_callback', function( $instance, $new_instance, $old_instance, $this_item ) {
			$this_item_id = $this_item->id;
			$widgets      = wp_get_sidebars_widgets();  // = get_option( 'sidebars_widgets' );

			$keys       = \SWELL_THEME\Data::$cache_keys;
			$cache_keys = $keys['widget'];

			\SWELL_FUNC::clear_cache( $cache_keys );
			return $instance;

		}, 99, 4);

		/**
		 * ウィジェットの登録数が変わっている場合の処理（編集ではなく新規追加時の対応）
		 */
		add_action( 'widgets_init', function() {
			if ( ! IS_ADMIN ) return;
			$cache_data  = get_transient( 'swell_parts_sidebars_widgets' );
			$widget_data = wp_get_sidebars_widgets();

			if ( $cache_data !== $widget_data ) {

				$keys       = \SWELL_THEME\Data::$cache_keys;
				$cache_keys = $keys['widget'];

				if ( isset( $cache_data['head_box'] ) && isset( $widget_data['head_box'] ) ) {
					if ( $cache_data['head_box'] !== $widget_data['head_box'] ) {
						$cache_keys = array_merge( $cache_keys, $keys['header'] );
					}
				}
				\SWELL_FUNC::clear_cache( $cache_keys );

				// ウィジェット登録状況をキャッシュ
				set_transient( 'swell_parts_sidebars_widgets', $widget_data );
			}
		}, 99);

		/**
		 * カスタムメニューの更新時にキャッシュ削除
		 */
		add_action('wp_update_nav_menu', function( $menu_id ) {
			$locations = get_nav_menu_locations();

			$keys       = \SWELL_THEME\Data::$cache_keys;
			$cache_keys = $keys['widget'];

			// ロケーションに登録済みのナビであれば、ロケーションに応じてキャッシュを削除
			foreach ( $locations as $location => $id ) {
				if ( $menu_id === $id ) {

					// 複数のロケーションに設定する場合もあるので、elseif ではなく全て if で。
					if ( $location === 'header_menu' || 'sp_head_menu' ) {
						$cache_keys = array_merge( $cache_keys, $keys['header'] );
					}
				}
			}
			\SWELL_FUNC::clear_cache( $cache_keys );

		}, 99);

	}

}
