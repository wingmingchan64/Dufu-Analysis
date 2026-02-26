<?php

/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成默詩碼_版本詩碼.php
*/
$debug = true;

require_once( 
	dirname( __DIR__, 3) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
$tests_dir = dirname( __DIR__, 4 ) . DS . 'tests' . DS;  
require_once $tests_dir . 'php' . DS . 
	'lib' . DS . '_test_bootstrap.php';

// change this value
foreach( $簡稱陣列 as $簡稱 )
{
	debug_echo( __FILE__, __LINE__, $簡稱, $debug );

	$書目簡稱 = 提取數據結構( 書目簡稱 );
	$書名 = $書目簡稱[ $簡稱 ];
	$目錄名 = $書名 . DS . 'catalog'. DS . "${簡稱}目錄";
	$版本目錄 = 提取目錄( $目錄名 );

	$默文碼_版文碼名 = '默文檔碼_' . $簡稱 . '文檔碼';
	$版文碼_默文碼名 = $簡稱 . '文檔碼_' . '默文檔碼';
	$默文碼_版文碼 = array();
	$版文碼_默文碼 = array();

	$默詩碼_版詩碼名 = '默詩碼_' . $簡稱 . '詩碼';
	$版詩碼_默詩碼名 = $簡稱 . '詩碼_' . '默詩碼';
	$默詩碼_版詩碼 = array();
	$版詩碼_默詩碼 = array();
	
	$版文碼_版詩碼名 = $簡稱 . '文檔碼_' . $簡稱 . '詩碼';
	$版文碼_版詩碼 = array();

	foreach( $版本目錄 as $版詩碼 => $條目 )
	{
		// 文檔碼
		if( $簡稱 == '奭' )
		{
			$默文碼 = $條目[ "默文檔碼" ];
			$版文碼 = $條目[ "${簡稱}文檔碼" ];
		}
		else
		{
			$默文碼 = substr( $條目[ "默詩碼" ], 0, 4 );
			$版文碼 = substr( $條目[ "${簡稱}詩碼" ], 0, 4 );
		}
		
		if( !array_key_exists( $默文碼, $默文碼_版文碼 ) )
		{
			$默文碼_版文碼[ $默文碼 ] = array();
		}
		
		array_push( $默文碼_版文碼[ $默文碼 ], $版文碼 );
		
		if( !array_key_exists( $版文碼, $版文碼_默文碼 ) )
		{
			$版文碼_默文碼[ $版文碼 ] = array();
		}
		
		array_push( $版文碼_默文碼[ $版文碼 ], $默文碼 );

		
		if( !array_key_exists( $版文碼, $版文碼_版詩碼 ) )
		{
			$版文碼_版詩碼[ $版文碼 ] = array();
		}
		
		// 詩碼
		if( $簡稱 == '奭' )
		{
			$默詩碼 = $條目[ "默文檔碼" ];
			$版詩碼 = $條目[ "${簡稱}文檔碼" ];
		}
		else
		{
			$默詩碼 = $條目[ "默詩碼" ];
			$版詩碼 = $條目[ "${簡稱}詩碼" ];
		}
		$默詩碼_版詩碼[ $默詩碼 ] = $版詩碼;
		$版詩碼_默詩碼[ $版詩碼 ] = $默詩碼;
		

		array_push( $版文碼_版詩碼[ $版文碼 ], $版詩碼 );
	}
	//ksort( $默詩碼_版詩碼 );

	// 文檔碼
	$json = json_encode(
		$默文碼_版文碼,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
		'catalog' . DS .
		$默文碼_版文碼名 . '.json',
		$json . PHP_EOL );

	$json = json_encode(
		$版文碼_默文碼,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
		'catalog' . DS .
		$版文碼_默文碼名 . '.json',
		$json . PHP_EOL );

	// 詩碼
	$json = json_encode(
		$默詩碼_版詩碼,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
		'catalog' . DS .
		$默詩碼_版詩碼名 . '.json',
		$json . PHP_EOL );

	$json = json_encode(
		$版詩碼_默詩碼,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
		'catalog' . DS .
		$版詩碼_默詩碼名 . '.json',
		$json . PHP_EOL );
	
	// 版文碼_版詩碼
	$json = json_encode(
		$版文碼_版詩碼,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4) . DS . PACKAGES_DIR . $書名 . DS .
		'catalog' . DS .
		$版文碼_版詩碼名 . '.json',
		$json . PHP_EOL );
}
?>

