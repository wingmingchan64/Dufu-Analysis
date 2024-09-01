<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成資料匯總.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 頁碼 );
require_once( 頁碼_詩題 );
require_once( 詩組_詩題 );
require_once( 書目簡稱 );
require_once( 資料陣列 );

foreach( $頁碼 as $頁 )
{
	$content = '';

	$中陣列 = array();
	$尾陣列 = array();
	$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
	
	require_once( $默認路徑 );
	// get poem
	$詩文内容 = $内容[ 行碼 ];
	// remove page number
	$詩文内容[ '〚1〛' ] = preg_replace( '/\d{4}/', '', $詩文内容[ '〚1〛' ] );
	// insert 副題
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		$副題s = $内容[ 副題 ];
		$副題行碼 = $詩組_詩題[ $頁 ][ 1 ];
		$index = 1;
		
		foreach( $副題行碼 as $行碼 )
		{
			$詩文内容[ "〚${行碼}〛" ] = $副題s[ "〚${頁}:${index}:〛" ];
			$index++;
		}
	}
	// output poem
	//$content .= NL . 【詩文】 . NL;
	foreach( $詩文内容 as $行碼 => $詩文 )
	{
		$content .= $詩文 . NL;
	}
	// 版本資料
	$中内容 = NL . 〖分行討論〗 . NL;
	$尾内容 =  〖通篇討論〗 . NL;

	foreach( $資料陣列 as $首中尾 => $版本内容 )
	{
		if( $首中尾 == '中' )
		{
			$content .= $中内容;
		}
		
		foreach( $版本内容 as $簡稱 => $部分s )
		{
			$版本文件夾 = 杜甫資料庫 . $書目簡稱[ '=' . $簡稱 ] . "\\";
			
			if( $首中尾 == '首' )
			{
				if( $簡稱 == '粵' )
				{
					$file = $版本文件夾 . $頁 . 程式後綴;
					$陣列名 = "${簡稱}内容";
					
					if( file_exists( $file ) )					
					{
						require_once( $file );
						
						$content .= NL . '陳永明《杜甫全集粵音注音》';
						if( array_key_exists( 詩文注音, $$陣列名 ) )
						{
							$content .= NL . 【注音】 . NL;
							$content .= $$陣列名[ 詩文注音 ];
						}
						
						if( array_key_exists( 韻部, $$陣列名 ) )
						{
							$content .= NL . 【韻部】 . NL;
							try{
							foreach( $$陣列名[ 韻部 ] as $坐標 => $韻 )
							{
								$content .= $韻 . NL;
							}
							} catch ( Exception $e ) {
							echo $e, NL;
							//print_r( $$陣列名[ 韻部 ] );
							echo $頁, NL; 
							}
						}
						
						if( array_key_exists( 體裁, $$陣列名 ) )
						{
							$content .= NL . 【體裁】 . NL;
							if( is_string( $$陣列名[ 體裁 ] ) )
							{
								$content .= $$陣列名[ 體裁 ] . NL;
							}
							elseif( is_array( $$陣列名[ 體裁 ] ) )
							{
								foreach( $$陣列名[ 體裁 ] as $坐標 => $體裁 )
								{
									$content .= $坐標 . $體裁 . NL;
								}
							}
						}
						if( array_key_exists( 補充說明, $$陣列名 ) )
						{
							$content .= NL . 【補充說明】 . NL;
							if( is_string( $$陣列名[ 補充說明 ] ) )
							{
								$content .= $$陣列名[ 補充說明 ] . NL;
							}
							elseif( is_array( $$陣列名[ 補充說明 ] ) )
							{
								foreach( $$陣列名[ 補充說明 ] as $坐標 => $補充說明 )
								{
									$content .= $坐標 . $補充說明 . NL;
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
							if( strpos( $key, "〚${頁}:" ) !== false )
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
					//echo $file, NL;
					
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
							if( $key == "〚${頁}:〛" )
							{
								array_push( 
									$尾陣列[ $書目簡稱[ '=' . $簡稱 ] . $部分 ],
									$$陣列名[ "$key" ] );
							}
							elseif( strpos( $key, "〚${頁}:" ) !== false )
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
			array_key_exists( "〚${頁}:1〛", $中陣列 ) )
		{
			$content .=  【題解】 . NL;
			
			foreach( $中陣列[ "〚${頁}:1〛" ] as $題解 )
			{
				$content .= str_replace( 【注釋】, '', $題解 ) . NL;
			}
			$content .= NL;
			$content .= 【詩句】 . NL;
			continue;
		}
		// output 行碼
		$content .= $行碼 . $詩文 . NL;
		$keys = array_keys( $中陣列 );
		// use custom sorting!!!
		sort( $keys );

		foreach( $keys as $坐標 )
		{
			$碼 = 提取行碼( $坐標 );
			
			if( "〚${碼}〛" == $行碼 )
			{
				$c = $中陣列[ $坐標 ];
				
				
				foreach( $c as $line )
				{
					//$line = preg_replace( 夾注regex, '', $line );
					$content .= $line . NL;
				}
			}
		}
		$content .= NL;
	}

	$尾内容 = preg_replace( 夾注regex, '', $尾内容 );
	$content .= $尾内容;

	foreach( $尾陣列 as $書名 => $内容s )
	{
		// when there is content to display
		if( sizeof( $内容s ) > 0 )
		{
			if( is_string( $内容s[ 0 ] ) && $内容s[ 0 ] !== '' )
			{
				$content .= NL . $書名 . NL;
			}
			elseif( is_array( $内容s[ 0 ] ) )
			{
				/*
				try{
					//print_r( array_keys( $内容s[ 0 ] ) );
				
				if( sizeof( $内容s[ 0 ] ) > 0 &&
					!empty( $内容s[ 0 ][ 0 ] ) &&
					is_string( $内容s[ 0 ][ 0 ] ) && 
					$内容s[ 0 ][ 0 ] !== '' )
				{
					//print_r( $内容s[ 0 ] );
				}
				
				}catch( Exception $e ){ 
					//echo $e, NL;
					//echo $頁, NL;
				}
				*/
				
				$content .= NL . $書名 . NL;
			}
			else
				continue;
		}
		
		foreach( $内容s as $内容 )
		{
			if( is_string( $内容 ) )
			{
				$内容 = preg_replace( 夾注regex, '', $内容 );
				$content .= $内容 . NL;
			}
			elseif( is_array( $内容 ) ) // 坐標 => array
			{
				foreach( $内容 as $坐標 => $lines )
				{
					if( is_string( $坐標 ) )
					{
						$content .= $坐標;
					}
					if( is_string( $lines ) )
					{
						$lines = preg_replace( 夾注regex, '', $lines );
						$content .= $lines . NL;
					}
					elseif( is_array( $lines ) )
					{
						foreach( $lines as $l )
						{
							$l = preg_replace( 夾注regex, '', $l );
							$content .= $l . NL;
						}
					}
				}
			}
		}
	}
	
	$簡稱 = '';
	foreach( $書目簡稱 as $簡 => $書 )
	{
		$簡稱 .= str_replace( '=', '', $簡 ) . '：' . $書 . NL;
	}
	$content .= NL . '〖參考書目〗' . NL . $簡稱;
	

	$msg = file_get_contents( 'msg.txt', true );
	file_put_contents( 資料匯總文件夾 . $頁 . '.txt', 
		str_replace( '﻿', NL, $content . $msg ) );
	file_put_contents( "H:\\github\\Dufu-Analysis\\資料匯總\\" . $頁 . '.txt', 
		str_replace( '﻿', NL, $content . $msg ) );
}
?>