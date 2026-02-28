<?php
/*
 *
 */
function 提取詩文坐標( string $詩文, bool $debug=false ) : array
{
	$詩文 = 修復文字( $詩文 );
	$字數 = mb_strlen( $詩文 );
	$結構 = 提取數據結構( 數字對照陣列[ $字數 ] );
	
	if( array_key_exists( $詩文, $結構 ) )
	{
		return $結構[ $詩文 ];
	}
	throw new InvalidPoemFragmentException(
		"杜甫詩中無「${詩文}」。" );
}

function get_poem_fragment_coords(
	string $詩文, bool $debug=false ) : array
{
	return 提取詩文坐標( $詩文, $debug );
}
?>