<?php
/*
 * 攤平一後設資料樹，記錄所有路徑。
 * 因此函式爲遞歸函式，$path 必須在外。
 */
function record_mtree_paths(
	array $m_tree, string $parent='' ) : void
{
	global $paths;
	
	foreach( $m_tree as $k => $v )
	{
		if( is_string( $v ) )
		{
			$paths[] = $parent . '_' . $k . '_' . $v;
		}
		else
		{
			if( $parent == '' )
			{
				record_mtree_paths( $m_tree[ $k ], $k );
			}
			else{
				record_mtree_paths( $m_tree[ $k ], 
					$parent . '_' . $k );
			}
		}
	}
}

function 記錄後設資料樹路徑( 
	array $m_tree, string $parent='' ) : void
{
	record_mtree_paths( $m_tree, $parent );
}
?>