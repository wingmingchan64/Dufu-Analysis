<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\sid函式_test.php
*/
use Dufu\Exceptions\PoemIDNotFoundException;
use Dufu\Exceptions\ConfirmationFailureException;
$debug = true;
設定測試檔( basename( __FILE__ ) );

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );


/*
Array
(
    [sid] => 郭0001:P0004L01:2c334438edf7
    [sid_method] => A
)
*/
//print_r( make_sid( '郭0001', '注', '條目正文', 'P0004L01' ) );

/*Array
(
    [sid] => 郭0001:0062:1:5-6:5cd2cbbc534e
    [sid_method] => B
)
*/
//print_r( make_sid( '郭0001', '注', '條目正文', '', '0062:1:5-6' ) );

/*
Array
(
    [sid] => 郭0001:2c334438edf75748
    [sid_method] => C
)
*/
//print_r( make_sid( '郭0001', '注', '條目正文' ) );


$i = 1;
確認爲眞( make_sid( '郭0001', '注', '條目正文', 'P0004L01' )[ 'sid_method' ] == 'A', "case#: ${i}" );
$i++;
確認相等( make_sid( '郭0001', '注', '條目正文', 'P0004L01' )[ 'sid' ], '郭0001:P0004L01:2c334438edf7', "case#: ${i}" );
$i++;
//確認會丟( function(){ 提取基準正文樹( "0002" ); }, PoemIDNotFoundException::class, "case#: ${i}" );

?>