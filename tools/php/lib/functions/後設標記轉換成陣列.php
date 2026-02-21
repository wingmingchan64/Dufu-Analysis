<?php
/*
 *
 */
function 後設標記轉換成陣列(
	string $簡稱, // 郭, 全
	string $版本詩碼, // 0001, 0465-1
	int $行, // 1, 2, 3, etc
	string $後設標記,
	string $文字 = '' ) : array
{
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new InvalidAnchorValueException( "簡稱「${簡稱}」不存在。" );
	}
	
	$書名 = $書目簡稱[ $簡稱 ];
	$目錄路徑 = dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . 'catalog' . DS .
		"${簡稱}詩碼_默詩碼.json";

	if( !file_exists( $目錄路徑 ) )
	{
		throw new InvalidAnchorValueException( "目錄「${目錄路徑}」不存在。" );
	}
	$版本詩碼_默詩碼 = json_decode( 
		file_get_contents( $目錄路徑 ), true );
	$版文檔碼 = substr( $版本詩碼, 0, 4 );
	
	$默詩碼 = $版本詩碼_默詩碼[ $版本詩碼 ];
	$默文檔碼 = substr( $默詩碼, 0, 4 );
	$完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 )[ $默文檔碼 ];
	$非完整坐標表 = 提取數據結構( 非完整坐標表 );
	$詩文組合 = 提取數據結構( 詩文組合 );
	$後設陣列 = json_decode( $後設標記, true );
	
	$後設陣列[ 'doc_id' ] = $簡稱 . $版文檔碼 . '.' . $行;
	
	if( $文字 != '' )
	{
		$後設陣列[ 't' ] = $文字;
	}
	
	if( array_key_exists( 'a', $後設陣列 ) )
	{
		$錨値 = $後設陣列[ 'a' ];
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
		// 非完整坐標表，補文檔碼
		elseif( in_array( $錨値, $非完整坐標表 ) )
		{
			$完整坐標 = 生成完整坐標( $錨値, $默文檔碼 );
			
			if( 是合法完整坐標( $完整坐標 ) )
			{
				$錨値 = $完整坐標;
			}
			else
			{
				throw new InvalidAnchorValueException( "「${完整坐標}」不合法。" );
			}
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
		$後設陣列[ 'a' ] = $錨値;
	}

	return $後設陣列;
}
?>