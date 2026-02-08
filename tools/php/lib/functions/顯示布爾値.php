<?php
/*
 * 視乎 $bool 的布爾値，顯示 'true' 或 'false'。
 */
function 顯示布爾値( bool $input, string $msg = '' ) 
{
	if( $msg != '' )
	{
		echo $msg . ' ';
	}
	echo ( $input ? 'true' : 'false' ), NL;
}
?>