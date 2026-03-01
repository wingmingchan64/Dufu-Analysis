<?php
/*
 * 以詩碼坐標，提取詩陣列。
 */
function 提取詩陣列( string $坐標, bool $debug=false ) : array
{
	if( !是詩碼坐標( $坐標 ) )
	{
		throw new InvalidCoordinateException( "詩碼坐標中，無坐標「${坐標}」。" );
	}
	$file_name = rtrim( 
		str_replace( ':', '-',
		str_replace( '〚', '',
		str_replace( '〛', '', $坐標 ) ) ), '-' );
	
	$詩陣列路徑 = dirname( __DIR__, 4 ) . DS . 
		SCHEMAS_JSON_BASE_TEXT_DIR . $file_name . '.json';

	if( file_exists( $詩陣列路徑 ) )
	{
		$contents = file_get_contents( $詩陣列路徑 );
		$詩陣列 = json_decode( $contents, true );
		return $詩陣列;
	}
	else
	{
		throw new InvalidCoordinateException( "詩碼坐標中，無此坐標。" );
	}
}

function get_poem_array( string $坐標, bool $debug=false ) : array
{
	return 提取詩陣列( $坐標, $debug );
}
?>