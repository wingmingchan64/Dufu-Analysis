<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\含首碼_test.php
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
確認爲眞( 含首碼( '〚0013:1:5.1.2〛' ), "case#: ${i}" );
$i++;
確認爲眞( !含首碼( '〚0003:5.1.2〛' ), "case#: ${i}" );
$i++;
確認會丟( function(){ 
	確認爲眞( contain_member_poem_id( '〚0003:5.1.2〛' ) );
	}, 
	ConfirmationFailureException::class, "case#: ${i}" );
?>