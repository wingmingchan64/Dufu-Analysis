<?php
/*
 * 把文字規範化，用的規範標準是異體字表。
 * 主要用於規範 user input。
 */
use Dufu\Exceptions\JsonFileNotFoundException;

function 修復文字(
	string $str,
	bool $debug=false,
	array $異 = null ) : string
{
	if( !is_null( $異 ) )
	{
		// use 異體字表 passed in
		$異體字 = $異;
	}
	else
	{
		// 提取異體字表
		$異體字 = 提取數據結構( 異體字 );
	}
	
	$len = mb_strlen( $str );
	$temp = '';
	$ytz = array_keys( $異體字 );
	
	debug_echo( __FILE__, __LINE__, $len, $debug );
	
	// 逐字檢查，以規範字取代非規範字
	foreach( range( 0, $len - 1 ) as $pos )
	{
		$字 = mb_substr( $str, $pos, 1 );
		
		if( in_array( $字, $ytz ) )
		{
			$temp .= $異體字[ $字 ];
		}
		else
		{
			$temp .= $字;
		}
	}
	return $temp;
}

function fix_text(
	string $str,
	bool $debug=false,
	array $異 = null ) : string
{
	return 修復文字( $str, $debug, $異 );
}

function 去除異體字(
	string $str,
	bool $debug=false,
	array $異 = null ) : string
{
	return 修復文字( $str, $debug, $異 );
}

function remove_variants( 
	string $str,
	bool $debug=false,
	array $異 = null ) : string
{
	return 修復文字( $str, $debug, $異 );
}
?>