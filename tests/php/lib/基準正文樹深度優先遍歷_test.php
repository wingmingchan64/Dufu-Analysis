<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\基準正文樹深度優先遍歷_test.php
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

$tree = json_decode( file_get_contents( 'H:\github\Dufu-Analysis\schemas\json\base_text\0003.json' ), true );
$根 = array_keys( $tree )[ 0 ];

if( array_key_exists( 詩題, $tree[ $根 ] ) )
{
	$題 = $tree[ $根 ][ 詩題 ];
	unset( $tree[ $根 ][ 詩題 ] );
}

$store = array();
基準正文樹深度優先遍歷( $tree, $store );

$i = 1;
確認相等( $題, "望嶽", "case#: ${i}" );
$i++;
確認相等( implode( $store ), "岱宗夫如何齊魯青未了造化鍾神秀陰陽割昏曉盪胸生曾雲決眥入歸鳥會當凌絕頂一覽眾山小", "case#: ${i}" );
?>