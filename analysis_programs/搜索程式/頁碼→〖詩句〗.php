<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→〖詩句〗.php 0668
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼_詩題 );

check_argv( $argv, 2, 提供頁碼 );
$頁碼 = fix_doc_id( trim( $argv[ 1 ] ) );
$路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
$output = '〖1〗';

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	$output .= $内容[ 詩題 ] . NL;
	foreach( $内容[ 詩句 ] as $句 )
	{
		$output .= "〖${句}〗" . NL;
	}
	
	echo $output;
}
else
{
	echo 無結果, NL;
}
?>