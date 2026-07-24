<?php
/*
 * Script: 查閱詞典.php
php H:\github\Dufu-Analysis\tools\php\bin\views\詞典\查閱詞典.php
 * Author: Wing Ming Chan
 * Updated: 2026-07-23
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
	
$詞典文件夾 = dirname( __DIR__, 6 ) . DIRECTORY_SEPARATOR .
	'CanonicalTextTrees' . DIRECTORY_SEPARATOR .
	'corpus' . DIRECTORY_SEPARATOR .
	'dufu' . DIRECTORY_SEPARATOR .
	'詞典' . DIRECTORY_SEPARATOR .
	'entries' . DIRECTORY_SEPARATOR;

$條目 = '鄜州';
$條目文件 = "${條目}.json";
$條目_json = json_decode( file_get_contents( $詞典文件夾 . $條目文件 ) );

echo NL, $條目, NL;
foreach( $條目_json as $條目 )
{
	echo 提取ctt正文( $條目 ), NL;
}
?>