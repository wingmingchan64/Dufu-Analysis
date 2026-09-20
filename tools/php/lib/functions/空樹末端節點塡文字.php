<?php
/*
 * 把文字塊中的文字，塡入空樹中。
 * $文字塊
 * $空樹
 * $順序樹：記錄文字塊中文字的順序碼
 * $路徑_順序碼
 * $路徑：遞歸函式用以儲存單字的路徑
 * $位置：文字塊中，篇名之後第一個字的位置
 */
function 空樹末端節點塡文字(
	string $文字塊,
	array &$空樹,
	array &$順序樹,
	array &$路徑_順序碼,
	string $路徑,
	array &$位置
) : void
{
	$keys = array_keys( $空樹 );
	
	foreach( $keys as $key )
	{
		// record the path
		$temp = ltrim( $路徑, ',' );
		
		if( $key == 篇名 )
		{
			$空樹[ $key ] = $空樹[ $key ]; // do nothing
			
			for( $i = 0; $i < mb_strlen( $空樹[ $key ] ); $i++ )
			{
				$順序 = '' . ( $i + 1 );
				$順序樹[ $順序 ] = 
					mb_substr( $空樹[ $key ], $i, 1 );
			}
		}
		elseif( is_array( $空樹[ $key ] ) )
		{
			空樹末端節點塡文字(
				$文字塊,
				$空樹[ $key ],
				$順序樹,
				$路徑_順序碼,				
				$temp . ',' . $key,
				$位置 );
		}
		else
		{
			$空樹[ $key ] = mb_substr( $文字塊, $位置[ 0 ], 1 );
			$順序 = '' . ( $位置[ 0 ] + 1 );
			$順序樹[ $順序 ] = $空樹[ $key ];
			$位置[ 0 ] = $位置[ 0 ] + 1;
			$路徑_順序碼[ ltrim( $路徑, ',' ) . ',' . $key ] = $位置[ 0 ];
		}
	}
}

function empty_tree_terminal_nodes_fill_data (
	string $文字塊,
	array &$空樹,
	array &$順序樹,
	array &$路徑_順序碼,
	string $路徑,
	array &$位置
) : void
{
	空樹末端節點塡文字( $文字塊,$空樹,$順序樹,$路徑_順序碼,$路徑,$位置 );
}
?>