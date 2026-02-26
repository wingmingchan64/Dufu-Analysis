<?php
/*
 * 處理 .txt 中的〘〙標記，
 */
function 處理路徑文字(
	array &$樹,
	array $路徑,
	string $文字,
	bool $插入=false,
	bool $debug=false
 ) : bool
{
	$路徑長度 = sizeof( $路徑 );
	$pointer = &$樹[ $路徑[ 0 ] ];
	//debug_echo( __FILE__, __LINE__, $路徑長度, $debug );
	
	// find the parent node of the char
	for( $i=1; $i<$路徑長度 - 1; $i++ )
	{
		//debug_print_r( __FILE__, __LINE__, $路徑, $debug );
		 $pointer = &$pointer[ $路徑[ $i ] ];
	}
	
	//debug_print_r( __FILE__, __LINE__, $樹, $debug );
	if( $插入 )
	{
		$pointer[ $路徑[ $路徑長度 - 1 ] ] = 
			$pointer[ $路徑[ $路徑長度 - 1 ] ] . $文字;
	}
	else
	{
		$pointer[ $路徑[ $路徑長度 - 1 ] ] = $文字;
	}

	return true;
}

function process_path_text(
	array $樹,
	array $路徑,
	string $文字,
	bool $插入=false,
	bool $debug=false
 ) : bool
{
	return 處理路徑文字( $樹, $路徑, $文字, $插入, $debug );
}
?>