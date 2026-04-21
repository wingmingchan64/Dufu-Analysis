<?php
/*
 * breadth-first, only complete trees
 */
use Dufu\Exceptions\DocumentIDNotFoundException;

function add_anchors( 
	array &$tree ) : void
{
	//print_r( $tree );

	$文檔碼 = array_keys( $tree )[ 0 ];
	//echo $文檔碼, NL;
	
	if( 是合法文檔碼( $文檔碼 ) )
	{
		$temp = $tree;
		$tree = [];
		$tree[ $文檔碼 ] = $temp[ $文檔碼 ];
		$tree[ 'a' ] = '';
		$path = [];
		$temp_pointer = &$tree[ $文檔碼 ];
		$是組詩 = 是組詩( $文檔碼 );
		$path[] = $文檔碼;
				
		if( $是組詩 )
		{
			添加子錨( 
				$tree, 
				$path,
				count( array_keys( $tree ) ) + 1 );
				
			foreach( $temp_pointer as $k => $v )
			{
				if( !is_array( $v ) )
				{
					continue;
				}
				$pos = count( array_keys( $v ) );
				$path[] = $k;
				添加子錨( 
					$tree, 
					$path,
					$pos );
				array_pop( $path );
			}
			foreach( $temp_pointer as $k => $v )
			{
				if( !is_array( $v ) )
				{
					continue;
				}
				$path[] = $k;
				$temp_temp_pointer = $temp_pointer[ $k ];
				
				
				foreach( $temp_temp_pointer as $k1 => $v1 )
				{
					if( !is_array( $v1 ) )
					{
						continue;
					}
					
					$pos = count( array_keys( $v1 ) );
					$path[] = $k1;
					
					添加子錨( 
						$tree, 
						$path,
						$pos );
					array_pop( $path );
					
				}
				array_pop( $path );
			}
		}
		else
		{
			$pos = count( array_keys( $temp_pointer ) );
			
			添加子錨( 
				$tree, 
				$path,
				$pos );
				
			foreach( $temp_pointer as $k => $v )
			{
				if( !is_array( $v ) )
				{
					continue;
				}
				$pos = count( array_keys( $v ) );
				$path[] = $k;
				添加子錨( 
					$tree, 
					$path,
					$pos );
				array_pop( $path );
			}
		}
		
		// 詩題
		$詩題 = $tree[ $文檔碼 ][ 詩題 ];
		$tree[ $文檔碼 ][ 詩題 ] = array( $詩題, '' );

	}
	else
	{
		throw new DocumentIDNotFoundException(
			"文檔碼「${文檔碼}」不存在。" );
	}
}

function 添加錨( 
	array &$tree, array &$path=null ) : void
{
	add_anchors( $tree );
}
function 添加子錨( array &$tree, array $path, int $pos ) : void
{
	add_node( $tree, $path, $pos, array( 'a' => '' ) );
}
?>