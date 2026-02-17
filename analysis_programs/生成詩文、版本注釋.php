<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成詩文、版本注釋.php 今
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼 );

check_argv( $argv, 2, 提供簡稱 );

$output = '';
$stop_page = 280;

$簡稱 = trim( $argv[ 1 ] );
if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無簡稱, NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];

foreach( $頁碼 as $頁 )
{
	if( intval( $頁 ) > $stop_page )
	{
		break;
	}

	// 提取資料
	$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
	$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
	
	if(! file_exists( $版本路徑 ) )
	{
		continue;
	}
	
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
			$詩題 = $詩題 . "[1]" . NL;
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
	$output .= $詩題 . $詩文;
	// 注釋
	$output .=  NL . NL . 【注釋】 . NL;
	foreach( array_values( $注s ) as $注 )
	{
		$output .= $注 . NL;
	}
	$output .= NL;
}




//file_put_contents( 杜甫詩全譯 . '韓成武、張志民《杜甫詩全譯》詩文、譯文.txt', $output );
file_put_contents( "H:\\github\\Dufu-Analysis\\張志烈主編《杜詩全集（今注本）》\\張志烈主編《杜詩全集（今注本）》詩文、注釋.txt", $output );
?>