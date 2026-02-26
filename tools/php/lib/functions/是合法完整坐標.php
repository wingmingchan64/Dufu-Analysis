<?php
/*
 * this function consults the complete list
 * calls 是完整坐標
 * no exception thrown
 */ 
function 是合法完整坐標( string $坐標, bool $debug=false ) : bool
{
	if( !是完整坐標( $坐標 ) )
	{
		debug_echo( __FILE__, __LINE__, "不是完整坐標", $debug );
		return false;
	}
	
	try
	{
		$文檔碼 = mb_substr( $坐標, 1, 4 );
		
		if( 是默認文檔碼( $文檔碼 ) )
		{
			debug_echo( __FILE__, __LINE__, "文檔碼： $文檔碼", $debug );
			$完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 );
			return in_array( $坐標, $完整坐標表[ $文檔碼 ] );
		}
		else
		{
			return false;
		}
	}
	catch( ErrorException $e )
	{
		echo $e;
		return false;
	}
}

function is_legal_complete_coords( string $坐標 ) : bool
{
	return 是合法完整坐標( $坐標, $debug );
}
?>