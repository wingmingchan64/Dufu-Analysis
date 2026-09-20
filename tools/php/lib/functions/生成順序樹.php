<?php
function 生成順序樹( string $文字塊 ) : array
{
	$順序樹 = array();
	
	for( $i = 0; $i < mb_strlen( $文字塊 ); $i++ )
	{
		$碼 = $i + 1;
		$順序樹[ "$碼" ] = mb_substr( $文字塊, $i, 1 );
	}
	return $順序樹;
}

function create_char_order_tree( string $文字塊 ) : array
{
	return 生成順序樹( $文字塊 );
}
?>