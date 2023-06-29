<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 〚0003〛
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 〚0003:〛
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php abcde
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 1234
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:10
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:10:
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:a
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:1
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:5
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:5-8
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:1
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:12
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:17
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:2.1
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:1:2.1
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 4235:5.2.3
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 4235:15.2.3
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003.3.1.2
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003.3-5
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:3-5
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0003:3-7
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:12.1.3-5
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:12.1.5-7
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以坐標提取詩文.php 0013:2:

規則：
1. 坐標可以帶、可以不帶（裸坐標）坐標括號： 0003 〚0003〛
2. 坐標中第一組數字必須是頁碼，是個四位數字，後頭可以有、可以沒有冒號:（ascii 的冒號）： 〚0003:〛
3. 如果頁碼有效，顯示詩題
4. 如果頁碼後面有首碼或行碼，那頁碼後必須有冒號
5. 如果是詩組，坐標中第二組數字必須是首碼，後頭必須有冒號：〚0013:1:〛
6. 如果是詩組，坐標中第三組數字必須是行碼：〚0013:1:6〛
7. 如果不是詩組，坐標中第二組數字必須是行碼：〚0003:4〛
8. 行碼可以用範圍數字：〚0003:4-5〛〚0013:1:5-7〛
9. 如果是詩組，坐標中第四組數字必須是句碼；句碼必須是 1 或者 2：〚0013:1:6:1〛
10. 如果不是詩組，坐標中第三組數字必須是句碼；句碼必須是 1 或者 2：〚0003:4.2〛
11. 如果坐標中沒有句碼，行碼後不能有點號（.）
12. 有句碼的坐標，行碼不能用範圍數字
13. 句碼不能用範圍數字
14. 如果是詩組，坐標中第五組數字必須是字碼：〚0013:1:6:1:5〛
15. 如果不是詩組，坐標中第四組數字必須是字碼：〚0003:4:1:2〛
16. 字碼可以用範圍數字：〚0003:4:1:2-5〛
17. 整個坐標中，只能有一組範圍數字
18. 詩題的行碼一定是 1
19. 有序文的詩，其序文的行碼一定是 3
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

//checkARGV( $argv, 2, 提供坐標 );
//$坐標 = trim( $argv[ 1 ], '〚〛' ); // 去掉〚〛
//print_r( 以坐標提取詩文( $坐標 ) );

function 以坐標提取詩文( string $坐標 ) : array
{
require( 頁碼 );
require( 頁碼_詩題 );

$result = array();
$result[ 詩題 ] = '';
$result[ 詩文 ] = 無結果;
$冒號 = ':';
$點號 = '.';

// 只有頁碼
// 2. 坐標中第一組數字必須是頁碼，是個四位數字，後頭可以有、可以沒有冒號:（ascii 的冒號）： 〚0003:〛
if( strlen( $坐標 ) <= 5   ) 
{
	$頁 = trim( $坐標, $冒號 );

	if( in_array( $頁, $頁碼 ) )
	{
		$result[ 坐標頁碼 ] = $頁 ;
		$result[ 詩題 ] = $頁碼_詩題[ $頁 ];
	}
	else
	{
		echo 無頁碼, $頁, NL;
		exit;
	}
}
// strlen 大於5，得有冒號
// 4. 如果頁碼後面有首碼或行碼，那頁碼後必須有冒號
elseif( strpos( $坐標, $冒號 ) === false ) // 沒有冒號
{
	echo 無頁碼, $坐標, NL;
	exit;
}
else // 有冒號
{
	// 除去頁碼冒號
	$mh_pos = strpos( $坐標, $冒號 );
	$頁 = substr( $坐標, 0, $mh_pos ); // 首個冒號前
	$remainder = substr( $坐標, $mh_pos+1 );
	
	if( strlen( $頁 ) != 4 || !in_array( $頁, $頁碼 ))
	{
		echo 無頁碼, $頁, NL;
		exit;
	}
	
	$result[ 坐標頁碼 ] = $頁;
	$result[ 詩題 ] = $頁碼_詩題[ $頁 ];
	//echo $remainder, NL;
	
	// 只餘首碼:
	if( str_ends_with( $remainder, $冒號 ) ) 
	{
		//echo "should be here\n";
		$remainder = trim( $remainder, $冒號 );
		//echo $remainder, NL;
		
		if( intval( $remainder ) < 1 || intval( $remainder ) > 20 )
		{
			echo '1', 無首碼, $remainder, NL;
			exit;
		}
		else
		{
			$result[ 坐標首碼 ] = $remainder;
		}
		$行句字碼 = '';
	}
	// 首碼及其他
	elseif( strpos( $remainder, $冒號 ) !== false )
	{
		$parts = explode( $冒號, $remainder );
		$首碼   = $parts[ 0 ];
		$行句字碼 = $parts[ 1 ];
		
		if( intval( $首碼 ) < 1 || intval( $首碼 ) > 20 )
		{
			echo '3', 無首碼, $首碼, NL;
			exit;
		}
		else
		{
			$result[ 坐標首碼 ] = $首碼;
		}
	}
	// 沒有首碼
	else
	{
		$行句字碼 = $remainder;
	}

	if( $行句字碼!= '' && strpos( $行句字碼, $點號 ) === false ) // 只餘行碼
	{ 
		if( intval( $行句字碼 ) < 1 || intval( $行句字碼 ) > 100 )
		{
			echo 無行碼, $行句字碼, NL;
			exit;
		}
		$result[ 行碼 ] = $行句字碼;
	}
	elseif( str_ends_with( $行句字碼, $點號 ) )
	{
		echo 無行碼, $行句字碼, NL;
		exit;
	}
	elseif( $行句字碼!= '' )
	{
		$parts = explode( $點號, $行句字碼 );
		$行碼 = $parts[ 0 ];
			
		if( intval( $行碼 ) < 1 || intval( $行碼 ) > 100 )
		{
			echo 無行碼, $行碼, NL;
			exit;
		}
		else
		{
			$result[ 行碼 ] = $行碼;
		}
			
		if( sizeof( $parts ) >= 2 )
		{
			$句碼 = $parts[ 1 ];
				
			if( intval( $句碼 ) != 1 && intval( $句碼 ) != 2 )
			{
				echo 無句碼, $句碼, NL;
			}
			$result[ 坐標句碼 ] = $句碼;
		}
			
		if( sizeof( $parts ) == 3 )
		{
			$字碼 = $parts[ 2 ];
				
			if( intval( $字碼 ) <= 0 && intval( $字碼 ) > 20 )
			{
				echo 無字碼, $字碼, NL;
				exit;
			}
			$result[ 坐標字碼 ] = $字碼;
		}
	}
}		

require( 詩集文件夾 . $result[ 坐標頁碼 ] . 程式後綴 );
require( 詩組_詩題 );

//print_r( $内容 );
	
$頁碼 = $result[ 坐標頁碼 ];
$result[ 詩文 ] = $内容[ 詩文 ];
$首碼 = '';
$行碼 = '';
$句碼 = '';
$字碼 = '';

if( array_key_exists( $頁碼, $詩組_詩題 ) && 
	!array_key_exists( 坐標首碼, $result ) )
{
	echo "必須提供首碼。", NL;
	exit;
}

if( array_key_exists( 坐標首碼, $result ) )
{
	$首碼 = $result[ 坐標首碼 ];
	$坐標 = "〚${頁碼}:${首碼}:〛";
	if( !array_key_exists( "副題", $内容 ) )
	{
		echo 無首碼, $首碼, NL;
		exit;
	}
	if( !array_key_exists( $坐標, $内容[ 副題 ] ) )
	{
		echo 無首碼, $首碼, NL;
		exit;
	}
	$result[ 副題 ] = $内容[ 副題 ][ $坐標 ];
	$result[ 詩文 ] = implode( $内容[ "詩歌" ][ $result[ "副題" ] ] );
}
	
if( array_key_exists( 坐標行碼, $result ) )
{
	$行碼 = $result[ 坐標行碼 ];
	if( array_key_exists( 坐標首碼, $result ) )
	{
		$有效行碼 = findValidLineNumbers( $result[ 坐標頁碼 ], $result[ 坐標首碼 ] );
	}
	else
	{
		$有效行碼 = findValidLineNumbers( $result[ 坐標頁碼 ] );
	}
	$result[ '行' ] = array();
	
	// 沒有範圍數字
	if( strpos( $行碼, '-' ) === false )
	{
		if( !in_array( intval( $行碼 ), $有效行碼 ) )
		{
			echo 無行碼, $行碼, NL;
			exit;
		}
		$行坐標 = "〚${行碼}〛";
			
		if( array_key_exists( $行坐標, $内容[ 坐標行碼 ] ) )
		{
			array_push( $result[ '行' ], $内容[ 坐標行碼 ][ "〚${行碼}〛" ] );
		}
		else
		{
			echo 無行碼, $行碼, NL;
			exit;
		}
	}
	// 範圍數字
	else
	{
		$行碼s = explode( '-', $行碼 );
		$b = intval( $行碼s[ 0 ] );
		$e = intval( $行碼s[ 1 ] );
			
		if( $e <= $b )
		{
			echo 無行碼, $行碼, NL;
			exit;
		}
		if( array_intersect( range( $b, $e ), $有效行碼  ) != range( $b, $e ) )
		{
			echo 無行碼, $行碼, NL;
			exit;
		}
			
		// 有首碼
		$坐標 = '';
			
		if( array_key_exists( 坐標首碼, $result ) )
		{
			$坐標 = '〚' . $result[ 坐標頁碼 ] . $冒號 . 
					$result[ 坐標首碼 ] . $冒號;
		}
		else
		{
			$坐標 = '〚' . $result[ 坐標頁碼 ] . $冒號;
		}
				
		foreach( range( $b, $e ) as $i )
		{
			//echo '坐標:', $坐標, NL;
			$行 = '';
			$坐 = $坐標 . $i . $點號 . '1〛';
				
			//echo $坐, NL;
			if( array_key_exists( $坐, $内容[ '坐標_句' ] ) )
			{
				//echo $坐 . '1〛', NL;
				$行 = $行. $内容[ '坐標_句' ][ $坐 ] . '。';
			}
			$坐 = $坐標 . $i . $點號 . '2〛';
			//echo $坐, NL;
			if( array_key_exists( $坐, $内容[ '坐標_句' ] ) )
			{
				//echo $坐 . '2〛', NL;
				$行 = $行 . $内容[ '坐標_句' ][ $坐 ] . "。\n";
			}
			if( $行 != '' )
			{
				array_push( $result[ '行' ], $行 );
			}
		}
	}
		
	if( $result[ '行' ][ 0 ] == '' )
	{
		echo 無行碼, $行碼, NL;
		exit;
	}
	$result[ 詩文 ] = implode( $result[ '行' ] );
}
if( array_key_exists( 坐標句碼, $result ) )
{
	//坐標_句
	if( intval( $result[ 坐標句碼 ] != 1 ) &&
		intval( $result[ 坐標句碼 ] != 2 ) )
	{
		echo 無句碼, $句碼, NL;
		exit;
	}
	$句s = explode( '。', $result[ '行' ][ 0 ] ); // only line
	$result[ '句' ] = $句s[ intval( $result[ 坐標句碼 ] ) - 1 ];
	$result[ 詩文 ] = $result[ '句' ];
}
	
	if( array_key_exists( 坐標字碼, $result ) )
	{
		$字碼 = $result[ 坐標字碼 ];
		$字pos = array();
		$result[ '字' ] = '';
		
		if( strpos( $字碼, '-' ) !== false )
		{
			$字碼s = explode( '-', $字碼 );
			$b = intval( $字碼s[ 0 ] );
			$e = intval( $字碼s[ 1 ] );
			
			if( $e <= $b )
			{
				echo 無字碼, $字碼, NL;
				exit;
			}
			$字pos = range( $b, $e );
		}
		else
		{
			$字pos = array( intval( $字碼 ) );
		}
		foreach( $字pos as $字p )
		{
			$字 = mb_substr( $result[ '句' ], $字p-1, 1 );
			if( $字 !== '' )
			{
				$result[ '字' ] .= $字;
			}
			else
			{
				echo 無字碼, $字碼, NL;
				exit;
			}
	}
	$result[ 詩文 ] = $result[ '字' ];
}
return $result;
}
//print_r( $result );
//$r = findValidLineNumbers( '3708', '2' );
//print_r( $r );

function findValidLineNumbers( string $頁, string $首 = '' ) : array
{
	require( 詩組_詩題 );
	require( 帶序文之詩歌 );
	$result = array();
	$temp = array();
	$b = 0;
	$e = 0;
	
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		if( $首 == '' )
		{
			echo "必須提供首碼。", NL;
			$b = -1;
			$e = -1;
		}
		else
		{
			$首num = intval( $首 );
			//print_r( sizeof( $詩組_詩題[ $頁 ][1] ) );
			
			if( $首num < 0 || $首num > sizeof( $詩組_詩題[ $頁 ][ 1 ] ) )
			{
				echo "首碼無效。", NL;
			}
			
			$b = $詩組_詩題[ $頁 ][ 1 ][ $首num - 1 ];
			if( $首num < sizeof( $詩組_詩題[ $頁 ][ 1 ] ) )
			{
				$e = $詩組_詩題[ $頁 ][ 1 ][ $首num ];
			}
		}
	}
	elseif( array_key_exists( $頁, $帶序文之詩歌[ "頁碼" ] ) )
	{
		$b = 5;
	}
	else
	{
		$b = 3;
	}
	require( 詩集文件夾 . $頁 . 程式後綴 );
	
	// the last line
	if( $e == 0 )
	{
		$e = sizeof( $内容[ 坐標行碼 ] );
	}
	
	return range( $b, $e );
}
?>