<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→版本詩題.php 0824 名
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼 );
require_once( 頁碼_詩題 );
require_once( 書目簡稱 );

check_argv( $argv, 3, 提供頁、簡 );
$result = array();

$頁 = fix_doc_id( trim( $argv[ 1 ] ) );

if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}

$版本詩題 = $頁碼_詩題[ $頁 ];
$簡稱 = fix_text( trim( $argv[ 2 ] ) );

if( $簡稱!= '' && !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無簡稱, NL;
	exit;
}
// 提取資料
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$陣列名 = "${簡稱}内容";

if( file_exists( 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴 ) )
{
	require_once( 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴 );
}
else
{
	echo $書名, "中沒有《", $頁碼_詩題[$頁], "》一詩。\n";
	exit;
}
echo $書名, NL;

//print_r( $$陣列名 );

if( array_key_exists( 版本, $$陣列名 )
	&&
	is_array( $$陣列名[ 版本 ] ) &&
	array_key_exists( 詩題, $$陣列名[ 版本 ] )
)
{
	$temp詩題 = preg_replace( 夾注regex, '',  $$陣列名[ 版本 ][ 詩題 ] );
	
	if( $temp詩題 != $版本詩題 )
	{
		echo "默認詩題：", $版本詩題, NL;
		$版本詩題 = $temp詩題;
	}
}
echo "版本詩題：", $版本詩題, NL;
?>