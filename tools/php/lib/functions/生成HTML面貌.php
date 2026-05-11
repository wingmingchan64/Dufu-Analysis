<?php
/*
 * 
 */
function 生成HTML面貌( array &$樹 ) : void
{
	foreach( $樹 as $k => $v )
	{
		if( is_string( $v ) )
		{
			// process 〈 〉
			$pos = mb_strpos( $v, '〈' );
			$first = '';
			
			if( $pos !== false )
			{
				if( $pos !== 0 )
				{
					$first = mb_substr( $v, 0, $pos );
				}
				
				$parts = explode( '〈', $v );
				$node_text = '';
				
				foreach( $parts as $part )
				{
					$part = rtrim( $part, '〉' );
					
					if( $part == $first )
					{
						continue;
					}
					else
					{
						[ $cat, $scope, $text ] = explode( '*', $part );
						
						if( $cat == '題解' )
						{
							$start_tag = '<p class="' . $cat . '">';
							$end_tag = '</p>';
							$node_text .= $start_tag . $text . $end_tag;
						}
						elseif( $cat == '眉批' )
						{
							$start_tag = '<td class="' . $cat . '">';
							$end_tag = '</td>';
							$node_text .= $start_tag . $text . $end_tag;
						}
						else
						{
							$start_tag = '<span class="' . $cat . '">';
							$end_tag = '</span>';$node_text .= $start_tag . $text . $end_tag;
						}
					}
					
					//$樹[ $k ] = $樹[ $k ] . $text;
				}
				$樹[ $k ] = $first . $node_text;
			}
		}
		else
		{
			生成HTML面貌( $樹[ $k ] );
		}
	}
}
?>