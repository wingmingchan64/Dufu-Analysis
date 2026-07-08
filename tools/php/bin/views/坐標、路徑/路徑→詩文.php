<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\坐標、路徑\路徑→詩文.php 0013,1

=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供路徑 );
$路徑 = trim( $argv[ 1 ] );

if( mb_strpos( $路徑, ',' ) !== false )
{
	$坐標 = 陣列路徑轉換成完整坐標( explode( ',', $路徑 ) );
}
else
{
	$坐標 = 陣列路徑轉換成完整坐標( array( $路徑 ) );
}
if( 是合法完整坐標( $坐標 ) )
{
	$result = 提取坐標文字內容( $坐標 );
	echo $result, NL;
}
else
{
	echo 無結果, NL;
}
?>