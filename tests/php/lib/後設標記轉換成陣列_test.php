<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\後設標記轉換成陣列_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\AbbreviationNotFoundException;

設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

/*
print_r( 後設標記轉換成陣列( 
	'全', '0001', 'P0004L01', '{"cat":"異","a":"沒"}','沒[一作波]' ) );
*/
$i = 1;
確認相等( 後設標記轉換成陣列( 
	'全', '0001', 'P0004L01', '{"cat":"異","a":"沒"}','沒[一作波]' ),
	array(
		'cat'=>'異',
		'a'=>'〚0276:24.1.3〛',
		'sid'=>array(
			'sid'=>'全0001:P0004L01:f8de483e7de8',
			'sid_method'=>'A' ),
		't'=>'沒[一作波]',
	), "case#: ${i}" );
?>