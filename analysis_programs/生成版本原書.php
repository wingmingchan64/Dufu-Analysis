<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成版本原書.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 書目簡稱 );
require_once( 搜索程式文件夾 . '以頁碼版本簡稱顯示版本原文.php' );

//checkARGV( $argv, 3, 提供頁、簡 );
//$簡稱 = trim( $argv[ 1 ] );

$簡稱 = '郭';

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}

$書名 = $書目簡稱[ 等號 . $簡稱 ];
$列陣名 = "${簡稱}内容";
$文件夾路徑 = 杜甫資料庫 . $書名 . "\\";
$template = $文件夾路徑 . 'template.php';
$版本内容 = '';
$版本目錄 = '';
$版本詩文注釋 = '';
$版本目錄_頁碼_詩題 = array();


if( file_exists( $template ) )
{
	require_once( $template );
	//print_r( $template );
	foreach( $template as $line )
	{
		// txt files
		if( strpos( $line, '.txt' ) !== false ) // to be included
		{
			if( file_exists( $文件夾路徑 . $line ) )
			{
				if( mb_strpos( $line, '目錄' ) !== false )
				{
					$版本目錄 .= file_get_contents( $文件夾路徑 . $line );
				}
				else
				{
					$版本内容 .= file_get_contents( $文件夾路徑 . $line );
				}
			}
		}
		// page number
		elseif( preg_match( '|\d{4}|', $line ) )
		{
			require_once( 詩集文件夾 . $line . 程式後綴 );
			require_once( $文件夾路徑 . $line . 程式後綴 );
			
			if( array_key_exists( 詩題, $$列陣名 ) )
			{
				//$版本目錄 .= $$列陣名[ 詩題 ] . NL;
				$版本目錄_頁碼_詩題[ $line ] = $$列陣名[ 詩題 ];
			}
			else
			{
				//$版本目錄 .= $内容[ 詩題 ] . NL;
				$版本目錄_頁碼_詩題[ $line ] = $内容[ 詩題 ];
			}

			$版本詩文注釋 .= 
				以頁碼版本簡稱顯示版本原文( $line, $内容, $$列陣名 );
		}
		// plain text
		else
		{
			//$版本内容 .= $line . NL;
			//$版本目錄 .= $line . NL;
		}
	}
	
	foreach( $版本目錄_頁碼_詩題 as $頁碼 => $詩題 )
	{
		$版本目錄 = str_replace( $頁碼, $詩題, $版本目錄 );
	}
	
	//echo $版本目錄;
	
	$版本内容 .= $版本目錄 . NL . $版本詩文注釋;
	
	file_put_contents( $文件夾路徑 . $書名 . '.txt', $版本内容 );
	file_put_contents( 杜甫分析文件夾 . $書名 . "\\" . $書名 . '.txt', $版本内容 );
}
?>
