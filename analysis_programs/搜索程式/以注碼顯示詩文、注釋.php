<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以注碼顯示詩文、注釋.php 0003 仇
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以注碼顯示詩文、注釋.php 0003 今
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "書目簡稱.php" );
require_once( 杜甫資料庫 . "頁碼.php" );
require_once( 杜甫資料庫 . "頁碼_詩題.php" );

if( sizeof( $argv ) != 3 )
{
	echo "必須提供頁碼、版本簡稱。", "\n";
	exit;
}
$result = array();
$頁 = trim( $argv[ 1 ] );

if( !in_array( $頁, $頁碼 ) )
{
	echo "頁碼不存在。\n";
	exit;
}

$簡稱 = trim( $argv[ 2 ] );
$書名 = $書目簡稱[ '=' . $簡稱 ];
$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
$陣列名 = "${簡稱}内容";
require_once( $默認路徑 );
require_once( $版本路徑 );

$詩題 = $内容[ 詩題 ];
$詩文 = str_replace( $頁, '', implode( "\n", array_values( $内容[ 行碼 ] ) ) );
$注釋s = $$陣列名[ 注釋 ];
$注s = array();
$count = 1;

foreach( $$陣列名[ 注釋 ] as $坐 => $注 )
{
	if( $坐 == "〚${頁}:1〛" )
	{
		$詩文 = str_replace( $詩題, $詩題 . "[1]", $詩文 );
		$注s[ $count ] = "[$count]" . $注;
		$count = 2;
		continue;
	}
	$注s[ $count ] = "[$count]" . $注;
	$note = explode( "：", $注 );
	$term = $note[ 0 ];
	$詩文 = str_replace( $term, $term . "[${count}]", $詩文 );
	$count++;
	
}
print_r( $詩文 );
echo "\n\n【注釋】\n";
foreach( array_values( $注s ) as $注 )
{
	echo $注, "\n";
}
?>