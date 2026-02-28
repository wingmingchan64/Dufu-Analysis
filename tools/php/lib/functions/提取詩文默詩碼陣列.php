<?php
/*
 * 提取一組詩碼，每首詩中，都有「$詩文s」
 */
function 提取詩文默詩碼陣列( array $詩文s, bool $debug=false ) : array
{
	$temp1 = array();
	$temp2 = array();
	$temp3 = array();
	$result = array();
	$默詩碼 = array();
	
	foreach( $詩文s as $詩文 )
	{
		if( !array_key_exists( $詩文, $temp1 ) )
		{
			$temp1[ $詩文 ] = array();
			$temp2[ $詩文 ] = array();
			$result[ $詩文 ] = array();
		}
		$temp1[ $詩文 ] = 提取詩文坐標( $詩文 );
	}
	
	foreach( $temp1 as $文 => $標s )
	{
		foreach( $標s as $標 )
		{
			$文檔碼 = mb_substr( $標, 1, 4 );
			
			if( mb_strpos( $標, '〚' ) === false )
			{
				array_push( $result[ $文 ],  
					"杜甫詩中無「${文}」。" );
				return $result;
			}
			
			if( 是組詩( $文檔碼 ) )
			{
				array_push( $temp2[ $文 ], 提取詩碼( $標 ) );
			}
			else
			{
				array_push( $temp2[ $文 ], 提取文檔碼( $標 ) );
			}
		}
	}

	foreach( $詩文s as $詩文 )
	{
		array_push( $temp3, $temp2[ $詩文 ] );
	}

	if( sizeof( $temp3 ) == 1 )
	{
		return $temp3;
	}
	$dummy = array(); // fix the indexes
	return array_merge( 
		$dummy,
		array_unique( 
			array_intersect( ...$temp3 ) ) );
}

function get_array_of_poem_ids_containing_fragments(
	array $詩文s, bool $debug=false ) : array
{
	return 提取詩文默詩碼陣列( $詩文s );
}
?>