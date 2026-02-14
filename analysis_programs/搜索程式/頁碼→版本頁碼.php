<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→版本頁碼.php 0003

*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = fix_doc_id( trim( $argv[ 1 ] ) );

if( !array_key_exists( $頁碼, $頁碼_詩題 ) )
{
	echo 無頁碼, NL;
}

$result[ $頁碼 ]  = array();

foreach( $書目簡稱 as $簡稱 => $書目)
{
	$簡稱 = str_replace( '=', '', $簡稱 );
	$路徑 = 杜甫分析文件夾 . $書目簡稱[ '=' . $簡稱 ] . "\\頁碼_${簡稱}頁碼.php";
	
	if( file_exists( $路徑 ) )
	{
		require_once( $路徑 );
		$vname = "頁碼_${簡稱}頁碼";
		if( array_key_exists( $頁碼, $$vname ) )
		{
			$result[ $頁碼 ][ $簡稱 ] = $$vname[ $頁碼 ];
		}
	}
}
print_r( $result );
?>