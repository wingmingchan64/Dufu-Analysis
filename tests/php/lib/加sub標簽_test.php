<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\加sub標簽_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;

設定測試檔( basename( __FILE__ ) );
$debug = false;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

//echo 加sub標簽( "遣興五首[黃鶴。]" );

$i = 1;
確認相等( 加sub標簽( "遣興五首[黃鶴。]" ),
	"遣興五首<sub>[黃鶴。]</sub>", "case#: ${i}" );
$i++;
	
?>