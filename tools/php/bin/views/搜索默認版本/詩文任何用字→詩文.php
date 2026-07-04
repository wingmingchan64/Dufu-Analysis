<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩文任何用字→詩文.php 酒病長江
=>
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩文 );
$文 = fix_text( trim( $argv[ 1 ] ) );
$一字組合_坐標 = 提取數據結構( 一字組合_坐標 );
$chars = mb_str_split( $文 );
$temp = array();

foreach( $chars as $char )
{
	$temp[ $char ] = array();
}

foreach( $chars as $char )
{
	if( !array_key_exists( $char, $一字組合_坐標 ) )
	{
		echo "杜詩中無「${char}」字。", NL;
		return;
	}
	
	$坐標s = $一字組合_坐標[ $char ];
	
	foreach( $坐標s as $坐標 )
	{
		$默文檔碼 = 提取文檔碼( $坐標 );
		
		if( 是組詩( $默文檔碼 ) )
		{
			$默文檔碼 = $默文檔碼 . '-' . 提取詩碼( $坐標 );
		}
		
		if( !in_array( $默文檔碼, $temp[ $char ] ) )
		{
			$temp[ $char ][] = $默文檔碼;
		}
	}
}

$result = $temp[ $chars[ 0 ] ];

foreach( $chars as $char )
{
	$result = array_intersect( $result, $temp[ $char ] );
}

$result = array_unique( $result );

if( sizeof( $result ) == 0 )
{
	echo 無結果, NL;
	return;
}
else
{
	foreach( $result as $默文檔碼 )
	{
		if( strlen( $默文檔碼 ) > 4 )
		{
			$默文檔碼 = substr( $默文檔碼, 0, 4 );
		}
		$詩文文檔路徑 = dirname( __dir__, 6 ) .
			DIRECTORY_SEPARATOR .
			默認版本詩文件夾 . $默文檔碼 . '.txt';
		echo file_get_contents( $詩文文檔路徑 ), NL;
	}
}
?>