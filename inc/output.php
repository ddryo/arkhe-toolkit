<?php
namespace Arkhe_Toolkit\Output;

// add_action( 'wp_head', '\Arkhe_Toolkit\Output\hook_wp_head_9', 9 );
// add_action( 'wp_head', '\Arkhe_Toolkit\Output\hook_wp_head_99', 99 );
// add_action( 'wp_footer', '\Arkhe_Toolkit\Output\hook_wp_footer_1', 1 );
add_action( 'wp_footer', '\Arkhe_Toolkit\Output\hook_wp_footer_20', 20 );
// add_action( 'admin_head', '\Arkhe_Toolkit\Output\hook_admin_head', 20 );
// add_action( 'admin_footer', '\Arkhe_Toolkit\Output\hook_admin_footer', 20 );
// add_action( 'wp_body_open', '\Arkhe_Toolkit\Output\hook_wp_body_open', 1 );


/**
 * wp_footerで出力するコード 優先度:20
 */
function hook_wp_footer_20() {

}
