<?php
defined( 'ABSPATH' ) || exit;

/**
 * ターム「新規追加」画面にフィールド追加
 */
function arcke_hook__add_term_fields() {
 ?>
	<div class="form-field">
		<label>リストレイアウト</label>
		<select name="swell_term_meta_list_type" id="swell_term_meta_list_type">
			<option value="">-- ベース設定に従う --</option>
			<?php
				$options = [
					'card'   => 'カード型',
					'list'   => 'リスト型',
					// 'big' => 'ブログ型',
					'simple' => 'テキスト型',
				];
				foreach ( $options as $key => $label ) {
					$selected = ( $term_list_type === $key ) ? ' selected' : '';
					echo '<option value="' . $key . '"' . $selected . '>' . $label . '</option>';
				}
			?>
		</select>
	</div>
	<div class="form-field">
		<label>アイキャッチ画像</label>
		<input type="hidden" id="src_swell_term_meta_image" name="swell_term_meta_image" value="" />
		<div id="preview_swell_term_meta_image" class="media_preview"></div>
		<div class="media_btns">
			<input class="button" type="button" name="media-upload-btn" data-id="swell_term_meta_image" value="画像を選択" />
			<input class="button" type="button" name="media-clear" value="画像を削除" data-id="swell_term_meta_image" />
		</div>
	</div>
<?php
}

// フック
add_action( 'category_add_form_fields', 'arcke_hook__add_term_fields' );
add_action( 'post_tag_add_form_fields', 'arcke_hook__add_term_fields' );


/*
 * ターム「編集」画面にフィールド追加
 */
function arkhe_hook__add_term_edit_fields( $term ) {
	$term_list_type = get_term_meta( $term->term_id, 'swell_term_meta_list_type', 1 );
	$term_ttl       = get_term_meta( $term->term_id, 'swell_term_meta_ttl', 1 );
	$term_subttl    = get_term_meta( $term->term_id, 'swell_term_meta_subttl', 1 );
	$term_ttlpos    = get_term_meta( $term->term_id, 'swell_term_meta_ttlpos', 1 );
	$term_image     = get_term_meta( $term->term_id, 'swell_term_meta_image', 1 );
	$term_ttlbg     = get_term_meta( $term->term_id, 'swell_term_meta_ttlbg', 1 );
	$is_show_thumb  = get_term_meta( $term->term_id, 'swell_term_meta_show_thumb', 1 );
	$is_show_desc   = get_term_meta( $term->term_id, 'swell_term_meta_show_desc', 1 );
	$is_show_rank   = get_term_meta( $term->term_id, 'swell_term_meta_show_rank', 1 );
	$term_newttl    = get_term_meta( $term->term_id, 'swell_term_meta_newttl', 1 );
	$term_rankttl   = get_term_meta( $term->term_id, 'swell_term_meta_rankttl', 1 );
	$display_parts  = get_term_meta( $term->term_id, 'swell_term_meta_display_parts', 1 );
	$is_show_list   = get_term_meta( $term->term_id, 'swell_term_meta_show_list', 1 );
?>
	<tr class="swell_term_meta_title">
		<td colspan="2">
			<h2>Arkhe設定</h2>
		</td>
	</tr>
	<tr class="form-field">
		<th>
			リストレイアウト
		</th>
		<td>
			<select name="swell_term_meta_list_type" id="swell_term_meta_list_type">
				<option value="">-- ベース設定に従う --</option>
				<?php
					$options = [
						'card'   => 'カード型',
						'list'   => 'リスト型',
						// 'big' => 'ブログ型',
						'simple' => 'テキスト型',
					];
					foreach ( $options as $key => $label ) {
						$selected = ( $term_list_type === $key ) ? ' selected' : '';
						echo '<option value="' . $key . '"' . $selected . '>' . $label . '</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr class="form-field">
		<th>
			新着順 / 人気順 でタブ分けするかどうか
		</th>
		<td>
			<select name="swell_term_meta_show_rank" id="swell_term_meta_show_rank">
				<option value="">-- ベース設定に従う --</option>
				<?php
					$options = [
						'1'    => '表示する', // '1' なのは過去の設定（チェックボックスだった頃）を引き継ぐため
						'none' => '表示しない',
					];
					foreach ( $options as $key => $label ) {
						$selected = ( $is_show_rank === (string) $key ) ? ' selected' : '';
						echo '<option value="' . $key . '"' . $selected . '>' . $label . '</option>';
					}
				?>
			</select>
		</td>
	</tr>
	<tr class="form-field">
		<th>
			ページに表示するタイトル
		</th>
		<td>
			<input type="text" name="swell_term_meta_ttl" id="swell_term_meta_ttl" size="40" value="<?=$term_ttl?>">
			<p class="description">
				空白の場合、ターム名がそのまま出力されます。
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th>
			ページに表示するサブタイトル
		</th>
		<td>
			<input type="text" name="swell_term_meta_subttl" id="swell_term_meta_subttl" size="40" value="<?=$term_subttl?>">
			<p class="description">
				空白の場合、「category」または「tag」が出力されます。
			</p>
		</td>
	</tr>
	<tr class="form-field">
		<th>
			タイトル表示位置
		</th>
		<td>
			<?php
			if ( $term_ttlpos === 'top' ) {
				$checked1 = '';
				$checked2 = ' checked';
			} else {
				$checked1 = ' checked';
				$checked2 = '';
			}
			?>
			<div class="swell_radio_wrap">
				<label for="swell_term_meta_ttlpos_inner">
					<input type="radio" name="swell_term_meta_ttlpos" id="swell_term_meta_ttlpos_inner" value="inner"<?=$checked1;?>>
					<span>コンテンツ内</span>
				</label>
				<br>
				<label for="swell_term_meta_ttlpos_top">
					<input type="radio" name="swell_term_meta_ttlpos" id="swell_term_meta_ttlpos_top" value="top"<?=$checked2;?>>
					<span>コンテンツ上</span>
				</label>
			</div>
		</td>
	</tr>

	<tr class="form-field">
		<th><label for="swell_term_meta_ttlbg">タイトル背景用画像</label></th>
		<td>
			<input type="hidden" id="src_swell_term_meta_ttlbg" name="swell_term_meta_ttlbg" value="<?php echo $term_ttlbg; ?>" />
			<div id="preview_swell_term_meta_ttlbg" class="media_preview">
				<?php if ( $term_ttlbg ) : ?>
					<img src="<?php echo $term_ttlbg; ?>" alt="preview" style="max-width:100%;max-height:300px;">
				<?php endif; ?>
			</div>
			<div class="media_btns">
				<input class="button" type="button" name="media-upload-btn" data-id="swell_term_meta_ttlbg" value="画像を選択" />
				<input class="button" type="button" name="media-clear" value="画像を削除" data-id="swell_term_meta_ttlbg" />
			</div>
		</td>
	</tr>
	<!-- 画像アップロード -->
	<tr class="form-field">
		<th><label for="swell_term_meta_image">アイキャッチ画像</label></th>
		<td>
			<input type="hidden" id="src_swell_term_meta_image" name="swell_term_meta_image" value="<?php echo $term_image; ?>" />
			<div id="preview_swell_term_meta_image" class="media_preview">
				<?php if ( $term_image ) : ?>
					<img src="<?php echo $term_image; ?>" alt="preview" style="max-width:100%;max-height:300px;">
				<?php endif; ?>
			</div>
			<div class="media_btns">
				<input class="button" type="button" name="media-upload-btn" data-id="swell_term_meta_image" value="画像を選択" />
				<input class="button" type="button" name="media-clear" value="画像を削除" data-id="swell_term_meta_image" />
			</div>
		</td>
	</tr>
	<tr class="form-field">
		<th>
			「アイキャッチ画像」をページに表示させるかどうか
		</th>
		<td>
			<?php $checked = ( $is_show_thumb === '1' ) ? ' checked' : ''; // 標準：オフ ?>
			<span>表示する</span>
			<label class="switch_checkbox" for="swell_term_meta_show_thumb">
				<input type="checkbox" name="" id="swell_term_meta_show_thumb"<?=$checked?>>
				<span class="slider round"></span>
			</label>
			<span>表示しない</span>
			<input type="hidden" name="swell_term_meta_show_thumb" value="<?=$is_show_thumb?>">
		</td>
	</tr>
	<tr class="form-field">
		<th>
			「説明」の内容をページに表示させるかどうか
		</th>
		<td>
			<?php
				$checked = ( $is_show_desc !== '0' ) ? ' checked' : ''; // 標準：オン
			 ?>
			<span>表示する</span>
			<label class="switch_checkbox" for="swell_term_meta_show_desc">
				<input type="checkbox" name="" id="swell_term_meta_show_desc"<?=$checked?>>
				<span class="slider round"></span>
			</label>
			<span>表示しない</span>
			<input type="hidden" name="swell_term_meta_show_desc" value="<?=$is_show_desc?>">
		</td>
	</tr>
	<tr class="form-field">
		<th>
			記事一覧リストを表示するかどうか
		</th>
		<td>
			<?php $checked = ( $is_show_list !== '0' ) ? ' checked' : ''; // 標準：オン ?>
			<span>表示する</span>
			<label class="switch_checkbox" for="swell_term_meta_show_list">
				<input type="checkbox" name="" id="swell_term_meta_show_list"<?=$checked?>>
				<span class="slider round"></span>
			</label>
			<span>表示しない</span>
			<input type="hidden" name="swell_term_meta_show_list" value="<?=$is_show_list?>">
		</td>
	</tr>
	<tr class="form-field">
		<th>
			ページで呼び出すブログパーツのID
		</th>
		<td>
			<input type="text" name="swell_term_meta_display_parts" id="swell_term_meta_display_parts" size="20" value="<?=$display_parts?>" style="width: 6em">
			<p class="description">※ 必ず半角で入力してください。</p>
		</td>
	</tr>
<?php
}
// フック
add_action( 'category_edit_form_fields', 'arkhe_hook__add_term_edit_fields' );
add_action( 'post_tag_edit_form_fields', 'arkhe_hook__add_term_edit_fields' );


// 保存処理
function arkhe_hook__save_term_filds( $term_id ) {

	// var_dump($_POST);
	// exit;

	$meta_array = [
		'swell_term_meta_list_type',
		'swell_term_meta_ttl',
		'swell_term_meta_subttl',
		'swell_term_meta_image',
		'swell_term_meta_ttlbg',
		'swell_term_meta_ttlpos',
		'swell_term_meta_show_thumb',
		'swell_term_meta_show_desc',
		'swell_term_meta_show_rank',
		'swell_term_meta_display_parts',
		'swell_term_meta_show_list',
	];
	foreach ( $meta_array as $metakey ) {
		if ( isset( $_POST[ $metakey ] ) ) {
			update_term_meta( $term_id, $metakey, $_POST[ $metakey ] );
		}
	}
}
add_action( 'created_term', 'arkhe_hook__save_term_filds' );  // 新規追加用フック
add_action( 'edited_terms', 'arkhe_hook__save_term_filds' );  // 編集ページ用フック
