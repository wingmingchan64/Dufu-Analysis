<?php
/*
 * 
 */
function 生成XML標簽(
	string $名, 
	array $attrs=null,
	bool $empty=false ) : array
{
	// empty element
	if( $empty )
	{
		return array( "<${名} />", '' );
	}
	
	// attributes
	$attributes = "";
	
	if( !is_null( $attrs ) )
	{
		foreach( $attrs as $name => $attr )
		{
			$name = trim( $name );
			$attr = trim( $attr );
			if( $name != '' && $attr != '' )
			{
				$attributes = 
					$attributes . " ${name}=\"${attr}\"";
			}
		}
	}
	
	// create start and end tags
	$start = "<${名}${attributes}>";
	$end = "</${名}>";
	
	return array( $start, $end );
}

function create_XML_tag( string $名, array $attrs=null ) : array
{
	return 生成XML標簽( $名, $attrs, $empty );
}
?>