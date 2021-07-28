<?php
/**
 * 各ページごとの表示設定の上書き
 */
namespace Arkhe_Toolkit;

/**
 * タームページのリストレイアウト
 */
add_filter( 'arkhe_list_type_on_term', function( $layout, $term_id ) {
	$meta = get_term_meta( $term_id, 'ark_meta_list_type', true );
	if ( '' !== $meta ) {
		return $meta;
	}
	return $layout;
}, 10, 2 );


/**
 * ページタイトルにサブタイトル追加
 */
add_filter( 'arkhe_page_subtitle', '\Arkhe_Toolkit\hook_page_subtitle', 10, 2 );
function hook_page_subtitle( $subtitle, $page_id ) {
	$meta_subtitle = get_post_meta( $page_id, 'ark_meta_subttl', true ) ?: '';
	if ( $meta_subtitle ) return $meta_subtitle;
	return $subtitle;
}


/**
 * タイトル背景画像
 */
add_filter( 'arkhe_ttlbg_img_id', '\Arkhe_Toolkit\hook_ttlbg_img_id', 10, 2 );
function hook_ttlbg_img_id( $img_id, $page_id ) {
	if ( is_category() || is_tag() || is_tax() ) {
		$meta = get_term_meta( $page_id, 'ark_meta_ttlbg', true );
	} else {
		$meta = get_post_meta( $page_id, 'ark_meta_ttlbg', true );
	}

	if ( ! $meta ) return $img_id;
	return $meta;
}


/**
 * 上部タイトルエリアに表示する抜粋分
*/
add_filter( 'arkhe_top_area_excerpt', '\Arkhe_Toolkit\hook_top_area_excerpt', 10, 2 );
function hook_top_area_excerpt( $excerpt, $the_id ) {
	$meta = get_post_meta( $the_id, 'ark_meta_show_excerpt', true ) ?: false;
	if ( $meta ) {
		$post_data = get_post( $the_id );
		$excerpt   = ! empty( $post_data ) ? $post_data->post_excerpt : '';
	};
	return $excerpt;
}


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
 * その他、フィルターフック自体に id が渡されていないものなど
 */
add_action( 'wp', function() {

	$the_id = get_queried_object_id();

	\Arkhe_Toolkit\set_ttlpos( $the_id );

	// タームの説明文を表示するかどうか
	if ( is_category() || is_tag() || is_tax() ) {
		\Arkhe_Toolkit\set_term_page( $the_id );
	}
} );


/**
 * サイドバーの設定
 * トップページも上書き設定可能に。
 */
function set_term_page( $term_id ) {

	// タームの説明文を表示するかどうか
	$meta_show_desc = get_term_meta( $term_id, 'ark_meta_show_desc', true );
	if ( '' !== $meta_show_desc && ! $meta_show_desc ) {
		add_filter( 'arkhe_show_term_description', '__return_false' );
	}

	// サイドバーを表示するかどうか
	$meta_show_sidebar = get_term_meta( $term_id, 'ark_meta_show_sidebar', true );

	if ( 'show' === $meta_show_sidebar ) {
		add_filter( 'arkhe_is_show_sidebar', '__return_true' );
	} elseif ( 'hide' === $meta_show_sidebar ) {
		add_filter( 'arkhe_is_show_sidebar', '__return_false' );
	}
}


/**
 * タイトル表示位置
 */
function set_ttlpos( $page_id ) {

	$meta = '';
	if ( is_single() || is_page() || is_home() ) {
		$meta = get_post_meta( $page_id, 'ark_meta_ttlpos', true );
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$meta = get_term_meta( $page_id, 'ark_meta_ttlpos', true );
	}

	if ( 'none' === $meta ) {
		add_filter( 'arkhe_is_show_ttltop', '__return_false' );

		// for ~arkhe1.4
		add_filter( 'arkhe_part_cache__page/head', function() {
			return '<!-- The title is hidden -->';
		} );
		// for arkhe1.5~
		add_filter( 'arkhe_part_cache__page/title', function() {
			return '<!-- The title is hidden -->';
		} );

	} elseif ( 'top' === $meta ) {
		add_filter( 'arkhe_is_show_ttltop', '__return_true' );
	} elseif ( 'inner' === $meta ) {
		add_filter( 'arkhe_is_show_ttltop', '__return_false' );
	}
}
