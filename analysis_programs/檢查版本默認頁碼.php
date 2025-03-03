<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\檢查版本默認頁碼.php

檢查以下事項：
1. 目錄内默認頁碼是否正確
2. 格式是否正確
*/
require_once( '函式.php' );
require_once( 頁碼 );
require_once( 書目簡稱 );

$簡稱 = '訳';
$簡稱 = '仇';
$簡稱 = '謝';
$簡稱 = '朱';
$簡稱 = '趙';
$簡稱 = '趙';
$簡稱 = '黃';
$簡稱 = '錢';
$簡稱 = '楊';
$簡稱 = '郭';


$路徑 = 杜甫分析文件夾 . $書目簡稱[ '=' . $簡稱 ] . "\\${簡稱}目錄.txt";
$file = file_get_contents( $路徑 );
$lines = explode( NL, $file );
$counter = 0;

foreach( $lines as $line )
{
	$counter++;
	if( mb_strpos( $line, '==' ) !== false )
	{
		exit;
	}
	elseif( $line == '' || strpos( $line, '//' ) === false )
	{
		continue;
	}

	$parts = explode( ' ', $line );
	
	try
	{
		$默認頁碼 = trim( $parts[ 2 ] );
		
		if( in_array( $默認頁碼, $頁碼 ) || $默認頁碼 == '6497' )
		{
			continue;
		}
		else
		{
			echo $counter, ' ', $默認頁碼, NL;
			exit;
		}
	}
	catch( ErrorException $e )
	{
		echo $counter, NL;
		echo $e;
	}
}
echo "Done", NL;
?>