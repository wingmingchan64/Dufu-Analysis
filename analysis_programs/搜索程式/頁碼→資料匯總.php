<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→資料匯總.php 0013
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 頁碼_詩題 );
require_once( 詩組_詩題 );
require_once( 書目簡稱 );
//require_once( 帶序文之詩歌 );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );
// wrong page number
if( !array_key_exists( $頁碼, $頁碼_詩題 ) )
{
	echo 無頁碼, NL;
}
// what to collect and show
$資料陣列 = array(
	'首'=>array( 
		'粵'=>array(), // just on/off
	),
	'中'=>array( 
		'楊'=>array( 注釋 ),
		'仇'=>array( 注釋 ),
		'蕭'=>array( 注釋 ),
		'今'=>array( 注釋, 大意 ),
		'譯'=>array( 譯文 ),
	),
	'尾'=>array(
		'顧'=>array( 評論 ),
		'楊'=>array( 評論 ),
		'奭'=>array( 評論 ),
		'仇'=>array( 評論 ),
		'浦'=>array( 評論 ),
		'蕭'=>array( 評論 ),
	),
);
$中陣列 = array();
$尾陣列 = array();

$默認路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
require_once( $默認路徑 );
// get poem
$詩文内容 = $内容[ 行碼 ];
// remove page number
$詩文内容[ '〚1〛' ] = preg_replace( '/\d{4}/', '', $詩文内容[ '〚1〛' ] );
// insert 副題
if( array_key_exists( $頁碼, $詩組_詩題 ) )
{
	$副題s = $内容[ 副題 ];
	$副題行碼 = $詩組_詩題[ $頁碼 ][ 1 ];
	$index = 1;
	
	foreach( $副題行碼 as $行碼 )
	{
		$詩文内容[ "〚${行碼}〛" ] = $副題s[ "〚${頁碼}:${index}:〛" ];
		$index++;
	}
}
// output poem
echo NL, 【詩文】, NL;
foreach( $詩文内容 as $行碼 => $詩文 )
{
	echo $詩文, NL;
}
// 版本資料
$中内容 = NL . 〖分行討論〗 . NL;
$尾内容 =  〖通篇討論〗 . NL;

foreach( $資料陣列 as $首中尾 => $版本内容 )
{
	if( $首中尾 == '中' )
	{
		echo $中内容;
	}
	
	foreach( $版本内容 as $簡稱 => $部分s )
	{
		$版本文件夾 = 杜甫資料庫 . $書目簡稱[ '=' . $簡稱 ] . "\\";
		
		if( $首中尾 == '首' )
		{
			if( $簡稱 == '粵' )
			{
				$file = $版本文件夾 . $頁碼 . 程式後綴;
				$陣列名 = "${簡稱}内容";
				
				if( file_exists( $file ) )					
				{
					require_once( $file );
					
					echo NL, '陳永明《杜甫全集粵音注音》';
					if( array_key_exists( 詩文注音, $$陣列名 ) )
					{
						echo NL, 【注音】, NL;
						echo $$陣列名[ 詩文注音 ];
					}
					
					if( array_key_exists( 韻部, $$陣列名 ) )
					{
						echo NL, 【韻部】, NL;
						foreach( $$陣列名[ 韻部 ] as $坐標 => $韻 )
						{
							echo $韻, NL;
						}
					}
					
					if( array_key_exists( 體裁, $$陣列名 ) )
					{
						echo NL, 【體裁】, NL;
						if( is_string( $$陣列名[ 體裁 ] ) )
						{
							echo $$陣列名[ 體裁 ], NL;
						}
						elseif( is_array( $$陣列名[ 體裁 ] ) )
						{
							foreach( $$陣列名[ 體裁 ] as $坐標 => $體裁 )
							{
								echo $坐標, $體裁, NL;
							}
						}
					}
					if( array_key_exists( 補充說明, $$陣列名 ) )
					{
						echo NL, 【補充說明】, NL;
						if( is_string( $$陣列名[ 補充說明 ] ) )
						{
							echo $$陣列名[ 補充說明 ], NL;
						}
						elseif( is_array( $$陣列名[ 補充說明 ] ) )
						{
							foreach( $$陣列名[ 補充說明 ] as $坐標 => $補充說明 )
							{
								echo $坐標, $補充說明, NL;
							}
						}
					}
				}
			}
		}
		elseif( $首中尾 == '中' )
		{
			foreach( $部分s as $部分 )
			{
				$file = $版本文件夾 . $書目簡稱[ '=' . $簡稱 ] . $部分 . 程式後綴;
			
				if( file_exists( $file ) )
				{
					require_once( $file );
					$陣列名 = $書目簡稱[ '=' . $簡稱 ] . $部分;
					
					foreach( array_keys( $$陣列名 )as $key )
					{
						
						//echo $key, NL;
						if( strpos( $key, "〚${頁碼}:" ) !== false )
						{
							if( !array_key_exists( $key, $中陣列 ) )
							{
								$中陣列[ $key ] = array();
							}
							array_push( $中陣列[ $key ], 
								"【${部分}】" . $簡稱 . "：" . $$陣列名[ $key ] ) ;
						}					
					}
				}
			}
		}
		else // 尾
		{
			foreach( $部分s as $部分 )
			{
				$file = $版本文件夾 . $書目簡稱[ '=' . $簡稱 ] . $部分 . 程式後綴;
				
				if( file_exists( $file ) )
				{
					require_once( $file );
					
					$陣列名 = "${簡稱}${部分}";
					if( !array_key_exists( $書目簡稱[ '=' . $簡稱 ] . $部分, $尾陣列 ) )
					{
						$尾陣列[ $書目簡稱[ '=' . $簡稱 ] . $部分 ] = array();
					}
					
					// 2 possible key types: with or with 首碼
					foreach( array_keys( $$陣列名 ) as $key )
					{
						if( $key == "〚${頁碼}:〛" )
						{
							array_push( 
								$尾陣列[ $書目簡稱[ '=' . $簡稱 ] . $部分 ],
								$$陣列名[ "$key" ] );
						}
						elseif( strpos( $key, "〚${頁碼}:" ) !== false )
						{
							array_push( 
								$尾陣列[ $書目簡稱[ '=' . $簡稱 ] . $部分 ],
								array( $key => $$陣列名[ "$key" ] ) );
						}
					}
				}
			}
		}
	}
}

foreach( $内容[ 行碼 ] as $行碼 => $詩文 )
{
	if( $詩文 == '' )
	{
		continue;
	}
	elseif( $行碼 == '〚1〛' &&
		array_key_exists( "〚${頁碼}:1〛", $中陣列 ) )
	{
		echo  【題解】 , NL;
		
		foreach( $中陣列[ "〚${頁碼}:1〛" ] as $題解 )
		{
			echo str_replace( 【注釋】, '', $題解 ), NL;
		}
		echo NL;
		echo 【詩句】, NL;
		continue;
	}

	echo $詩文, NL;
	foreach( array_keys( $中陣列 ) as $坐標 )
	{
		$碼 = 提取行碼( $坐標 );
		if( "〚${碼}〛" == $行碼 )
		{
			$content = $中陣列[ $坐標 ];
			foreach( $content as $line )
			{
				echo $line, NL;
			}
		}
	}
	echo NL;
}

echo $尾内容;

foreach( $尾陣列 as $書名 => $内容s )
{
	// when there is content to display
	if( sizeof( $内容s ) > 0 )
	{
		echo NL, $書名, NL;
	}
	
	foreach( $内容s as $内容 )
	{
		if( is_string( $内容 ) )
		{
			echo $内容, NL;
		}
		elseif( is_array( $内容 ) ) // 坐標 => array
		{
			foreach( $内容 as $坐標 => $lines )
			{
				if( is_string( $坐標 ) )
				{
					echo $坐標;
				}
				if( is_string( $lines ) )
				{
					echo $lines, NL;
				}
				elseif( is_array( $lines ) )
				{
					foreach( $lines as $l )
					{
						echo $l, NL;
					}
				}
			}
		}
	}
}
?> 