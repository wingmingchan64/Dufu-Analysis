<?php
/*
 * 檢查坐標是否完整（有文檔碼）；只檢查格式。
 * this function does not consult the complete list
 */
function 是完整坐標( string $str ) : bool
{
	// 必須有坐標括號
	if( mb_strpos( $str, '〚' ) === false ||
		mb_strpos( $str, '〛' ) === false
	)
	{
		return false;
	}
	
	// strip the brackets
	$str = str_replace( '〚', '', 
		str_replace( '〛', '', $str ) );
	$match = array();
	// 4 or 5 parts within 〚〛
	$regex1 = '/\d{4}:/u'; // 〚0003:〛
	$regex2 = '/\d{4}:\d+:/u'; // 〚0013:2:〛
	$regex3 = '/\d{4}:\d+(-\d+)?/u'; // 〚0003:3〛〚0003:3-5〛
	$regex4 = '/\d{4}:\d+:\d+(-\d+)?/u'; // 〚0013:2:11〛
	$regex5 = '/\d{4}:\d+\.\d/u'; // 〚0003:4.2〛
	$regex6 = '/\d{4}:\d+:\d+\.\d/u'; // 〚0013:2:11.1〛
	$regex7 = '/\d{4}:\d+\.\d.\d+(-\d+)?/u'; // 〚0003:5.1.2〛〚0003:5.1.2-4〛
	$regex8 = '/\d{4}:\d+:\d+\.\d.\d+(-\d+)?/u'; // 〚0013:2:11.2.5〛〚0013:2:11.2.1-3〛
	
	$r = preg_match( $regex1, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}

	$r = preg_match( $regex2, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex3, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex4, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex5, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex6, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex7, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}
	
	$r = preg_match( $regex8, $str, $match );
	
	if( $r && $match[ 0 ] == $str )
	{
		return true;
	}

	return false;
}

function is_complete_coords( string $str ) : bool
{
	return 是完整坐標( $str );
}
?>