<?php
/*
// 參數: 什麽書、哪個部分
php code\生成杜甫詩選.php 參數="默:詩文;今:注釋;譯:譯文;仇:注釋,評論;浦:評論"
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "書目簡稱.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供參數。", "\n";
	exit;
}

// 詩選頁碼
$頁碼 = array(
	'0003', '0008', // etc.
);

$temp = array();
$詩選 = array();
$參數 = array();

parse_str( $argv[ 1 ], $temp );
$temp = explode( ';', $temp[ 參數 ] );

foreach( $temp as $k => $t )
{
	$簡_部s = explode( ':', $t );
	$參數[ $簡_部s[ 0 ] ] = explode( ',', $簡_部s[ 1 ] );
}

if( !array_key_exists( '默', $參數 ) )
{
	$參數[ '默' ] = array( '詩題' );
}

//print_r( $參數 );

foreach( $頁碼 as $頁 )
{
	foreach( $參數 as $簡稱 => $部分s )
	{
		$路徑 = 杜甫資料庫 . $書目簡稱[ '=' . $簡稱 ] . "\\${頁}.php";
		
		if( file_exists( $路徑 ) )
		{
			require_once( $路徑 );
			
			if( $簡稱 == '默' )
			{
				$陣列名 = 内容;
			}
			else
			{
				$陣列名 = "${簡稱}内容";
				echo 分隔線;
				echo $書目簡稱[ '=' . $簡稱 ], "\n\n";
			}
			
			foreach( $部分s as $部分 )
			{
				if( array_key_exists( $部分, $$陣列名 ) )
				{
					if( $部分 == '詩文' )
					{
						if( !array_key_exists( '詩題', $$陣列名 ) )
						{
							echo $内容[ '詩題' ], "\n\n";
						}
						else
						{
							echo $$陣列名[ '詩題' ], "\n\n";
						}
					}
					else
					{
						echo $部分, "\n\n";
					}
					
					if( is_string( $$陣列名[ $部分 ] ) )
					{
						echo $$陣列名[ $部分 ], "\n\n";
					}
					elseif( is_array( $$陣列名[ $部分 ] ) )
					{
						foreach( $$陣列名[ $部分 ] as $坐標 => $content )
						{
							echo $content, "\n";
						}
						echo "\n";
					}
				}
			}
		}
	}
	echo 分隔線 . 分隔線 . "\n";
}
?>