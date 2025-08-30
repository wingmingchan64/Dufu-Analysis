<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩題用字→〖詩句〗.php 
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

require_once( 詩題_頁碼 );
//require_once( 頁碼_詩題 );

checkARGV( $argv, 2, 提供詩題 );

$題 = fixText( trim( $argv[ 1 ] ) );
$result = array();

foreach( $詩題_頁碼 as $詩題 => $頁碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		array_push( $result, $頁碼 );
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}
else
{
	$路徑 = 詩集文件夾 . $result[ 0 ] . 程式後綴;
	$output = $result[ 0 ] . NL;
	$output .= '〖1〗';

	require_once( $路徑 );
	$output .= $内容[ 詩題 ] . NL;
	
	foreach( $内容[ 詩句 ] as $句 )
	{
		$output .= "〖${句}〗" . NL;
	}
	
	echo $output;
}
?>