<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\提取詩陣列詩文_test.php
*/
設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$i = 1;
確認相等( 提取詩陣列詩文( 提取詩陣列( '〚0003:〛' ) ), 
	array ( '望嶽', '岱宗夫如何。齊魯青未了。
造化鍾神秀。陰陽割昏曉。
盪胸生曾雲。決眥入歸鳥。
會當凌絕頂。一覽眾山小。
' ), "case#: ${i}" );
$i++;
?>