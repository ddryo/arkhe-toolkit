<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * 管理画面の投稿一覧テーブルの表示をカスタマイズする
 */
add_filter( 'manage_posts_columns', 'arkhe_plus_hook__add_post_columns' ); // 投稿 & カスタム投稿
add_filter( 'manage_pages_columns', 'arkhe_plus_hook__add_post_columns' ); // 固定ページ
add_action( 'manage_posts_custom_column', 'arkhe_plus_hook__output_post_columns', 10, 2 );  // 投稿 & カスタム投稿
add_action( 'manage_pages_custom_column', 'arkhe_plus_hook__output_post_columns', 10, 2 );  // 固定ページ


/**
 * 投稿一覧テーブルに アイキャッチ画像などの列を追加。
 */
if ( ! function_exists( 'arkhe_plus_hook__add_post_columns' ) ) :
function arkhe_plus_hook__add_post_columns( $columns ) {
	global $post_type;

	// 投稿タイプごとに分岐
	if ( in_array( $post_type, ['post', 'page' ], true ) ) {

		$columns['thumbnail'] = 'アイキャッチ';
		$columns['post_id']   = 'ID';

		}
	return $columns;
}
endif;

/**
 * 投稿ID & サムネイル画像を表示する
 */
if ( ! function_exists( 'arkhe_plus_hook__output_post_columns' ) ) :
function arkhe_plus_hook__output_post_columns( $column_name, $the_id ) {

	if ( 'thumbnail' === $column_name ) {

		// サムネイル画像を表示する
		$thumb_id = get_post_thumbnail_id( $the_id );
		$ttlbg    = get_post_meta( $the_id, 'swell_meta_ttlbg', true );
		if ( $thumb_id ) {
			$thumb_img = wp_get_attachment_image_src( $thumb_id, 'medium' );
			echo '<img src="' . esc_url( $thumb_img[0] ) . '">';
		} else {
			echo '—';  // em dash
		}
		} elseif ( 'post_id' === $column_name ) {

		// 投稿IDを表示する
		echo esc_html( $the_id );

		}
}
endif;
