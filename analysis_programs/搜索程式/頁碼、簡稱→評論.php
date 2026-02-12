<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→評論.php 0003 名,奭,仇
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→評論.php 0013 名 
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→評論.php 0003: 名 
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→評論.php 0013: 名 
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→評論.php 0013:1: 名 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
//require_once( 頁碼 );

checkARGV( $argv, 3, 提供頁、簡 );
$result = array();
$頁 = fixDocID( trim( $argv[ 1 ] ) );
/*
if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}
*/
$簡稱s = fixText( trim( $argv[ 2 ] ) );
$簡稱陣列 = explode( ',', $簡稱s );

foreach( $簡稱陣列 as $簡稱 )
{
	if( $簡稱!= '' && !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
	{
		echo 無簡稱, NL;
		exit;
	}
}
// 提取資料
foreach( $簡稱陣列 as $簡稱 )
{
	if( $簡稱 == '' )
	{
		continue;
	}
	$書名 = $書目簡稱[ 等號 . $簡稱 ];
	$陣列名 = "${簡稱}評論";
	require_once( 杜甫資料庫 . $書名 . "\\" . $書名 . "評論.php" );
	
	echo $書名, NL;
	// no :
	if( strpos( $頁, ':' ) === false )
	{
		//echo "1", NL;
		//print_r( $$陣列名 );
		if( array_key_exists( '〚' . $頁 . ':〛', $$陣列名 ) )
		{
			//echo "1.1", NL;
			print_r( $$陣列名[ '〚' . $頁 . ':〛' ] );
		}
		elseif( array_key_exists( '〚' . $頁 . ':1:〛', $$陣列名 ) )
		{
			//echo "1.2", NL;
			echo '〚' . $頁 . ':1:〛', NL;
			print_r( $$陣列名[ '〚' . $頁 . ':1:〛' ] );
			
			for( $i = 2; $i < 21; $i++ )
			{
				if( array_key_exists( '〚' . $頁 . ":${i}:〛", $$陣列名 ) )
				{
					echo '〚' . $頁 . ":${i}:〛", NL;
					print_r( $$陣列名[ '〚' . $頁 . ":${i}:〛" ] );
				}
				else
				{
					continue;
				}
			}
		}
	}
	// full 0003: or 0013:1:
	elseif( array_key_exists( '〚' . $頁 . '〛', $$陣列名 ) )
	{
		//echo "2", NL;
		print_r( $$陣列名[ '〚' . $頁 . '〛' ] );
	}
	// partial 0013:
	elseif( strpos( $頁, ':' ) !== false && 
		array_key_exists( '〚' . $頁 . '1:〛', $$陣列名) )
	{
		//echo "3", NL;

		for( $i = 1; $i < 21; $i++ )
		{
			//echo '〚' . $頁 . "${i}:〛", NL;
			if( array_key_exists( '〚' . $頁 . "${i}:〛", $$陣列名 ) )
			{
				echo '〚' . $頁 . "${i}:〛", NL;
				print_r( $$陣列名[ '〚' . $頁 . "${i}:〛" ] );
			}
			else
			{
				continue;
			}
		}
	}
	else
	{
		//echo '4', NL;
		echo 無結果, NL;
	}
}
?>