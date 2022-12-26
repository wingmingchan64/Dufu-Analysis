<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\異體字報告.php

在 h:\\github\\DuFu\\杜甫全集.txt 中搜尋異體字。
異體字列表見 h:\\github\\Dufu-Analysis\\異體字.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 異體字 );

// 只在杜甫全集.txt 中搜尋異體字
$詩文 = file_get_contents( 杜甫全集 );
$字數 = mb_strlen( $詩文 );
$異體字陣列 = array();

for( $i = 0; $i < $字數; $i++ )
{
	$char = mb_substr( $詩文, $i, 1 );
	$keys = array_keys( $異體字 );
	
	if( in_array( $char, $keys ) &&
		!in_array( $char, $異體字陣列 ) )
	{
		array_push( $異體字陣列, $char );
	}
}
var_dump( $異體字陣列 );
?>