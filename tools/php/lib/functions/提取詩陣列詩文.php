<?php
/*
 * $詩陣列：基準正文樹
 * 提取基準正文樹中的文字。
 */

function 提取詩陣列詩文(
	array $詩陣列,
	bool $加句號 = true,
	bool $加新行 = true,
	bool $忽略副題 = true,// only affects 組詩
	bool $debug = false
) : array
{
	//debug_echo( __FILE__, __LINE__, "提取詩陣列詩文", $debug );
	//debug_print_r( __FILE__, __LINE__, $詩陣列, $debug );

	$store = array();
	$路徑 = array();
	$根 = array_keys( $詩陣列 )[ 0 ];
	$是組詩 = false;
	
	if( mb_strlen( $根 ) > 4 )
	{
		$是組詩 = true;
	}
	else
	{
		$文檔碼 = $根;
	}
	
	if( !$是組詩 )
	{
		$陣列 = array( $詩陣列[ $文檔碼 ] );
	}
	else
	{
		$陣列 = array();
		$簡稱 = mb_substr( $根, 0, 1 );
		$版文檔碼 = mb_substr( $根, 1 );
		$書目簡稱 = 提取數據結構( 書目簡稱 );
		// 版本名字
		$書名 = $書目簡稱[ $簡稱 ]; // 
		$版文檔碼_詩碼s = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_${簡稱}詩碼" );
		$版詩碼_默詩碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}詩碼_默詩碼" );
		
		$版詩碼s = $版文檔碼_詩碼s[ $版文檔碼 ];
		
		foreach( $版詩碼s as $版詩碼 )
		{
			$parts = explode( '-', $版詩碼_默詩碼[ $版詩碼 ] );
			array_push( $陣列, $詩陣列[ $根 ][ $parts[ 0 ] ][ $parts[ 1 ] ] );
		}
	}
	
	if( array_key_exists( 詩題, $詩陣列[ $根 ] ) )
	{
		array_push( $store, $詩陣列[ $根 ][ 詩題 ] );
	}
	
	if( array_key_exists( 序言, $詩陣列[ $根 ] ) )
	{
		array_push( $store, $詩陣列[ $根 ][ 序言 ] );
	}

	foreach( $陣列 as $詩 )
	{
		array_push( $store, 
			杜甫詩陣列首ToString( $詩, $加句號, $加新行 ) );
	}

	return $store;
}
?>