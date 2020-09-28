<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * ユーザーメタの追加
 */
add_filter( 'user_contactmethods', 'arkhe_plus_hook__user_contactmethods' );


/**
 * ユーザーメタを追加
 */
function arkhe_plus_hook__user_contactmethods( $prof_items ) {
	$prof_items['site2']         = 'サイト2';
	$prof_items['position']      = '役職・肩書き';
	$prof_items['facebook_url']  = 'Facebook URL';
	$prof_items['twitter_url']   = 'Twitter URL';
	$prof_items['instagram_url'] = 'Instagram URL';
	$prof_items['pinterest_url'] = 'Pinterest URL';
	$prof_items['github_url']    = 'Github URL';
	$prof_items['youtube_url']   = 'Youtube URL';
	$prof_items['amazon_url']    = 'Amazon欲しいものリストURL';

	return $prof_items;
}
