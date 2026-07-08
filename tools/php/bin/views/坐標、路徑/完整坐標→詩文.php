<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\坐標、路徑\完整坐標→詩文.php 〚0003:〛

=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供完整坐標 );
$坐標 = trim( $argv[ 1 ] );

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