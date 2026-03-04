<?php
/*
 * Converts metadata JSON to an array of metadata.
 * Called by 處理後設資料.
 * partial $錨値: only 1 and 3 are allowed
 */
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\AbbreviationNotFoundException;

function 後設標記轉換成陣列(
	string $簡稱, // 郭, 全
	string $版文檔碼, // 0001, 0098
	string $頁行,
	string $後設標記,
	string $文字 = '', 
	bool $debug=false ) : array
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
	$後設陣列 = json_decode( $後設標記, true );
	$後設陣列[ 後設標記ID ] = 
		make_sid( $簡稱 . $版文檔碼, $後設陣列[ CAT ], $文字, $頁行 );
	
	if( $文字 != '' )
	{
		$後設陣列[ 't' ] = $文字;
	}
	
	$錨種類 = array( 'a', 'b_a' );
	
	foreach( $錨種類 as $錨 )
	{
		if( array_key_exists( $錨, $後設陣列 ) )
		{
			$錨値 = $後設陣列[ $錨 ];
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
					// 詩文 => 坐標
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
			$後設陣列[ $錨 ] = $錨値;
		}
	}

	return $後設陣列;
}

function convert_metadata_to_array(
	string $簡稱, // 郭, 全
	string $版本詩碼, // 0001, 0465-1
	int $行, // 1, 2, 3, etc
	string $後設標記,
	string $文字 = '', bool $debug=false ) : array
{
	return 後設標記轉換成陣列( $簡稱, $版本詩碼, $行, $後設標記, $文字, $debug );
}
?>