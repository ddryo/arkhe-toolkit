<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add hooks
 */
// SP:アドミンバー非表示
// if ( wp_is_mobile() ) add_filter( 'show_admin_bar', '__return_false' );


/* カテゴリーの説明文に対するフィルター処理を緩める (wp_filter_kses -> wp_kses_post に。) */
remove_filter( 'pre_term_description', 'wp_filter_kses' );
add_filter( 'pre_term_description', 'wp_kses_post' );


// LOOSテーマ側で用意しているフックへの処理
add_filter( 'loos_author_icon_links', 'arkhe_plus_hook___author_icon_links', 10, 2 );

/**
 * 抜粋文字数を変更する
 */
if ( ! function_exists( 'arkhe_plus_hook___author_icon_links' ) ) :
function arkhe_plus_hook___author_icon_links( $icon_links, $author_id ) {
	if ( ! $author_id ) return $icon_links;

	$icon_links['home2']     = get_the_author_meta( 'site2', $author_id ) ?: '';
	$icon_links['facebook']  = get_the_author_meta( 'facebook_url', $author_id ) ?: '';
	$icon_links['twitter']   = get_the_author_meta( 'twitter_url', $author_id ) ?: '';
	$icon_links['instagram'] = get_the_author_meta( 'instagram_url', $author_id ) ?: '';
	$icon_links['pinterest'] = get_the_author_meta( 'pinterest_url', $author_id ) ?: '';
	$icon_links['github']    = get_the_author_meta( 'github_url', $author_id ) ?: '';
	$icon_links['youtube']   = get_the_author_meta( 'youtube_url', $author_id ) ?: '';
	$icon_links['amazon']    = get_the_author_meta( 'amazon_url', $author_id ) ?: '';

	// 空の要素を排除してリターン
	return array_filter( $icon_links );
}
endif;
