<?php
/*
 * 以詩碼提取基準正文樹。
 * 例：提取基準正文樹( '0013-1' )，回傳《題張氏隱居二首》其一
 */
function 提取詩碼基準正文樹( string $詩碼, bool $debug=false ) : array
{
	if( !是默認版本詩碼( $詩碼 ) )
	{
		throw new InvalidPoemIDException( "詩碼「${詩碼}不存在。」" );
	}
	
	return 提取數據結構( BASE_TEXT_DIR . $詩碼 );
}

function ( string $詩碼, bool $debug=false ) : array
{
	return 提取詩碼基準正文樹( $詩碼 );
}
?>