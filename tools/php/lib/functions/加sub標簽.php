<?php
/*
 * 
 */
function 加sub標簽(
	string $文字,
	bool $debug=false ) : string
{
	$matches = array();
	$contents = $文字;
	$r = preg_match_all( 夾注regex, $文字, $matches );
	
	if( $r )
	{
		foreach( $matches[ 0 ] as $注 )
		{
			$contents = 
				str_replace( $注, "<sub>${注}</sub>", $contents );
		}
	}
	return $contents;
}
?>