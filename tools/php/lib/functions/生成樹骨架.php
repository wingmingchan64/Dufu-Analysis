<?php
/*
 * 生成樹骨架。
 * $文檔碼：默認文檔碼
 * $文檔內容
 * $樹骨架：空陣列
 */
function 生成樹骨架(
	string $文檔碼, 
	string $文檔內容,
	array &$樹骨架 ) : void
{
	$題 = 文賦篇名[$文檔碼];
	$paragraphs = explode( NL.NL, $文檔內容 );

	for( $i = 0; $i < count( $paragraphs ); $i++ )
	{
		if( $i == 0 )
		{
			$樹骨架[] = array( mb_strlen( $題 ) );
			continue;
		}
		else
		{
			// do nothing
		}
		
		$段陣列 = array();
		$行s = explode( NL, $paragraphs[ $i ] );
			
		foreach( $行s as $行 )
		{
			$行陣列 = array();
			$句s = explode( '。', $行 );
			
			foreach( $句s as $句 )
			{
				if( $句 == '' )
				{
					continue;
				}
				$行陣列[] = mb_strlen( $句 );
			}
			$段陣列[] = $行陣列;
		}
		$樹骨架[] = $段陣列;
	}
}

function create_tree_skeleton(
	string $文檔碼, 
	string $文檔內容,
	array &$樹骨架	) : string
{
	return 生成樹骨架( $文檔碼, $文檔內容, $樹骨架 );
}
?>