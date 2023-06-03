<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜詩粵音注音.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
require_once( 杜甫資料庫 . '統一碼字_粵音.php' );

$contents = "
本文檔以 PHP 生成。
php h:\github\Dufu-Analysis\analysis_programs\生成杜詩粵音注音.php
";

foreach( $頁碼 as $頁 )
{
	require_once( 詩集文件夾 . "${頁}.php" );
	$行s = $内容[ 行碼 ];
	
	$contents = $contents . "\n\n" . $頁 . ' ';
	
	foreach( $行s as $行 => $詩文 )
	{
		$詩文 = str_replace( "﻿", "", $詩文 );// invisible char
		
		// remove last 。
		if( str_ends_with( $詩文, "。" ) )
		{
			$詩文 = mb_substr( $詩文, 0, mb_strlen( $詩文 ) - 1 );
		}
		
		// remove page number
		$詩文 = trim( $詩文, '1234567890' ) . "\n"; 
		$詩文 = trim( $詩文 );
		$contents = $contents . $詩文 . "\n";
	
		for( $i = 0; $i < mb_strlen( $詩文 ); $i++ )
		{
			$字 = mb_substr( $詩文, $i, 1 );
		
			if( $字 == '' ) // empty
			{
				continue;
			}
		
			if( $字 == '。' || $字 == '，' )
			{
				$contents = trim( $contents ) . ', ';
				continue;
			}
			// 生成注音
			if( array_key_exists( $字, $統一碼字_粵音 ) )
			{
				$字音s = $統一碼字_粵音[ $字 ];
				// take the first three
				if( sizeof( $字音s ) > 3 )
				{
					$字音s = array_slice( $字音s, 0, 3 );
				}
			}
			else
			{
				$字音s = array( "unknown" );
			}
			
			// 只一個讀音
			if( sizeof( $字音s ) == 1 ) 
			{
				$contents = $contents . $字音s[ 0 ] . ' ';
			}
			// 多音字
			else
			{
				$contents = $contents . implode( '/', $字音s ) . ' ';
			}
		}
		$contents = $contents . "\n";
	}
}

$contents = str_replace( '。', '，', $contents );

$outfile = "h:\\杜甫資料庫\\杜甫全集粵音注音.txt";
file_put_contents( $outfile, $contents );
$outfile = "h:\\github\Dufu-Analysis\\陳永明《杜甫全集粵音注音》\\杜甫全集粵音注音.txt";
file_put_contents( $outfile, $contents );

//echo $contents, "\n";
?>