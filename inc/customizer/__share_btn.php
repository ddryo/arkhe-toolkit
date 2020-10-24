<?php
use \Arkhe_Theme\Customizer;
defined( 'ABSPATH' ) || exit;

// セクション : SNSシェアボタン
$section = 'loos_section_share_btn';
$wp_customize->add_section(
	$section,
	[
		'title'    => __( 'SNS share button', 'arkhe-toolkit' ),
		'priority' => 10,
		'panel'    => 'loos_panel_single',
	]
);

// 表示設定
Customizer::big_title(
	$section,
	'sns_share_btn',
	[
		'label' => __( 'Display settings', 'arkhe-toolkit' ),
	]
);

// 表示位置
Customizer::sub_title(
	$section,
	'is_show_sahre_btn',
	[
		'label' => __( 'Display position', 'arkhe-toolkit' ),
	]
);

// 記事の上部に表示
Customizer::add(
	$section,
	'show_share_btn_top',
	[
		'classname'   => '',
		'label'       => __( 'Display at the top of the article', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// 記事の下部に表示
Customizer::add(
	$section,
	'show_share_btn_bottom',
	[
		'classname'   => '',
		'label'       => __( 'Display at the bottom of the article', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// どのボタンを表示するか
Customizer::sub_title(
	$section,
	'select_sns',
	[
		'label' => __( 'Which button to display', 'arkhe-toolkit' ),
	]
);

// Facebook
Customizer::add(
	$section,
	'show_share_btn_fb',
	[
		'classname'   => '',
		'label'       => 'Facebook',
		'type'        => 'checkbox',
	]
);

// Twitter
Customizer::add(
	$section,
	'show_share_btn_tw',
	[
		'classname'   => '',
		'label'       => 'Twitter',
		'type'        => 'checkbox',
	]
);

// はてブ
Customizer::add(
	$section,
	'show_share_btn_hatebu',
	[
		'classname'   => '',
		'label'       => 'はてブ',
		'type'        => 'checkbox',
	]
);

// Pocket
Customizer::add(
	$section,
	'show_share_btn_pocket',
	[
		'classname'   => '',
		'label'       => 'Pocket',
		'type'        => 'checkbox',
	]
);

// Pinterest
Customizer::add(
	$section,
	'show_share_btn_pin',
	[
		'classname'   => '',
		'label'       => 'Pinterest',
		'type'        => 'checkbox',
	]
);

// LINE
Customizer::add(
	$section,
	'show_share_btn_line',
	[
		'classname'   => '',
		'label'       => 'LINE',
		'type'        => 'checkbox',
	]
);

// デザイン
Customizer::add(
	$section,
	'share_btn_style',
	[
		'classname'   => '',
		'label'       => __( 'Design', 'arkhe-toolkit' ),
		'type'        => 'select',
		'choices'     => [
			'block' => __( 'Block', 'arkhe-toolkit' ),
			'icon'  => __( 'Icon', 'arkhe-toolkit' ),
		],
	]
);


// Twitter用の追加設定
Customizer::big_title(
	$section,
	'sns_share_add_setting',
	[
		'label' => __( 'Additional settings for Twitter', 'arkhe-toolkit' ),
	]
);

// シェアされた時のハッシュタグ
// 「#」は含まず、複数の時は「,」区切りで入力してください。
Customizer::add(
	$section,
	'share_hashtags',
	[
		'classname'   => '',
		'label'       => __( 'Hashtag when shared', 'arkhe-toolkit' ),
		'description' => __( 'Please do not include "#" and enter "," separated when multiple.', 'arkhe-toolkit' ),
		'type'        => 'text',
	]
);

// via設定（メンション先）
// 「@」を除いたTwitter IDを入力してください。
Customizer::add(
	$section,
	'share_via',
	[
		'classname'   => '',
		'label'       => __( 'via setting (mention destination)', 'arkhe-toolkit' ),
		'description' => __( 'Please enter your Twitter ID without the "@".', 'arkhe-toolkit' ),
		'type'        => 'text',
	]
);
