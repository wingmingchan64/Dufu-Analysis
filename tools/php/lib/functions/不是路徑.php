<?php
/*
 * 
 */
function 不是路徑( string $str ) : bool
{
	//echo '路徑:' . $str, NL;
	$result = ( strpos( $str, ',' ) === false );
	
	if( $result )
	{
		echo $str, NL;
	}
	return $result;
}
?>