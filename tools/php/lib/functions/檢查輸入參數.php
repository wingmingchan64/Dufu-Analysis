<?php
/*
 * 檢查輸入參數。
 */
function 檢查輸入參數( array $argv, int $num, string $msg )
{
	if( sizeof( $argv ) != $num )
	{
		echo $msg, NL;
		exit;
	}
}

function check_argv( array $argv, int $num, string $msg )
{
	檢查輸入參數( $argv, $num, $msg );
}
?>