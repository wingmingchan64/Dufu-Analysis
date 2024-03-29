<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成約注.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫詩陣列 );
require_once( 書目簡稱 );
require_once( 詩組_詩題 );

$簡稱 = '=今';
$部分 = 注釋;
$folder = $書目簡稱[ $簡稱 ];
$file = 杜甫資料庫 . $folder . "\\" . $folder . $部分 . 程式後綴;
$陣列名 = $folder . $部分;

//print_r( $杜甫詩陣列[ '3686' ] );
//print_r( $杜甫詩陣列[ '2516' ] );

if( file_exists( $file ) )
{
	require_once( $file );
	$陣列 = $$陣列名;
	require_once( 'h:\github\Dufu-Analysis\analysis_programs\約注\0068.php' );
	$result = 生成約注陣列( $杜甫詩陣列, $頁碼, $約注_陣列 );
	//print_r( $result );
	顯示杜甫詩陣列詩文( $詩組_詩題, $頁碼, $result );
}


function 提取坐標用字( $頁碼, $坐標 )
{
	require_once( '常數.php' );
	require_once( '函式.php' );
	require( 詩集文件夾 . $頁碼 . '坐標_用字' . 程式後綴 );
	$陣列名 = '坐標_用字';
	echo $坐標, NL;
	return $$陣列名[ $坐標 ];
}

function 提取内容( $坐標, $頁碼, $簡稱, $部分 )
{
	require_once( '常數.php' );
	require_once( '函式.php' );
	require( 書目簡稱 );
	require( 詩集文件夾 . $頁碼 . '坐標_用字' . 程式後綴 );

	$folder = $書目簡稱[ $簡稱 ];
	$file = 杜甫資料庫 . $folder . "\\" . $folder . $部分 . 程式後綴;
	require( $file );
	$陣列名 = $folder . $部分;
	$陣列 = $$陣列名;
	
	$完整内容坐標 = 生成完整坐標( $坐標, $頁碼 );
	$完整位置坐標 = preg_replace( '/\d-/', '', $完整内容坐標 );
	$陣列名 = '坐標_用字';
	
	return $$陣列名[ $完整位置坐標 ] . '【' . $陣列[ $完整内容坐標 ] . '】';
}

function 生成約注陣列( $杜詩陣列, $頁碼, $約注陣列 )
{
	require_once( '函式.php' );
	杜甫詩陣列詩文替代( $杜詩陣列[ $頁碼 ], $約注陣列 );
	return $杜詩陣列[ $頁碼 ];
}

?>