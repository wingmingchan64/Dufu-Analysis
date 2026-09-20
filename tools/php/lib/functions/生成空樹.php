<?php
function 生成空樹(
	string $文檔碼,
	string $題,
	array $樹骨架
): array
{
	$樹 = array();
	$樹[ $文檔碼 ][ 篇名 ] = $題;
	$段數 = count( $樹骨架 ) - 1;
	$行_num = 3; // 第一段開始的行碼，一定是 3

	foreach( range( 1, $段數 ) as $段碼 )
	{
		$行數 = count( $樹骨架[ $段碼 ] );
		
		// $行碼:樹骨架中、段中的$行數
		foreach( range( 1, $行數 ) as $行碼 )
		{
			$樹[ $文檔碼 ][ $段碼 ][ $行_num ] = array();
			$句數 = count( $樹骨架[ $段碼 ][ $行碼 - 1 ] );
			
			foreach( range( 1, $句數 ) as $句碼 )
			{
				$樹[ $文檔碼 ][ "${段碼}" ][ $行_num ]
					[ "${句碼}" ] = array();
				$字數 = 
					$樹骨架[ $段碼 ][ $行碼 - 1 ][ $句碼 - 1 ];

				foreach( range( 1, $字數 ) as $字碼 )
				{
					$樹[ $文檔碼 ][ "${段碼}" ][ $行_num ]
						[ "${句碼}" ][ "${字碼}" ] = '';
				}
			}
			$行_num++;
		}
		$行_num++;
	}

	return $樹;
}

function create_empty_tree(
	string $文檔碼,
	string $題,
	array $樹骨架
): array
{
	return 生成空樹( $文檔碼, $題, $樹骨架 );
}
?>