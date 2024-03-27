<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→詩文.php 0003
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼_詩題 );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );
if( !array_key_exists( $頁碼, $頁碼_詩題 ) )
{
	echo 無頁碼, NL;
}
$result = 提取詩文陣列( $頁碼 );

$默認路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
require_once( $默認路徑 );
// output poem
echo NL;
foreach( $result as $行碼 => $詩文 )
{
	echo $詩文, NL;
}
?>