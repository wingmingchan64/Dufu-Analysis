<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩文用字→默文檔碼.php 反覆
=>
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩文 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );
$result = array();
$temp = array();

$字數 = mb_strlen( $詩文 );
$文_碼 = 提取數據結構( 數字對照陣列[ $字數 ] );

if( array_key_exists( $詩文, $文_碼 ) )
{
	$temp = $文_碼[ $詩文 ];
}

if( count( $temp ) == 0 )
{
	echo "杜詩中沒有「${詩文}」。", NL;
	return;
}

$完整坐標_路徑陣列 = 提取數據結構( 完整坐標_路徑陣列 );
$路徑_句 = 提取數據結構( 路徑_句 );

foreach( $temp as $坐標 )
{
	$默文檔碼 = 提取文檔碼( $坐標 );
	
	if( !array_key_exists( $默文檔碼, $result ) )
	{
		$result[ $默文檔碼 ] = array();
	}
	
	$坐標 = preg_replace( '/\.\d+-\d+/u', '', $坐標 );
	$路徑 = implode( ',', 
		$完整坐標_路徑陣列[ $默文檔碼 ][ $坐標 ] );
	$result[ $默文檔碼 ][] = $路徑_句[ $路徑 ];
}

print_r( $result );
?>