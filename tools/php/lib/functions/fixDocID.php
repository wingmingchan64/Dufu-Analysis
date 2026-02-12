<?php
/*
 * 把不完整文檔碼改成完整文檔碼。 garbage in, garbage out
 */
function fixDocID( string $num ) : string
{
	$pos = strpos( $num, '-' );
	$first = '';
	$second = '';
	
	if( $pos !== false )
	{
		$parts = explode( '-', $num );
		$first = $parts[ 0 ];
		$second = $parts[ 1 ];
	}
	else
	{
		$first = $num;
	}
	
	if( intval( $first ) > 0 )
	{
		$first = str_pad( $first, 4, 0, STR_PAD_LEFT );
		
		if( $second != '' & intval( $second ) > 0 )
		{
			return $first . '-' . $second;
		}
	}
	return $num;
}
?>