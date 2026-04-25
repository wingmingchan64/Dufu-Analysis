<?php
/*
 * 
 */
function 規範化(
	string $text,
	bool $removeSpace = false,
	bool $removeNewline = false,
	bool $removePunctuation = false ) : string
{
	return normalize( $text, $removeSpace, $removeNewline, $removePunctuation );
}

function normalize(
	string $text,
	bool $removeSpace = false,
	bool $removeNewline = false,
	bool $removePunctuation = false ) : string
{
	$to_delete = array(
		"”","“",
		"‘","’",
		"《", "》",
		"〈","〉",
		"「","」",
		"『","』",
		//"·",
		"……",
		"——",
/*
		"其一", 
		"其二", 
		"其三", 
		"其四", 
		"其五", 
		"其六", 
		"其七", 
		"其八", 
		"其九", 
		"其十", 
		"其十一",
		"其十二",
		"其十三",
		"其十四",
		"其十五",
		"其十六",
		"其十七",
		"其十八",
		"其十九",
		"其二十"
*/
	);
	$to_replace = array(
		"？",
		"，",
		"！",
		"：",
		"；",
		"、"
	);
	
	if( $removeSpace )
	{
		$text = str_replace( " ", "", $text );
	}
	
	if( $removeNewline )
	{
		$text = str_replace( "\r\n", "", $text );
	}
		
	foreach( $to_delete as $item )
	{
		$text = str_replace( $item, '', $text );
	}
	
	foreach( $to_replace as $item )
	{
		$text = str_replace( $item, '。', $text );
	}
	
	$text = preg_replace( '/[\d]+ [\P{M}]+?\n/', "", $text );
	
	if( $removePunctuation )
	{
		$text = str_replace( "。", "", $text );
	}
	//echo $text;
	return $text;
}
?>