<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * 不要機能の削除
 */
add_action( 'wp_loaded', 'arkhe_plus_hook__remove', 11 ); // wp_loaded なのは 設定値を受け取るため


/**
 * 設定に合わせて不要な機能・出力を削除
 */
function arkhe_plus_hook__remove() {

	$data = \Arkhe_Toolkit::get_data( 'remove' );

	// WordPressのバージョン情報
	if ( $data['remove_wpver'] ) {
		remove_action( 'wp_head', 'wp_generator' );
	}

	// srcset
	if ( $data['remove_srcset'] ) {
		add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
	}

	// 絵文字
	if ( $data['remove_emoji'] ) {
		add_filter( 'emoji_svg_url', '__return_false' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}

	// rel="prev"とrel="next"のlinkタグを自動で書き出さない
	if ( $data['remove_rel_link'] ) {
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	}

	// Windows Live Writeの停止
	if ( $data['remove_wlwmanifest'] ) {
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}
	// EditURI(RSD Link)の停止
	if ( $data['remove_rsd_link'] ) {
		remove_action( 'wp_head', 'rsd_link' );
	}

	// 記号の自動変換停止(wptexturize無効化)
	if ( $data['remove_wptexturize'] ) {
		add_filter( 'run_wptexturize', '__return_false' );
	}

	// RSSフィード
	if ( $data['remove_feed_link'] ) {
		remove_action( 'wp_head', 'feed_links', 2 ); // 記事フィードリンク停止
		remove_action( 'wp_head', 'feed_links_extra', 3 ); // カテゴリ・コメントフィードリンク停止
	} else {
		add_theme_support( 'automatic-feed-links' );
	}

	/**
	 * script/styleタグで不要なtype属性を非表示
	 */
	// add_filter('script_loader_tag', function ($tag) {
	//     return str_replace("type='text/javascript' ", "", $tag);
	// });
	// add_filter('style_loader_tag', function ($tag) {
	//     return str_replace("type='text/css' ", "", $tag);
	// });
}
