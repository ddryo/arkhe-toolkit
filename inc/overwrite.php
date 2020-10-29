<?php
/**
 * 各ページごとの表示設定の上書き
 */
namespace Arkhe_Toolkit;

/**
 * アイキャッチ画像
 */
add_filter( 'arkhe_show_entry_thumb', function( $show, $page_id ) {
	$meta = get_post_meta( $page_id, 'ark_meta_show_thumb', true );

	if ( 'show' === $meta ) {
		return true;
	} elseif ( 'hide' === $meta ) {
		return false;
	}
	return $show;
}, 10, 2 );


/**
 * 著者情報
 */
add_filter( 'arkhe_show_author_box', function( $show, $page_id ) {
	$meta = get_post_meta( $page_id, 'ark_meta_show_author', true );

	if ( 'show' === $meta ) {
		return true;
	} elseif ( 'hide' === $meta ) {
		return false;
	}
	return $show;
}, 10, 2 );


/**
 * 関連記事
 */
add_filter( 'arkhe_show_related_posts', function( $show, $page_id ) {
	$meta = get_post_meta( $page_id, 'ark_meta_show_related', true );

	if ( 'show' === $meta ) {
		return true;
	} elseif ( 'hide' === $meta ) {
		return false;
	}
	return $show;
}, 10, 2 );


/**
 * その他、フィルターフックに id が渡されていないもの
 */
add_action( 'wp', function() {

	$page_id = get_queried_object_id();

	\Arkhe_Toolkit\set_show_sidebar( $page_id );
	\Arkhe_Toolkit\set_show_ttlpos( $page_id );

} );

/**
 * サイドバーの設定
 * トップページも上書き設定可能に。
 */
function set_show_sidebar( $page_id ) {

	$meta = '';
	if ( is_single() || is_page() || is_home() ) {
		$meta = get_post_meta( $page_id, 'ark_meta_show_sidebar', true );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$meta = get_term_meta( $page_id, 'ark_term_meta_show_sidebar', true );
	}

	if ( 'show' === $meta ) {
		add_filter( 'arkhe_is_show_sidebar', '__return_true' );
	} elseif ( 'hide' === $meta ) {
		add_filter( 'arkhe_is_show_sidebar', '__return_false' );
	}
}


/**
 * タイトル表示位置
 */
function set_show_ttlpos( $page_id ) {

	$meta = '';
	if ( is_single() || is_page() || is_home() ) {
		$meta = get_post_meta( $page_id, 'ark_meta_ttlpos', true );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$meta = get_term_meta( $page_id, 'ark_term_meta_ttlpos', true );
	}

	if ( 'top' === $meta ) {
		add_filter( 'arkhe_is_show_ttltop', '__return_true' );
	} elseif ( 'inner' === $meta ) {
		add_filter( 'arkhe_is_show_ttltop', '__return_false' );
	}
}
