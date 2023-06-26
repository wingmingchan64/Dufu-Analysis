<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩句搜索頁碼.php 反覆
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "詩句_頁碼.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩句。", "\n";
	exit;
}

$句 = trim( $argv[ 1 ] );
$result = array();

foreach( $詩句_頁碼 as $詩句 => $頁碼 )
{
	if( mb_strpos( $詩句, $句 ) !== false )
	{
		$result[ $詩句 ] = $頁碼;
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, "沒有結果。" );
}
print_r( $result );
?>