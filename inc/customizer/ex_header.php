<?php
namespace Arkhe_Toolkit;

use \Arkhe_Theme\Customizer;

$arkhe_section = 'arkhe_section_header';

// ヘッダーのボタン配置
Customizer::big_title(
	$arkhe_section,
	'header_btn_layout',
	[
		'label'       => __( 'Button layout in the header', 'arkhe-toolkit' ),
		'classname'   => '-toolkit',
	]
);
// ボタンレイアウト
Customizer::add(
	$arkhe_section,
	'header_btn_layout',
	[
		'classname'   => '-toolkit -btn-layout',
		'type'        => 'radio',
		'choices'     => [
			'l-r'    => 'L-R',
			'r-l'    => 'R-L',
			'rl-rr'  => 'RL-RR',
			'rr-rl'  => 'RR-RL',
		],
		'db'          => \Arkhe_Toolkit::DB_NAMES['customizer'],
		'default'     => \Arkhe_Toolkit::get_default_data( 'customizer', 'header_btn_layout' ),
	]
);


// ドロワーメニューの展開方式
Customizer::big_title(
	$arkhe_section,
	'drawer_move',
	[
		'label'       => __( 'How to expand the drawer menu', 'arkhe-toolkit' ),
		'classname'   => '-toolkit',
	]
);

Customizer::add(
	$arkhe_section,
	'drawer_move',
	[
		'type'        => 'radio',
		'choices'     => [
			'fade'  => __( 'Fade-in', 'arkhe-toolkit' ),
			'left'  => __( 'Slide from left', 'arkhe-toolkit' ),
			'right' => __( 'Slide from right', 'arkhe-toolkit' ),
		],
		'db'          => \Arkhe_Toolkit::DB_NAMES['customizer'],
		'default'     => \Arkhe_Toolkit::get_default_data( 'customizer', 'drawer_move' ),
	]
);


Customizer::add(
	$arkhe_section,
	'header_above_drawer',
	[
		'type'        => 'checkbox',
		'label'       => __( 'Display below the header', 'arkhe-toolkit' ),
		'db'          => \Arkhe_Toolkit::DB_NAMES['customizer'],
		'default'     => \Arkhe_Toolkit::get_default_data( 'customizer', 'header_above_drawer' ),
	]
);
