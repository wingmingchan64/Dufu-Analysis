<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索目錄\默認版本詩碼→版本詩碼對照.php 3
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供默詩碼 );

$默詩碼 = 修復文檔碼( trim( $argv[ 1 ] ) );
echo $默詩碼, NL;



$默詩碼_版本詩碼 = 提取目錄( 默詩碼_版本詩碼對照表 );

print_r( $默詩碼_版本詩碼[ $默詩碼 ] );



//print_r( $result );
?>