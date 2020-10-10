<?php
namespace Arkhe_Toolkit;

use \Arkhe_Theme\Customizer;

$arkhe_section = 'arkhe_section_header';


Customizer::big_title(
	$arkhe_section,
	'header_test',
	[
		'label'       => __( 'ドロワーメニューの展開方式', 'arkhe-toolkit' ),
		'description' => __( 'You can set the image to use from the "Site Identity" menu.', 'arkhe-toolkit' ),
		'classname'   => '-toolkit',
	]
);

Customizer::add(
	$arkhe_section,
	'drawer_move',
	[
		'type'        => 'radio',
		'choices'     => [
			'fade'  => 'フェードイン',
			'left'  => '左からスライド',
			'right' => '右からスライド',
		],
		'db'          => \Arkhe_Toolkit::DB_NAMES['customizer'],
		'default'     => \Arkhe_Toolkit::get_default_data( 'customizer', 'drawer_move' ),
	]
);

// Customizer::add(
// 	$arkhe_section,
// 	'the_test',
// 	[
// 		'label'       => __( 'TEST', 'arkhe-toolkit' ),
// 		'db'          => \Arkhe_Toolkit::DB_NAMES['customizer'],
// 		'default'     => \Arkhe_Toolkit::get_default_data( 'customizer', 'the_test' ),
// 	]
// );
