<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩題任何用字→詩文.php 追酬蜀州日
=>
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩題 );
$題 = fix_text( trim( $argv[ 1 ] ) );
$詩題_默認詩文檔碼 = 提取數據結構( 詩題_默認詩文檔碼 );
$chars = mb_str_split( $題 );
$temp = array();

foreach( $chars as $char )
{
	$temp[ $char ] = array();
}


foreach( $詩題_默認詩文檔碼 as $詩題 => $默文檔碼 )
{
	foreach( $chars as $char )
	{
		if( mb_strpos( $詩題, $char ) !== false )
		{
			if( gettype( $默文檔碼 ) == "integer" )
			{
				$temp[ $char ][] = $默文檔碼;
			}
			elseif( is_array( $默文檔碼 ) )
			{
				$temp[ $char ] = array_merge(
					$temp[ $char ], $默文檔碼 );
			}
		}
	}
}

//print_r( $temp );

$result = $temp[ $chars[ 0 ] ];

foreach( $chars as $char )
{
	$result = array_intersect( $result, $temp[ $char ] );
}

if( sizeof( $result ) == 0 )
{
	echo 無結果, NL;
	return;
}
else
{
	foreach( $result as $默文檔碼 )
	{
		$詩文文檔路徑 = dirname( __dir__, 6 ) .
			DIRECTORY_SEPARATOR .
			默認版本詩文件夾 . $默文檔碼 . '.txt';
		echo file_get_contents( $詩文文檔路徑 ), NL;
	}
}

?>