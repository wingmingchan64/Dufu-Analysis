<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成坐標_詩文.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
	
$詩_BASE = 
	dirname( __DIR__, 5 )  . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"默認版本" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;
	
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$組詩_副題 = 提取數據結構( 組詩_副題 );
$帶序言之詩 = 提取數據結構( 帶序言之詩 );

$行碼_詩文 = array();
$行碼_副題 = array();
$句碼_詩句 = array();
$文檔碼_碼_字 = array();
$文檔碼_字_碼 = array();
$詩字_字碼 = array();
$字碼_詩字 = array();
$二字組合 = array();
$三字組合 = array();
$四字組合 = array();
$五字組合 = array();
$六字組合 = array();
$七字組合 = array();
$八字組合 = array();
$九字組合 = array();
$十字組合 = array();
$十一字組合 = array();
$坐標_句 = array();
$坐標_行 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	if( intval( $文檔碼 )> 6093 )
	{
		break;
	}

	if( !array_key_exists( $文檔碼, $行碼_詩文 ) )
	{
		$行碼_詩文[ $文檔碼 ] = array();
	}
	
	$首 = 0;
	$行 = 0;
	
	$詩文檔碼 = $詩_BASE . $文檔碼 . ".txt";
	$handle = @fopen( $詩文檔碼, "r" );
	
	if( !$handle )
	{
		error_log( "⚠️ Cannot open file: $from_file" );
		continue;
	}
	
	while( ( $line = fgets( $handle ) ) !== false )
	{
		if( 是組詩( $文檔碼 ) )
		{
			$行++; // start with 1

			if( !array_key_exists( $文檔碼, $行碼_副題 ) )
			{
				$行碼_副題[ $文檔碼 ] = array();
			}
			
			// skip 詩題
			if( $行 == 1 )
			{
				continue;
			}
			// skip 序言
			if( in_array( "$文檔碼", $帶序言之詩 ) &&
				$行 == 3 )
			{
				//echo "$文檔碼:$行";
				continue;
			}
			
			//print_r( $組詩_副題[ $文檔碼 ][ 1 ] );
			/*
			if( array_key_exists( "$文檔碼", $組詩_副題 )
				&& in_array( "$行", $組詩_副題[ $文檔碼 ][ 1 ] ) 
			)
			{
				continue;
			}
			*/
			
			foreach( $組詩_副題[ $文檔碼 ] as $k => $v )
			{
				if( intval( $k ) > 0 )
				{
					if( in_array( $行 . '', array_keys( $v ) ) )
					{
						$首 = $k;
						$行碼template = "〚${文檔碼}:${k}:${行}〛";
						$行碼_副題[ $文檔碼 ][ $行碼template ] = trim( $line );
				
						continue;
					}
				}
			}
			
			//if( in_array( 
				//$行, $組詩_副題[ $文檔碼 ][ 1 ] ) )
				
			//if( 是組詩（ $文檔碼 ） ）
			//{
				//$首++;
				
			//}
		}
		// not group
		else
		{
			$行++;			
			$行碼template = "〚${文檔碼}:${行}〛";
			// skip 詩題
			if( $行 == 1 )
			{
				continue;
			}
			
			if( in_array( "${文檔碼}", $帶序言之詩 ) &&
				$行 == 3 )
			{
				//echo "$文檔碼:$行";
				continue;
			}
		}
		// update the template
		if( 是組詩( $文檔碼 ) )
		{
			$行碼template = "〚${文檔碼}:${首}:${行}〛";
		}
		else
		{
			$行碼template = "〚${文檔碼}:${行}〛";
		}
		
		$line = trim( $line );
		
		if( $line == '' )
		{
			continue;
		}
		
		// skip 
		if( 是組詩( $文檔碼 ) &&
			array_key_exists( 
			$行碼template, $行碼_副題[ $文檔碼 ] ) )
			{
				continue;
			}
		
		$行碼_詩文[ $文檔碼 ][ $行碼template ] = trim( $line );
		
		if( $行碼template != "〚${文檔碼}:1〛" && // not 詩題
			( !array_key_exists( $文檔碼, $行碼_副題 ) ||
				!in_array( $行碼template, $行碼_副題[ $文檔碼 ] ) 
			) &&
			$line != ''
		)
		{
			$句s = explode( '。', normalize( $line ) );
			
			//print_r( count( $句s ) );
			
			for( $i = 0; $i<count( $句s ); $i++ )
			{
				if( !array_key_exists( $文檔碼, $句碼_詩句 ) )
				{
					$句碼_詩句[ $文檔碼 ] = array();
				}
				if( mb_strlen( $句s[ $i ] ) > 0 )
				{
					//$句 = $i + 1;
					
					$句碼 = 
						str_replace(
							'〛', 
							'.' . $i + 1 . '〛' ,  
							$行碼template );

					$句碼_詩句[ $文檔碼 ][ $句碼 ] = $句s[ $i ];
					
					if( !array_key_exists( 
						$句s[ $i ], $句碼_詩句[ $文檔碼 ] ) )
					{
						$句碼_詩句[ $句s[ $i ] ] = array();
					}
					array_push( $句碼_詩句[ $句s[ $i ] ], $句碼 );
					
					for( $j = 0; $j < mb_strlen( $句s[ $i ] ); $j++ )
					{
						if( !array_key_exists( $文檔碼, $文檔碼_碼_字 ) )
						{
							$文檔碼_碼_字[ $文檔碼 ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $j + 1 .
								'〛' ,  
							$句碼 );
						$文檔碼_碼_字[ $文檔碼 ][ $字碼 ] =
							mb_substr( $句s[ $i ], $j, 1 );
							
						if( !array_key_exists( 
						mb_substr( $句s[ $i ], $j, 1 ), $文檔碼_字_碼 ) )
					{
						$文檔碼_字_碼[ mb_substr( $句s[ $i ], $j, 1 ) ] = array();
					}
					array_push( $文檔碼_字_碼[ mb_substr( $句s[ $i ], $j, 1 ) ], $字碼 );

					}
					
					
					// 組合
					//$句s[ $i ]
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 1; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 2 );
						if( !array_key_exists(
						$combo, $二字組合 ) )
						{
							$二字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 2 .
								'〛' ,  
							$句碼 );
						array_push( $二字組合[ $combo ], $字碼 );
					}
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 2; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 3 );
						if( !array_key_exists(
						$combo, $三字組合 ) )
						{
							$三字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 3 .
								'〛' ,  
							$句碼 );
						array_push( $三字組合[ $combo ], $字碼 );
					}
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 3; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 4 );
						if( !array_key_exists(
						$combo, $四字組合 ) )
						{
							$四字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 4 .
								'〛' ,  
							$句碼 );
						array_push( $四字組合[ $combo ], $字碼 );
					}
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 4; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 5 );
						if( !array_key_exists(
						$combo, $五字組合 ) )
						{
							$五字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 5 .
								'〛' ,  
							$句碼 );
						array_push( $五字組合[ $combo ], $字碼 );
					}
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 5; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 6 );
						if( !array_key_exists(
						$combo, $六字組合 ) )
						{
							$六字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 6 .
								'〛' ,  
							$句碼 );
						array_push( $六字組合[ $combo ], $字碼 );
					}
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 6; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 7 );
						if( !array_key_exists(
						$combo, $七字組合 ) )
						{
							$七字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 7 .
								'〛' ,  
							$句碼 );
						array_push( $七字組合[ $combo ], $字碼 );
					}
					
					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 7; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 8 );
						if( !array_key_exists(
						$combo, $八字組合 ) )
						{
							$八字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 8 .
								'〛' ,  
							$句碼 );
						array_push( $八字組合[ $combo ], $字碼 );
					}

					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 8; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 9 );
						if( !array_key_exists(
						$combo, $九字組合 ) )
						{
							$九字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 9 .
								'〛' ,  
							$句碼 );
						array_push( $九字組合[ $combo ], $字碼 );
					}

					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 9; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 10 );
						if( !array_key_exists(
						$combo, $十字組合 ) )
						{
							$十字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 10 .
								'〛' ,  
							$句碼 );
						array_push( $十字組合[ $combo ], $字碼 );
					}

					for( $k = 0; $k < mb_strlen( $句s[ $i ] ) - 10; $k++ )
					{
						$combo = mb_substr( $句s[ $i ], $k, 11 );
						if( !array_key_exists(
						$combo, $十一字組合 ) )
						{
							$十一字組合[ $combo ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $k + 1 . '-' .
								$k + 11 .
								'〛' ,  
							$句碼 );
						array_push( $十一字組合[ $combo ], $字碼 );
					}
					
				}
			}
		}
	}

	fclose( $handle );
}
ksort( $句碼_詩句 );
//ksort( $文檔碼_碼_字 );

//print_r( $文檔碼_碼_字 );

$json = json_encode(
	$文檔碼_碼_字,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"默認詩文檔碼_碼_字.json",
	$json . PHP_EOL );

$json = json_encode(
	$文檔碼_字_碼,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"字_碼.json",
	$json . PHP_EOL );

foreach( $文檔碼_碼_字 as $默認詩文檔碼碼 => $碼_字 )
{
	foreach( $碼_字 as $碼 => $字 )
	{
		if( !array_key_exists( $字, $詩字_字碼 ) )
		{
			$詩字_字碼[ $字 ] = array();
		}
		array_push( $詩字_字碼[ $字 ], $碼 );
	}
}

/*
print_r( $二字組合 );
print_r( $三字組合 );
print_r( $四字組合 );
print_r( $五字組合 );
print_r( $六字組合 );
print_r( $七字組合 );
*/

foreach( $句碼_詩句 as $文檔碼 => $標_句 )
{
	$坐標_句 = array_merge( $坐標_句, $標_句 );
}

foreach( $行碼_詩文 as $文檔碼 => $標_行 )
{
	$坐標_行 = array_merge( $坐標_行, $標_行 );
}

$json = json_encode(
	$行碼_詩文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"行碼_詩文.json",
	$json . PHP_EOL );

$json = json_encode(
    $行碼_副題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"行碼_副題.json",
	$json . PHP_EOL );

$json = json_encode(
    $句碼_詩句,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"句碼_詩句.json",
	$json . PHP_EOL );

$json = json_encode(
    $文檔碼_碼_字,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"字碼_詩字.json",
	$json . PHP_EOL );

$json = json_encode(
    $詩字_字碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"一字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $二字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"二字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $三字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"三字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $四字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"四字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $五字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"五字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $六字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"六字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $七字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"七字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $八字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"八字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $九字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"九字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $十字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"十字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $十一字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"十一字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $坐標_句,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"坐標_句.json",
	$json . PHP_EOL );

$json = json_encode(
    $坐標_行,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"坐標_行.json",
	$json . PHP_EOL );
?>