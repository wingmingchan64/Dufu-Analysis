<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→楊注、王評.php 0003
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
require_once( 頁碼 );
require_once( 頁碼_詩題 );

// 參數
checkARGV( $argv, 2, 提供頁碼 );
$result = array();
$頁 = trim( $argv[ 1 ] );
if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}
$簡稱 = '楊';
// 提取資料
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
$陣列名 = "${簡稱}内容"; // e.g. 仇内容
require_once( $默認路徑 );
require_once( $版本路徑 );

$詩題 = $内容[ 詩題 ];
$詩文 = str_replace( $頁, '', implode( "\n", array_values( $内容[ 行碼 ] ) ) );
$注釋s = $$陣列名[ 注釋 ];
$注s = array();
$count = 1;

// format output
foreach( $$陣列名[ 注釋 ] as $坐 => $注 )
{
	// 題注
	if( $坐 == "〚${頁}:1〛" )
	{
		$詩文 = str_replace( $詩題, $詩題 . "[1]", $詩文 );
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
print_r( $詩文 );
// 注釋
echo NL, NL, '楊倫《杜詩鏡銓》', 【注釋】, NL;
foreach( array_values( $注s ) as $注 )
{
	echo $注, "\n";
}

$簡稱 = '奭';
// 提取資料
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
$陣列名 = "${簡稱}内容";
require_once( $版本路徑 );

echo NL, '王嗣奭《杜臆》', 【評論】, NL;
echo $$陣列名[ 評論 ], NL;

?>