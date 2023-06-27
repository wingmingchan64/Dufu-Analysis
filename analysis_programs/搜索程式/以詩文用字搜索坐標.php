<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字搜索坐標.php 遁
=>
Array
(
    [0] => 〚0030:6.2.4〛
    [1] => 〚0797:4:38.2.2〛
    [2] => 〚1821:11.2.4〛
    [3] => 〚2621:8.2.6〛
    [4] => 〚3207:15.2.7〛
    [5] => 〚3502:3.1.6〛
    [6] => 〚5948:24.2.4〛
)*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

checkARGV( $argv, 2, 提供詩文 );
$字  = trim( $argv[ 1 ] );
$字數 = mb_strlen( $字 );
$result = array();

if( $字數 == 1 )
{
	require_once( 用字_頁碼 );
	$頁碼s = $用字_頁碼[ $字 ];
	
	foreach( $頁碼s as $頁碼 )
	{
		require_once( 詩集文件夾 . "${頁碼}坐標_用字.php" );
		
		foreach( $坐標_用字 as $坐標 => $用字 )
		{
			if( $用字 == $字 )
			{
				array_push( $result, $坐標 );
			}
		}
	}
	if( sizeof( $result ) == 0 )
	{
		array_push( $result, 無結果 );
	}
}
elseif( $字數 > 1 && $字數 < 5 )
{
	$數字s = array( '', '', '二', '三', '四' );
	$數字 = $數字s[ $字數 ];
	require_once( 杜甫資料庫 . "${數字}字組合_坐標.php" );
	$列陣名 = "${數字}字組合_坐標";
	
	if( array_key_exists( $字, $$列陣名 ) )
	{
		$result = $$列陣名[ $字 ];
	}
	else
	{
		array_push( $result, 無結果 );
	}
}
elseif( $字數 >= 5 )
{
	require_once( 杜甫資料庫 . "詩句_坐標.php" );
	
	foreach( $詩句_坐標 as $詩句 => $坐標 )
	{
		if( mb_strlen( $詩句 ) < $字數 )
		{
			continue;
		}
		elseif( $詩句 == $字 || mb_strpos( $詩句, $字 ) !== false )
		{
			if( is_string( $坐標 ) )
			{
				array_push( $result, $坐標 );
			}
			elseif( is_array( $坐標 ) )
			{
				$result = array_merge( $result, $坐標 );
			}
		}
	}
	if( sizeof( $result ) == 0 )
	{
		array_push( $result, 無結果 );
	}
}
print_r( $result );
?>