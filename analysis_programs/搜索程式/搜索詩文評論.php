<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\搜索詩文評論.php 0003 仇,浦
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\github\\Dufu-Analysis\\書目簡稱.php" );

if( sizeof( $argv ) < 3 )
{
	echo "必須提供頁碼、簡稱。", "\n";
	exit;
}
$頁碼 = trim( $argv[ 1 ] );
$簡稱s = trim( $argv[ 2 ] );
$簡稱s = explode( ',', $簡稱s );
$result = array();

foreach( $簡稱s as $簡稱 )
{
	if( array_key_exists( "=${簡稱}", $書目簡稱 ) &&
		file_exists( 杜甫資料庫 . $書目簡稱[ "=${簡稱}" ] . "\\" . $頁碼 . ".php" )
	)
	{
		require_once( 杜甫資料庫 . $書目簡稱[ "=${簡稱}" ] . "\\" . $頁碼 . ".php" );
		$陣列名 = "${簡稱}内容";
		$result[ $簡稱 ] = $$陣列名[ "評論" ];
	}
}
print_r( $result );
?>
