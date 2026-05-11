<?php
/*
 * 
 */
function 不是路徑( string $str ) : bool
{
	return ( strpos( $str, ',' ) === false );
}
?>