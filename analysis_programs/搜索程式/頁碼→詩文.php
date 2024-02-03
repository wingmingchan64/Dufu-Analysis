<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→詩文.php 0003
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );
$路徑 = 詩集文件夾 . $頁碼 . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	foreach( $内容[ 行碼 ] as $碼 => $文 )
	{
		echo $文, NL;
	}
}
else
{
	echo 無結果, NL;
}
?>