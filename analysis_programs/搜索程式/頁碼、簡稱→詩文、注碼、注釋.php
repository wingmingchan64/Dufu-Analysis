<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→詩文、注碼、注釋.php 0003 仇
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
require_once( 頁碼 );
require_once( 頁碼_詩題 );

// 參數
check_argv( $argv, 3, 提供頁、簡 );
$result = array();
$頁 = fix_doc_id( trim( $argv[ 1 ] ) );
if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}
$簡稱 = fix_text( trim( $argv[ 2 ] ) );
if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無簡稱, NL;
	exit;
}
// 提取資料
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
$陣列名 = "${簡稱}内容"; // e.g. 仇内容
require_once( $默認路徑 );
require_once( $版本路徑 );

$詩題 = $内容[ 詩題 ];
$詩行 = array_values( $内容[ 行碼 ] );
unset( $詩行[ 0 ] );
$詩文 = str_replace( $頁, '', implode( "\n", $詩行 ) );
$注釋s = $$陣列名[ 注釋 ];
$注s = array();
$count = 1;

// format output
foreach( $$陣列名[ 注釋 ] as $坐 => $注 )
{
	// 題注
	if( $坐 == "〚${頁}:1〛" )
	{
		$詩文 = str_replace( $詩題, '', $詩文 );
		$詩題 = $詩題 . "[1]";
		// 注前加注碼
		$注s[ $count ] = "[$count]" . $注;
		$count = 2;
		continue;
	}
	
	$注s[ $count ] = "[$count]" . $注;
	$note = explode( "：", $注 );
	$term = $note[ 0 ];
	// 詩文中加注碼
	$詩文 = str_replace( $term, $term . "[${count}]", $詩文 );
	$count++;
	
}
// 詩文
print_r( $詩題 . $詩文 );
// 注釋
echo NL, NL, 【注釋】, NL;
foreach( array_values( $注s ) as $注 )
{
	echo $注, "\n";
}
?>