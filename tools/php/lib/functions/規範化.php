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
	if( $removeSpace )
	{
		$text = str_replace( " ", "", $text );
	}
	if( $removeNewline )
	{
		$text = str_replace( "\n", "", $text );
	}
	$text = 
		str_replace( "？", "。", // use 。
		str_replace( "，", "。",
		str_replace( "！", "。",
		str_replace( "：", "。",
		str_replace( "；", "。",
		str_replace( "、", "。",
		str_replace( "《", "",   // remove these
		str_replace( "》", "",
		str_replace( "〈", "",
		str_replace( "〉", "",
		str_replace( "「", "",
		str_replace( "」", "",
		str_replace( "『", "",
		str_replace( "』", "",
		str_replace( "·", "",
		str_replace( "　", "",
		str_replace( "其一", "",
		str_replace( "其二", "",
		str_replace( "其三", "",
		str_replace( "其四", "",
		str_replace( "其五", "",
		str_replace( "其六", "",
		str_replace( "其七", "",
		str_replace( "其八", "",
		str_replace( "其九", "",
		str_replace( "其十", "",
		str_replace( "其十一", "",
		str_replace( "其十二", "",
		str_replace( "其十三", "",
		str_replace( "其十四", "",
		str_replace( "其十五", "",
		str_replace( "其十六", "",
		str_replace( "其十七", "",
		str_replace( "其十八", "",
		str_replace( "其十九", "",
		str_replace( "其二十", "", $text
			))))))))))))))))))))))))))))))))))));  
	$text = preg_replace( '/[\d]+ [\P{M}]+?\n/', "", $text );
	$text = preg_replace( '/[\s]+/', "", $text );
	
	if( $removePunctuation )
	{
		$text = str_replace( "。", "", $text );
	}
	//echo $text;
	return $text;
}
?>