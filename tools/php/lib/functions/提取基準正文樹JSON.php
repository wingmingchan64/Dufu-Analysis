<?php
/*
 * 以詩碼提取詩 JSON 樹。
 * 例：提取基準正文樹( '0013-1,5' )，回傳第五行
 */
function 提取基準正文樹JSON( string $路徑, bool $debug=false ) : string
{
	$路徑 = rtrim( $路徑, ',' );
	
	if( strpos( $路徑, ',' ) )
	{
		$路徑陣列 = explode( ',', $路徑 );
	}
	else
	{
		$路徑陣列 = array( $路徑 );
	}
	
	$詩碼 = $路徑陣列[ 0 ];
	// 提出來的樹沒有根，得補回去
	$樹根 = $路徑陣列[ sizeof( $路徑陣列 ) - 1 ];
	
	if( !是默認版本詩碼( $詩碼 ) )
	{
		throw new InvalidPoemIDException( "無詩碼「${詩碼}」。" );
	}
	
	$文檔碼 = substr( $詩碼, 0, 4 );
	$是組詩 = 是組詩( $文檔碼 );
	
	if( $是組詩 )
	{
		$首碼 = substr( $詩碼, 5 );
		//str_replace( '-', ':', $詩碼 )
		$路徑陣列[ 0 ] = $首碼;
		array_unshift( $路徑陣列, $文檔碼 );
	}
	
	$詩陣列路徑 = dirname( __DIR__, 4 ) . DS . 
		SCHEMAS_JSON_BASE_TEXT_DIR . $詩碼 . '.json';

	if( file_exists( $詩陣列路徑 ) )
	{
		$詩陣列 = json_decode(
			file_get_contents( $詩陣列路徑 ), true );
	}
	else
	{
		throw new InvalidPathException( "「${路徑}」不存在。" );
	}
	
	$樹[ $樹根 ] = 提取路徑陣列( $詩陣列, $路徑陣列 );
	$json = json_encode( $樹, JSON_UNESCAPED_UNICODE | 
		JSON_PRETTY_PRINT );

	return $json;
}
function get_base_text_tree_json( string $路徑, bool $debug=false ) : string
{
	return 提取基準正文樹JSON( $路徑, $debug );
}
?>