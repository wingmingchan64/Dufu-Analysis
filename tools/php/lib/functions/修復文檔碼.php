<?php
/*
 * 把不完整文檔碼改成完整文檔碼。 此函式不負責審核文檔碼是否合法。
 */
function 修復文檔碼( string $num, bool $debug=false ) : string
{
	if( intval( $num ) === 0 )
	{
		throw new InvalidDocumentIDException(
			"文檔碼「${num}」不存在。」" );
	}	
	
	// 詩碼中可能有 - 號，- 之前的數字爲文檔碼
	$pos = strpos( $num, '-' );
	$first = '';
	$second = '';
	
	if( $pos !== false )
	{
		$parts = explode( '-', $num );
		$first = $parts[ 0 ]; // 文檔碼
		$second = $parts[ 1 ]; // 首碼
	}
	else
	{
		$first = $num;
	}
	
	if( intval( $first ) > 0 )
	{
		// 文檔碼必須爲四位數字
		$first = str_pad( $first, 4, 0, STR_PAD_LEFT );
		
		if( $second != '' & intval( $second ) > 0 )
		{
			return $first . '-' . $second; // 文檔碼-首碼
		}
		else
		{
			return $first;
		}
	}
	
	throw new InvalidDocumentIDException(
		"文檔碼「${num}」不存在。」" );
}

function fix_doc_id( string $num, bool $debug=false ) : string
{
	return 修復文檔碼( $num, $debug );
}
?>