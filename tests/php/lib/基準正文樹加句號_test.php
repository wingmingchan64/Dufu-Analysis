<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\基準正文樹加句號_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;

設定測試檔( basename( __FILE__ ) );
$debug = true;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );
/*
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
$store = array();
基準正文樹加句號( $樹, $store, true );
print_r( $store );
echo implode( $store );
*/

$i = 1;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
$store = array();
基準正文樹加句號( $樹, $store, true );
確認爲眞( sizeof( $store ) > 1, "case#: ${i}" );
$i++;
確認相等( implode( $store ),
"岱宗夫如何。
齊魯青未了。
造化鍾神秀。
陰陽割昏曉。
盪胸生曾雲。
決眥入歸鳥。
會當凌絕頂。
一覽眾山小。
", "case#: ${i}" );
?>