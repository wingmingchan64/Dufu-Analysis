<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\生成詩頁.php 
*/
$path = "H:\\github\\DuFu\\杜甫全集\詩\\";

require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼 );

foreach( $頁碼 as $頁 )
{
	$file = $path . $頁 . ".txt";
	
	if( !file_exists( $file ) )
	{
		//echo $file . NL;
		file_put_contents(
			$file, '' );
	}
	
}
?>