<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\展示詩文版本差異.php
0003 蕭,仇
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

require_once( "h:\\github\\Dufu-Analysis\\書目簡稱.php" );

if( sizeof( $argv ) < 3 )
{
	echo "必須提供頁碼、兩個簡稱。", "\n";
	exit;
}
$頁碼 = trim( $argv[ 1 ] );
$簡稱s = trim( $argv[ 2 ] );
$簡稱s = explode( ',', $簡稱s );
if( sizeof( $簡稱s ) != 2 )
{
	echo "必須兩個簡稱。", "\n";
	exit;
}
$簡稱1 = $簡稱s[ 0 ];
$簡稱2 = $簡稱s[ 1 ];
$result = array();

if( array_key_exists( "=${簡稱1}", $書目簡稱 ) &&
	array_key_exists( "=${簡稱2}", $書目簡稱 ) &&
	file_exists( 杜甫資料庫 . $書目簡稱[ "=${簡稱1}" ] . "\\" . $頁碼 . ".php" ) &&
	file_exists( 杜甫資料庫 . $書目簡稱[ "=${簡稱2}" ] . "\\" . $頁碼 . ".php" ) )
{
	require_once( 杜甫資料庫 . $書目簡稱[ "=${簡稱1}" ] . "\\" . $頁碼 . ".php" );
	require_once( 杜甫資料庫 . $書目簡稱[ "=${簡稱2}" ] . "\\" . $頁碼 . ".php" );
	$陣列名1 = "${簡稱1}内容";
	$陣列名2 = "${簡稱2}内容";
	$詩文1 = $$陣列名1[ "版本" ][ "詩文" ];
	$詩文1 = preg_replace( "/\[\X+?]/", '', $詩文1 );
	$詩文2 = $$陣列名2[ "版本" ][ "詩文" ];
	$詩文2 = preg_replace( "/\[\X+?]/", '', $詩文2 );

	
	$result = compareText( $詩文1, $詩文2 );
	foreach( $result as $pos => $chars )
	{
		$詩文1 = str_replace( $chars[ 0 ], 
			'🔻' . $chars[ 0 ], $詩文1 );
		$詩文2 = str_replace( $chars[ 1 ],  
			'🔻' . $chars[ 1 ] , $詩文2 );
	}
	echo $書目簡稱[ "=${簡稱1}" ], "\n";
	echo $詩文1, "\n\n";
	echo $書目簡稱[ "=${簡稱2}" ], "\n";
	echo $詩文2, "\n";
}

//


?>
