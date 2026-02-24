<?php
/*
 * 把 array( '0003', '3' ) 轉換成 '〚0003:3〛'。
 * $路徑[0] 必須是文檔碼。
 * 完整坐標中，其中不會有範圍 - 標記。
 */
function 列陣路徑轉換成完整坐標( array $路徑 ) : string
{
	if( strlen( $路徑[ 0 ] ) != 4 ) // 文檔碼 XXXX
	{
		$路徑[ 0 ] = 修復文檔碼( $路徑[ 0 ] );
	}
	
	$size = sizeof( $路徑 );
	$文檔碼 = $路徑[ 0 ];
	$路徑[ 0 ] = '';
	
	if( !是默認文檔碼( $文檔碼 ) )
	{
		throw new InvalidPathException( "文檔碼「${文檔碼}」不存在。" );
	}
	
	if( 是組詩( $文檔碼 ) && $size > 1 ) // 文檔碼之後爲首
	{
		$首碼 = $路徑[ 1 ];
		$路徑[ 1 ] = '';
	}
	
	$路徑str = '';
	
	if( ( 是組詩( $文檔碼 ) && $size > 2 ) || 
		( !是組詩( $文檔碼 ) && $size > 1 ) )
	{
		$路徑str = ltrim( implode( '.', $路徑 ), '.' );
	}
	
	if( 是組詩( $文檔碼 ) )
	{
		$坐標template = "〚${文檔碼}:${首碼}:${路徑str}〛";
	}
	else
	{
		$坐標template = "〚${文檔碼}:${路徑str}〛";
	}
	
	if( 是合法完整坐標( $坐標template ) )
	{
		return $坐標template;
	}
	throw new InvalidCoordinateException(
		"坐標「${坐標template}」不存在。" );
}

function convert_array_path_to_complete_coords( array $路徑 ) : string
{
	return 列陣路徑轉換成完整坐標( $路徑 );
}
?>