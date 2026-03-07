<?php
/*
 * 處理 .txt 中的〘〙標記。
 */
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\InvalidAnchorValueException;

function 處理後設標記(
	string $簡稱, // 郭, 全
	string $版文檔碼, // 0001, 0098
	string $版本名稱 = '',
	bool $插入文字 = true,
	bool $存檔 = false
 ) : void
{
	$counter = 1;
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new InvalidAnchorValueException( "簡稱「${簡稱}」不存在。" );
	}
	
	$書名 = $書目簡稱[ $簡稱 ];
	
	if( $版本名稱 != '' )
	{
		$版本名稱 .= DS;
	}
	
	$文檔路徑 =  杜甫文件夾 . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . "${版文檔碼}.txt";
		
	if( !file_exists( $文檔路徑 ) )
	{
		throw new InvalidAnchorValueException( "${版文檔碼}.txt 不存在。" );
	}

	$file = trim( file_get_contents( $文檔路徑 ) );
	$lines = explode( NL, $file );
	$文檔碼_後設標記 = array();
	$單元ID = $簡稱 . $版文檔碼; // 郭0001
	$後設標記陣列 = array();
	
	foreach( $lines as $line )
	{
		$parts = explode( '〘', $line );
		$文字 = $parts[ 0 ];
		$後設標記 = rtrim( $parts[ 1 ], '〙' );
		$後設標記 = json_decode( $後設標記, true );
		$後設標記[ 單元ID ] = $單元ID;
		$後設標記[ 'aid' ] = $單元ID . '@' . $後設標記[ 'anchor' ];
		$後設標記[ 'rid' ] = make_sid( 
			$單元ID, $後設標記[ CAT ], $文字, $後設標記[ 'anchor' ] );
		$後設標記[ 't' ] = $文字;
		$後設標記[ 'pos' ] = $counter;
		$後設標記陣列[] = $後設標記;
		$counter++;
	}
	
	// make sure that P0005L09 are well-formed
	檢查注anchor( $後設標記陣列 );
	
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new AbbreviationNotFoundException( "簡稱「${簡稱}」不存在。" );
	}
	
	$版文檔碼_默文檔碼 = 提取目錄( trim( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_默文檔碼" ) );
	$版詩碼_默詩碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}詩碼_默詩碼" );
	$默文檔碼 = $版文檔碼_默文檔碼[ $版文檔碼 ][ 0 ];
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );
	$詩文組合 = 提取數據結構( 詩文組合 );
	$錨種類 = array( 'a', 'b_a' );
	
	for( $i=0; $i<sizeof( $後設標記陣列 ); $i++ )
	{
		foreach( $錨種類 as $錨 )
		{
			if( !array_key_exists( $錨, $後設標記陣列[ $i ] ) )
			{
				continue;
			}
			
			$錨値 = $後設標記陣列[ $i ][ $錨 ];
			// 詩題、序言
			if( $錨値 == '1' || $錨値 == '3' )
			{
				$行 = $錨値;
				$錨値 = "〚${默文檔碼}:${行}〛";
			}
			// 完整坐標
			elseif( 是完整坐標( $錨値 ) && 是合法完整坐標( $錨値 ) )
			{
				$錨値 = $錨値;
			}
			// 文字
			else
			{
				if( in_array( $錨値, $詩文組合 ) )
				{
					$坐標s = 提取文檔碼詩文坐標( $默文檔碼, $錨値 );
					
					if( sizeof( $坐標s ) == 1 )
					{
						$錨値 = $坐標s[ 0 ];
					}
					else
					{
						throw new InvalidAnchorValueException( 
							"錨値「${錨値}」不合法。" );
					}
				}
			}
			$後設標記陣列[ $i ][ $錨 ] = $錨値;
		}
	}
	
	if( $存檔 )
	{
		//$temp = array();
		/*
		foreach( $文檔碼_後設標記[ $單元ID ] as $record )
		{
			if( !array_key_exists( $單元ID, $temp ) )
			{
				$temp[ $單元ID ] = array();
			}
			array_push( $temp[ $單元ID ], $record );
		}
		*/
		
		// write back to file
		$json = json_encode(
			$後設標記陣列,
			JSON_UNESCAPED_UNICODE
		);
		file_put_contents(
			dirname( __DIR__, 4 ) . DS .
			PACKAGES_DIR .
			$書名 . DS .
			'metadata' . DS .
			'by_doc_id' . DS .
			$版文檔碼 . '.json', $json . PHP_EOL );
	}
	else
	{
		//return $文檔碼_後設標記;
	}
}

function process_metadata_markers(
	string $簡稱, // 郭, 全
	string $版本詩碼, // 0001, 0465-1
	string $版本名稱 = '',
	bool $插入文字 = true,
	bool $存檔 = false
 ) : mixed
{
	return 處理後設標記( $簡稱, $版本詩碼, $版本名稱, $插入文字, $存檔 );
}

function 檢查注anchor( array $後設標記陣列 ) : void
{
	$current =  0;
	
	foreach( $後設標記陣列 as $item )
	{
		if( $item[ CAT ] == '注' )
		{
			$aid = $item[ 'anchor' ];
			$parts = explode( 'L', $aid );
			$new = intval( ltrim( $parts[ 0 ], 'P' ) ) * 100 +
				intval( $parts[ 1 ] );
			
			if( $new >= $current )
			{
				$current = $new;
			}
			else
			{
				throw new RuntimeException( "Out of order" );
			}
		}
	}
}

/*
function 處理a_b_a( 
	string $簡稱, 
	string $版文檔碼,
	array &$後設標記陣列 ) : void
{
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new AbbreviationNotFoundException( "簡稱「${簡稱}」不存在。" );
	}
	
	$書名 = $書目簡稱[ $簡稱 ];		
	$版文檔碼_默文檔碼 = 提取目錄( trim( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_默文檔碼" ) );
	$版詩碼_默詩碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}詩碼_默詩碼" );
	$默文檔碼 = $版文檔碼_默文檔碼[ $版文檔碼 ][ 0 ];
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );
	$詩文組合 = 提取數據結構( 詩文組合 );
	$錨種類 = array( 'a', 'b_a' );
	
	foreach( $後設標記陣列 as $item )
	{
		foreach( $錨種類 as $錨 )
		{
			if( !array_key_exists( $錨, $item ) )
			{
				continue;
			}
			$錨値 = $item[ $錨 ];
			// 詩題、序言
			if( $錨値 == '1' || $錨値 == '3' )
			{
				$行 = $錨値;
				$錨値 = "〚${默文檔碼}:${行}〛";
			}
			// 完整坐標
			elseif( 是完整坐標( $錨値 ) && 是合法完整坐標( $錨値 ) )
			{
				$錨値 = $錨値;
			}
			// 文字
			else
			{
				if( in_array( $錨値, $詩文組合 ) )
				{
					//echo $錨値, NL;
					// 詩文 => 坐標
					$坐標s = 提取文檔碼詩文坐標( $默文檔碼, $錨値 );
					//print_r( $坐標s );
					
					if( sizeof( $坐標s ) == 1 )
					{
						$錨値 = $坐標s[ 0 ];
					}
					else
					{
						throw new InvalidAnchorValueException( 
							"錨値「${錨値}」不合法。" );
					}
				}
			}
			$item[ $錨 ] = $錨値;
			//print_r( $item[ $錨 ] );
		}
	}
}
*/
?>