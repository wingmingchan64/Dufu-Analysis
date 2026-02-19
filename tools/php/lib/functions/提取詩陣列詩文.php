<?php
/*
 * 
 */

function 提取詩陣列詩文(
	array $詩陣列,
	array &$store,
	bool $加句號 = true,
	bool $加新行 = true,
	bool $忽略副題 = false ) : bool
{
	foreach( $詩陣列 as $index => $子 )
	{
		if( $index == 詩題 || $index == 序言 )
		{
			array_push( $store, $子 );
		}
		else
		{
			$是組詩 = ( mb_strpos( $index, '-' ) !== false );
			
			if( $是組詩 )
			{
				$parts = explode( '-', $index );
				$路徑 = array( $index, $parts[ 0 ], $parts[ 1 ] );
				$ar = 提取路徑陣列( $詩陣列, $路徑 );
				
				//$keys = array_keys( $ar );
				//$keysize = sizeof( $keys );
				
				foreach( $ar as $k => $v )
				{
					if( is_string( $ar[ $k ] ) &&
						!$忽略副題 &&
						mb_strpos( $ar[ $k ], '其' ) === false )
					{
						array_push( $store, $ar[ $k ] );
					}
				}
				array_push( $store, 
					杜甫詩陣列首ToString( $ar ) );
					//echo 杜甫詩陣列首ToString( $ar ), NL;
			}
			// 非組詩
			else
			{
				
				
			}
		}
	}

	return true;
}
?>