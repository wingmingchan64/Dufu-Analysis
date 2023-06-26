<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩題用字搜索詩題.php 岳
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "詩題_頁碼.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩題用字。", "\n";
	exit;
}
$題 = trim( $argv[ 1 ] );
$result = array();
$詩題s = array_keys( $詩題_頁碼 );

foreach( $詩題s as $詩題 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$result[ $詩題 ] = $詩題_頁碼[ $詩題 ];
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( "沒有結果。" );
}
print_r( $result );
?>