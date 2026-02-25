<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\是默認文檔碼_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

確認爲眞( 是默認文檔碼( '0003' ),  'case#: 1'  );
確認爲眞( 是默認文檔碼( '13' ),  'case#: 2'  );
確認爲眞( !是默認文檔碼( '0004' ),  'case#: 3'  );
確認爲眞( !是默認文檔碼( '留' ),  'case#: 4'  );

array_push( $test_results, "是默認文檔碼_test: 4 cases tested." );
?>