<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼版本簡稱書名提取版本詩文.php 0276 全 《御製全唐詩》
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

check_argv( $argv, 4, 提供頁、簡 );
$頁碼 = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );
$版本書名 = trim( $argv[ 3 ] );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . $頁碼 . 程式後綴;
$默認路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
$詩題 = '';
$詩文 = '';

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	$列陣名 = "${簡稱}内容";
	
	if( array_key_exists( 詩題, $$列陣名 ) )
	{
		$詩題 = $$列陣名[ 詩題 ];
	}
	else
	{
		require_once( $默認路徑 );
		$詩題 = $内容[ 詩題 ];
	}
	$詩文 = $$列陣名[ 版本 ][ 詩文 ];
	
	if( array_key_exists( 校記, $$列陣名 ) )
	{
		$校記 = $$列陣名[ 校記 ];
		$校記陣列 = array();
		$校記s = explode( NL, $校記 );
		$current_key = '';
		//print_r( $校記s );
		foreach( $校記s as $l )
		{
			if( str_starts_with( $l, '《' ) )
			{
				$current_key = $l;
				$校記陣列[ $current_key ] = array();
			}
			else
			{
				array_push( $校記陣列[ $current_key ], $l );
			}
		}
		print_r( $校記陣列 );
		
		if( array_key_exists( $版本書名, $校記陣列 ) )
		{
			foreach( $校記陣列[ $版本書名 ] as $l )
			{
				if( mb_strpos( $l, 坐標關括號 ) !== false )
				{
					$parts = explode( 坐標關括號, $l );
					if( mb_strpos( $parts[ 1 ], '作' ) !== false )
					{
						$subparts = explode( '作', $parts[ 1 ] );
						if( sizeof( $subparts ) > 1 &&
							$subparts[ 0 ] != '' &&
							$subparts[ 1 ] != '' )
						{
							$詩文 = str_replace(
								$subparts[ 0 ], $subparts[ 1 ], $詩文 );
						}
					}
				}
			}
		}
	}
	
	echo $版本書名, NL;
	echo '《', $詩題, '》', NL, NL;
	echo $詩文;

}
else
{
	echo 無結果 . NL;
}
?>