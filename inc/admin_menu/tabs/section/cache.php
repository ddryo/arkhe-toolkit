<?php
namespace Arkhe_Toolkit;

if ( ! defined( 'ABSPATH' ) ) exit;

$db = 'cache';

$remove_settings = [
	'cache_header'  => __( 'Cache header', 'arkhe-toolkit' ),
	'cache_sidebar' => __( 'Cache sidebar', 'arkhe-toolkit' ),
	'cache_footer'  => __( 'Cache footer', 'arkhe-toolkit' ),

];
foreach ( $remove_settings as $key => $label ) {
	\Arkhe_Toolkit::output_checkbox([
		'db'    => $db,
		'key'   => $key,
		'label' => $label,
	]);
}
