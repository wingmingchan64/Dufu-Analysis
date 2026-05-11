<?php
/*
 * 提取詩文片段的唯一路徑。
 */
use Dufu\Exceptions\DufuException;
use Dufu\Exceptions\DocumentIDNotFoundException;
use Dufu\Exceptions\PoemFragmentNotFoundException;

function 提取詩文唯一路徑( 
	string $默文檔碼, 
	string $詩文, 
	bool $debug=false ) : string
{
	$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

	if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
	{
		throw new DocumentIDNotFoundException( "文檔碼「${默文檔碼}」不存在。" );
	}

	$詩文 = 修復文字( $詩文 );
	$字數 = mb_strlen( $詩文 );
	$結構 = 提取數據結構( 數字對照陣列[ $字數 ] );
	
	if( array_key_exists( $詩文, $結構 ) )
	{
		$坐標s = $結構[ $詩文 ];
		$result = array();
		
		foreach( $坐標s as $標 )
		{
			//echo $標, NL;
			//echo mb_substr( $標, 1, 4 ), NL;
			
			if( mb_substr( $標, 1, 4 ) == $默文檔碼 )
			{
				//echo $標, NL;
				$路徑 = explode( '.',
					str_replace( ':', '.',
					rtrim( ltrim( $標, '〚' ), '〛' ) ) );
				array_push( $result, implode( ',', $路徑 ) );
			}
		}
		
		//print_r( $result );
		if( count( $result ) == 0 )
		{
			throw new DufuException( "${默文檔碼}中沒有「${詩文}」。" );
		}
		elseif( count( $result ) > 1 )
		{
			throw new DufuException( "「${詩文}」路徑多於一條。" );
		}
		return $result[ 0 ];
	}
	throw new PoemFragmentNotFoundException(
		"杜甫詩中無「${詩文}」。" );
}

function get_unique_path_of_fragment(
	string $默文檔碼,
	string $詩文, 
	bool $debug=false ) : string
{
	return 提取詩文唯一路徑( $默文檔碼, $詩文, $debug );
}
?>