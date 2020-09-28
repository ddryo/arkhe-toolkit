<?php
use \ARKHE_THEME\Customizer;
if ( ! defined( 'ABSPATH' ) ) exit;

// セクション : SNSシェアボタン
$section = 'loos_section_share_btn';
$wp_customize->add_section(
	$section,
	array(
		'title'    => __( 'SNS share button', 'loos' ),
		'priority' => 10,
		'panel'    => 'loos_panel_single',
	)
);

// 表示設定
Customizer::big_title(
	$section,
	'sns_share_btn',
	array(
		'label' => __( 'Display settings', 'loos' ),
	)
);

// 表示位置
Customizer::sub_title(
	$section,
	'is_show_sahre_btn',
	array(
		'label' => __( 'Display position', 'loos' ),
	)
);

// 記事の上部に表示
Customizer::add(
	$section,
	'show_share_btn_top',
	array(
		'classname'   => '',
		'label'       => __( 'Display at the top of the article', 'loos' ),
		'type'        => 'checkbox',
	)
);

// 記事の下部に表示
Customizer::add(
	$section,
	'show_share_btn_bottom',
	array(
		'classname'   => '',
		'label'       => __( 'Display at the bottom of the article', 'loos' ),
		'type'        => 'checkbox',
	)
);

// どのボタンを表示するか
Customizer::sub_title(
	$section,
	'select_sns',
	array(
		'label' => __( 'Which button to display', 'loos' ),
	)
);

// Facebook
Customizer::add(
	$section,
	'show_share_btn_fb',
	array(
		'classname'   => '',
		'label'       => 'Facebook',
		'type'        => 'checkbox',
	)
);

// Twitter
Customizer::add(
	$section,
	'show_share_btn_tw',
	array(
		'classname'   => '',
		'label'       => 'Twitter',
		'type'        => 'checkbox',
	)
);

// はてブ
Customizer::add(
	$section,
	'show_share_btn_hatebu',
	array(
		'classname'   => '',
		'label'       => 'はてブ',
		'type'        => 'checkbox',
	)
);

// Pocket
Customizer::add(
	$section,
	'show_share_btn_pocket',
	array(
		'classname'   => '',
		'label'       => 'Pocket',
		'type'        => 'checkbox',
	)
);

// Pinterest
Customizer::add(
	$section,
	'show_share_btn_pin',
	array(
		'classname'   => '',
		'label'       => 'Pinterest',
		'type'        => 'checkbox',
	)
);

// LINE
Customizer::add(
	$section,
	'show_share_btn_line',
	array(
		'classname'   => '',
		'label'       => 'LINE',
		'type'        => 'checkbox',
	)
);

// デザイン
Customizer::add(
	$section,
	'share_btn_style',
	array(
		'classname'   => '',
		'label'       => __( 'Design', 'loos' ),
		'type'        => 'select',
		'choices'     => array(
			'block' => __( 'Block', 'loos' ),
			'icon'  => __( 'Icon', 'loos' ),
		),
	)
);


// Twitter用の追加設定
Customizer::big_title(
	$section,
	'sns_share_add_setting',
	array(
		'label' => __( 'Additional settings for Twitter', 'loos' ),
	)
);

// シェアされた時のハッシュタグ
// 「#」は含まず、複数の時は「,」区切りで入力してください。
Customizer::add(
	$section,
	'share_hashtags',
	array(
		'classname'   => '',
		'label'       => __( 'Hashtag when shared', 'loos' ),
		'description' => __( 'Please do not include "#" and enter "," separated when multiple.', 'loos' ),
		'type'        => 'text',
	)
);

// via設定（メンション先）
// 「@」を除いたTwitter IDを入力してください。
Customizer::add(
	$section,
	'share_via',
	array(
		'classname'   => '',
		'label'       => __( 'via setting (mention destination)', 'loos' ),
		'description' => __( 'Please enter your Twitter ID without the "@".', 'loos' ),
		'type'        => 'text',
	)
);
