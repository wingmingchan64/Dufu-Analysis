<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成坐標_詩文.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
$詩_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"默認版本" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;
$行碼_詩文 = array();
$行碼_副題 = array();
$詩句 = array();
$文檔碼_碼_字 = array();
$文檔碼_字_碼 = array();
//$詩字_碼
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

foreach( $默認詩文檔碼 as $文檔碼 )
{
	if( !array_key_exists( $文檔碼, $行碼_詩文 ) )
	{
		$行碼_詩文[ $文檔碼 ] = array();
	}
	
	$首 = 0;
	$行 = 0;
	$組詩 = false;
	
	$詩文檔碼 = $詩_BASE . $文檔碼 . ".txt";
	$handle = @fopen( $詩文檔碼, "r" );
	
	if( !$handle )
	{
		error_log( "⚠️ Cannot open file: $from_file" );
		continue;
	}
	if( array_key_exists( $文檔碼, $組詩_副題 ) )
	{
		$組詩 = true;
	}

	while( ( $line = fgets( $handle ) ) !== false )
	{
		if( $組詩 )
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
			// skip 序文
			if( in_array( "$文檔碼", $帶序文之詩 ) &&
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
			if( in_array( 
				intval( $行 ), $組詩_副題[ $文檔碼 ][ 1 ] ) )
			{
				$首++;
				$行碼template = "〚${文檔碼}:${首}:${行}〛";

			if( $文檔碼 == '0013' )
			{
				//echo $行碼template, NL;
			}
				$行碼_副題[ $文檔碼 ][ $行碼template ] = trim( $line );
				
			if( $文檔碼 == '0013' )
			{
				//echo $行, NL;
				print_r( $組詩_副題[ $文檔碼 ][ 1 ] );
			}
				
				continue;
			}
		}
		else
		{
			$行++;			
			$行碼template = "〚${文檔碼}:${行}〛";
			// skip 詩題
			if( $行 == 1 )
			{
				continue;
			}
			
			if( in_array( "$文檔碼", $帶序文之詩 ) &&
				$行 == 3 )
			{
				//echo "$文檔碼:$行";
				continue;
			}
			
			if( array_key_exists( "$文檔碼", $組詩_副題 )
				&& in_array( "$文檔碼", $組詩_副題[ $文檔碼 ][ 1 ] ) 
			)
			{
				continue;
			}
		}
		// update the template
		if( $組詩 )
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
		$行碼_詩文[ $文檔碼 ][ $行碼template ] = trim( $line );
		
		if( $行碼template != "〚${文檔碼}:1〛" && // not 詩題
			( !array_key_exists( $文檔碼, $行碼_副題 ) ||
				!in_array( $行碼template, $行碼_副題[ $文檔碼 ] ) 
			) &&
			$line != ''
		)
		{
			$句s = explode( '。', normalize( $line ) );
			if( $文檔碼 == '0013' )
			{
				print_r( $句s );
			}
			//print_r( count( $句s ) );
			
			for( $i = 0; $i<count( $句s ); $i++ )
			{
				if( !array_key_exists( $文檔碼, $詩句 ) )
				{
					$詩句[ $文檔碼 ] = array();
				}
				if( mb_strlen( $句s[ $i ] ) > 0 )
				{
					//$句 = $i + 1;
					
					$句碼 = 
						str_replace(
							'〛', 
							'.' . $i + 1 . '〛' ,  
							$行碼template );
					if( $文檔碼 == '0013' )
					{
						echo $句碼, NL;
					}
					$詩句[ $文檔碼 ][ $句碼 ] = $句s[ $i ];
					
					if( !array_key_exists( 
						$句s[ $i ], $詩句[ $文檔碼 ] ) )
					{
						$詩句[ $句s[ $i ] ] = array();
					}
					array_push( $詩句[ $句s[ $i ] ], $句碼 );
					
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
ksort( $詩句 );
//ksort( $文檔碼_碼_字 );

//print_r( $文檔碼_碼_字 );

$json = json_encode(
	$文檔碼_碼_字,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"文檔碼_碼_字.json",
	$json . PHP_EOL );

$json = json_encode(
	$文檔碼_字_碼,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
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

$json = json_encode(
	$行碼_詩文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"行碼_詩文.json",
	$json . PHP_EOL );

$json = json_encode(
    $行碼_副題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"行碼_副題.json",
	$json . PHP_EOL );

$json = json_encode(
    $詩句,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"句碼_詩句.json",
	$json . PHP_EOL );

$json = json_encode(
    $文檔碼_碼_字,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"字碼_詩字.json",
	$json . PHP_EOL );

$json = json_encode(
    $詩字_字碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"一字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $二字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"二字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $三字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"三字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $四字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"四字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $五字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"五字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $六字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"六字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $七字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"七字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $八字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"八字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $九字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"九字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $十字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"十字組合_坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $十一字組合,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"十一字組合_坐標.json",
	$json . PHP_EOL );
?>