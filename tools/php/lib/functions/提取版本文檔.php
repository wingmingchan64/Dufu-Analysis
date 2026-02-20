<?php
/*
 * 
 */
function 提取版本文檔(
	string $簡稱,
	string $版文檔碼, 
	bool $插入文字 = true ) : array
{
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	$書名 = $書目簡稱[ $簡稱 ];
	$版文檔碼_詩碼s = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_${簡稱}詩碼" );
	$版文檔碼_默文檔碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_默文檔碼" );
	$默文檔碼 = $版文檔碼_默文檔碼[ $版文檔碼 ][ 0 ];
	$版詩碼s = $版文檔碼_詩碼s[ $版文檔碼 ];
	$版詩碼_默詩碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}詩碼_默詩碼" );
	$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );
	$默認詩文檔碼_序言 = 提取數據結構( 默認詩文檔碼_序言 );
	
	//print_r( $版詩碼s );
	
	$後設資料 = 提取後設資料( $書名 . DS . 'metadata' . DS .
		'by_doc_id' . DS . $版文檔碼 );
	//print_r( $後設資料 );
	$資料 = $後設資料[ $簡稱 . $版文檔碼 ];
	//$temp = array();
	// retrieve base text
	$bt = array();
	$bt[ 詩題 ] = $默認詩文檔碼_詩題[ $默文檔碼 ];
	
	if( array_key_exists( $默文檔碼, $默認詩文檔碼_序言 ) )
	{
		$bt[ 序言 ] = $默認詩文檔碼_序言[ $默文檔碼 ];
	}
	
	foreach( $版詩碼s as $版詩碼 )
	{
		$默詩碼 = $版詩碼_默詩碼[ $版詩碼 ];
		$bt[ $默詩碼 ] =
			提取數據結構( BASE_TEXT_DIR . $默詩碼 );
	}
	//print_r( $bt );

	// $資料 per 文檔，not per 詩
	for( $i=0; $i<sizeof( $資料 ); $i++ )
	{
		$類別 = $資料[ $i ][ 'cat' ];
		$錨値 = $資料[ $i ][ 'a' ];
		$文字 = $資料[ $i ][ 't' ];
		//print_r( $資料[ $i ] );
		// the first record
		// 詩題、序言、詩文
		$regex = '/〚(\d{4}):([13])〛/u';
		$matches = array();
		//echo $資料[ $i ][ 'a' ], NL;
		$r = preg_match( $regex, $錨値, $matches );
		
		// 詩題
		if( $r && $matches[ 2 ] == '1' )
		{
			$bt[ 詩題 ] = $文字;
		}
		// 序言
		elseif( $r && $matches[ 2 ] == '3' )
		{
			$bt[ 序言 ] = $文字;
		}
		// 副題、詩文
		else
		{
			// 〚1376:1:7.1.5〛
			if( $類別 == '異' )
			{
				替換詩陣列文字( $bt, $錨値, $文字 );
			}
				
			//$b_text = $bt[ $默詩碼 ];
			//print_r( $b_text );
		}
	}

	return $bt;
}
?>