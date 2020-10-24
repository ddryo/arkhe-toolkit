<?php
use \Arkhe_Theme\Customizer;
defined( 'ABSPATH' ) || exit;

// セクション : 記事下
$section = 'loos_section_after_article';
$wp_customize->add_section(
	$section,
	[
		'title'    => __( 'Under the article', 'arkhe-toolkit' ),
		'priority' => 10,
		'panel'    => 'loos_panel_single',
	]
);

// SNSアクションエリア設定
Customizer::big_title(
	$section,
	'sns_cta',
	[
		'label' => __( 'SNSアクションエリア設定', 'arkhe-toolkit' ),
	]
);

// 表示するボタン
Customizer::sub_title(
	$section,
	'sns_cta_check',
	[
		'label' => __( '表示するボタン', 'arkhe-toolkit' ),
	]
);

// Twitterフォローボタンを表示
Customizer::add(
	$section,
	'show_tw_follow_btn',
	[
		'classname'   => '',
		'label'       => __( 'Twitterフォローボタン', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// Facebookいいねボタン
Customizer::add(
	$section,
	'show_fb_like_box',
	[
		'classname'   => '',
		'label'       => __( 'Facebookいいねボタン', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// Twitterフォローボタンの対象ユーザー名
Customizer::add(
	$section,
	'tw_follow_id',
	[
		'classname'   => '-twitter-setting',
		'label'       => __( 'Twitterフォローボタンの対象ユーザー名', 'arkhe-toolkit' ),
		'description' => __( '@以降の文字列を指定してください。', 'arkhe-toolkit' ),
		'type'        => 'text',
		'sanitize'    => 'wp_filter_nohtml_kses',
	]
);

// Facebookいいねボタンの対象URL
Customizer::add(
	$section,
	'fb_like_url',
	[
		'classname'   => '-fb-setting',
		'label'       => __( 'Facebookいいねボタンの対象URL', 'arkhe-toolkit' ),
		'type'        => 'text',
		'sanitize'    => 'wp_filter_nohtml_kses',
	]
);

// Facebookいいねボタンに使用するappID
Customizer::add(
	$section,
	'fb_like_appID',
	[
		'classname'   => '-fb-setting',
		'label'       => __( 'Facebookいいねボタンに使用するappID', 'arkhe-toolkit' ),
		'type'        => 'text',
		'sanitize'    => 'wp_filter_nohtml_kses',
	]
);


// 前後記事へのページリンク設定
Customizer::big_title(
	$section,
	'pn_links',
	[
		'label' => __( '前後記事へのページリンク設定', 'arkhe-toolkit' ),
	]
);

// 前後記事へのページリンクを表示
Customizer::add(
	$section,
	'show_page_links',
	[
		'classname'   => '',
		'label'       => __( '前後記事へのページリンクを表示', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// 同じカテゴリーの記事を取得する
Customizer::add(
	$section,
	'pn_link_is_same_term',
	[
		'classname'   => '',
		'label'       => __( '同じカテゴリーの記事を取得する', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// 著者情報エリアの設定
Customizer::big_title(
	$section,
	'post_author',
	[
		'label' => __( '著者情報エリアの設定', 'arkhe-toolkit' ),
	]
);

// 著者情報を表示
Customizer::add(
	$section,
	'show_author_box',
	[
		'classname'   => '',
		'label'       => __( '著者情報を表示', 'arkhe-toolkit' ),
		__( 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);

// 関連記事エリアの設定
Customizer::big_title(
	$section,
	'related_posts',
	[
		'label' => __( '関連記事エリアの設定', 'arkhe-toolkit' ),
		__( 'arkhe-toolkit' ),
	]
);

// 関連記事を表示
Customizer::add(
	$section,
	'show_related_posts',
	[
		'classname'   => '',
		'label'       => __( '関連記事を表示', 'arkhe-toolkit' ),
		__( 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);



// 関連記事のレイアウト
Customizer::add(
	$section,
	'related_posts_layout',
	[
		'classname'   => '',
		'label'       => __( '関連記事のレイアウト', 'arkhe-toolkit' ),
		__( 'arkhe-toolkit' ),
		'type'        => 'select',
		'choices'     => [
			'card' => __( 'カード型', 'arkhe-toolkit' ),
			__( 'arkhe-toolkit' ),
			'list' => __( 'リスト型', 'arkhe-toolkit' ),
			__( 'arkhe-toolkit' ),
		],
	]
);

// 関連記事の取得方法
Customizer::add(
	$section,
	'post_relation_type',
	[
		'classname'   => '-radio-button -related-post',
		'label'       => __( '関連記事の取得方法', 'arkhe-toolkit' ),
		__( 'arkhe-toolkit' ),
		'description' => __( 'どの情報から関連記事を取得するかどうか', 'arkhe-toolkit' ),
		__( 'arkhe-toolkit' ),
		'type'        => 'radio',
		'choices'     => [
			'category' => __( 'カテゴリー', 'arkhe-toolkit' ),
			__( 'arkhe-toolkit' ),
			'tag'      => __( 'タグ', 'arkhe-toolkit' ),
			__( 'arkhe-toolkit' ),
		],
	]
);


// コメントエリアの設定
Customizer::big_title(
	$section,
	'comment_area',
	[
		'label' => __( 'コメントエリアの設定', 'arkhe-toolkit' ),
	]
);

// コメントエリアを表示
Customizer::add(
	$section,
	'show_comments',
	[
		'classname'   => '',
		'label'       => __( 'コメントエリアを表示', 'arkhe-toolkit' ),
		'type'        => 'checkbox',
	]
);
