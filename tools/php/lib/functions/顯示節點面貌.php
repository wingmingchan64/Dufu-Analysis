<?php
/*
 *
 */
function 顯示節點面貌( 
	array $tree, string $path, string $msg = '' ) : void
{
	if( strpos( $path, '-' ) !== false )
	{
		echo "路徑不能有範圍標記。", NL;
		return;
	}
	
	$路徑陣列 = explode( ',', $path );
	$pointer = $tree;
	
	foreach( $路徑陣列 as $node )
	{
		$pointer = $pointer[ $node ];
	}
	
	print_r( $pointer );
}
?>