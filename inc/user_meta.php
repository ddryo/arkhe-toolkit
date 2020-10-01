<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * ユーザーメタの追加
 */
add_filter( 'user_contactmethods', '\Arkhe_Toolkit\add_user_meta' );
function add_user_meta( $prof_items ) {
	$prof_items['position']      = __( '役職・肩書き', 'arkhe-toolkit' );
	$prof_items['facebook_url']  = __( 'Facebook URL', 'arkhe-toolkit' );
	$prof_items['twitter_url']   = __( 'Twitter URL', 'arkhe-toolkit' );
	$prof_items['instagram_url'] = __( 'Instagram URL', 'arkhe-toolkit' );
	$prof_items['pinterest_url'] = __( 'Pinterest URL', 'arkhe-toolkit' );
	$prof_items['github_url']    = __( 'Github URL', 'arkhe-toolkit' );
	$prof_items['youtube_url']   = __( 'Youtube URL', 'arkhe-toolkit' );
	$prof_items['amazon_url']    = __( 'Amazon欲しいものリストURL', 'arkhe-toolkit' );

	return $prof_items;
}
