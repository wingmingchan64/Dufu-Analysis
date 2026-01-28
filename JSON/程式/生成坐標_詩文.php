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
$副題 = array();
$詩句 = array();
$詩字 = array();
$二字組合 = array();
$三字組合 = array();
$四字組合 = array();
$五字組合 = array();
$六字組合 = array();
$七字組合 = array();

foreach( $詩頁碼 as $頁 )
{
	if( !array_key_exists( $頁, $行碼_詩文 ) )
	{
		$行碼_詩文[ $頁 ] = array();
	}
	
	$首 = 0;
	$行 = 0;
	$詩組 = false;
	
	$詩文檔 = $詩_BASE . $頁 . ".txt";
	$handle = @fopen( $詩文檔, "r" );
	
	if( !$handle )
	{
		error_log( "⚠️ Cannot open file: $from_file" );
		continue;
	}
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		$詩組 = true;
	}

	while( ( $line = fgets( $handle ) ) !== false )
	{
		if( $詩組 )
		{
			if( !array_key_exists( $頁, $副題 ) )
			{
				$副題[ $頁 ] = array();
			}
			
			$行++;
			if( in_array( 
				intval( $行 ), $詩組_詩題[ $頁 ][ 1 ] ) )
			{
				$首++;
			}
			
			if( $首 == 0 )
			{
				$行碼template = "〚${頁}:${行}〛";
			}
			else
			{
				$行碼template = "〚${頁}:${首}:${行}〛";
			}
			
			if( in_array( 
				intval( $行 ), $詩組_詩題[ $頁 ][ 1 ] ) )
			{
				$副題[ $頁 ][ $行碼template ] = trim( $line );
			}
		}
		else
		{
			$行++;
			$行碼template = "〚${頁}:${行}〛";
		}

		$line = trim( $line );
		$行碼_詩文[ $頁 ][ $行碼template ] = trim( $line );
		
		if( $行碼template != "〚${頁}:1〛" && // not 詩題
			( !array_key_exists( $頁, $副題 ) ||
				!in_array( $行碼template, $副題[ $頁 ] ) 
			) &&
			$line != ''
		)
		{
			$句s = explode( '。', normalize( $line ) );
			//print_r( count( $句s ) );
			
			for( $i = 0; $i<count( $句s ); $i++ )
			{
				if( !array_key_exists( $頁, $詩句 ) )
				{
					$詩句[ $頁 ] = array();
				}
				if( mb_strlen( $句s[ $i ] ) > 0 )
				{
					//$句 = $i + 1;
					$句碼 = 
						str_replace(
							'〛', 
							'.' . $i + 1 . '〛' ,  
							$行碼template );
					//echo $句碼, NL;
					$詩句[ $頁 ][ $句碼 ] = $句s[ $i ];
					
					if( !array_key_exists( 
						$句s[ $i ], $詩句[ $頁 ] ) )
					{
						$詩句[ $句s[ $i ] ] = array();
					}
					array_push( $詩句[ $句s[ $i ] ], $句碼 );
					
					for( $j = 0; $j < mb_strlen( $句s[ $i ] ); $j++ )
					{
						if( !array_key_exists( $頁, $詩字 ) )
						{
							$詩字[ $頁 ] = array();
						}
						$字碼 = 
							str_replace(
								'〛', 
								'.' . $j + 1 .
								'〛' ,  
							$句碼 );
						$詩字[ $頁 ][ $字碼 ] =
							mb_substr( $句s[ $i ], $j, 1 );
							
						if( !array_key_exists( 
						mb_substr( $句s[ $i ], $j, 1 ), $詩字 ) )
					{
						$詩字[ mb_substr( $句s[ $i ], $j, 1 ) ] = array();
					}
					array_push( $詩字[ mb_substr( $句s[ $i ], $j, 1 ) ], $字碼 );

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

				}
			}
		}
	}

	fclose( $handle );
	
	//if( $頁 == '0013' )
		//break;
	
}
ksort( $詩句 );
ksort( $詩字 );
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
    $副題,
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
    $詩字,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"字碼_詩字.json",
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
?>