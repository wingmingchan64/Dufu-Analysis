<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、版本簡稱→版本頁碼.php 0013 今
=> 版本頁碼：題張氏隱居二首 張志烈主編《杜詩全集（今注本）》1.9,PDF75
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼 );
require_once( 書目簡稱 );

check_argv( $argv, 3, 提供頁、簡 );
$頁 = fix_doc_id( trim( $argv[ 1 ] ) );

if( !in_array( $頁, $頁碼 ) )
{
	echo 無結果 . NL;
	exit;
}

$簡稱 = trim( $argv[ 2 ] );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . "${書名}頁碼索引" . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	
	$列陣名 = "頁碼_${簡稱}頁碼";
	
	if( array_key_exists( $頁, $$列陣名 ) )
	{
		echo 版本頁碼, 冒號, $頁碼_詩題[ $頁 ], ' ', 
			$書名, $$列陣名[ $頁 ], "\n";
	}
	else
	{
		echo "此版本缺《${頁碼_詩題[ $頁 ]}》一詩。", NL;
	}
}
else
{
	echo 無結果 . NL;
}
?>