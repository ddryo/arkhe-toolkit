<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$db = 'extension';

?>
<h3 class="pcpp-setting__h3">てすとお</h3>
<?php
	\Arkhe_Toolkit::output_text_field([
		'db'    => $db,
		'key'   => 'amazon_access_key',
		'label' => 'アクセスキー',
	]);

	\Arkhe_Toolkit::output_text_field([
		'db'    => $db,
		'key'   => 'amazon_secret_key',
		'label' => 'シークレットキー',
	]);
?>
