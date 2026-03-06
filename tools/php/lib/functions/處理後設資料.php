<?php
/*
 * 處理 .json
 */
function 處理後設資料(
	string $簡稱, // 郭, 全
	string $版文檔碼, // 0001, 0098
	string $版本名稱 = '',
 ) : bool
{
	$doc_id = $簡稱 . $版文檔碼;
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new InvalidAnchorValueException( "簡稱「${簡稱}」不存在。" );
	}
	
	$書名 = $書目簡稱[ $簡稱 ];
	$版文檔碼 = substr( $版文檔碼, 0, 4 );
	
	if( $版本名稱 != '' )
	{
		$版本名稱 .= DS;
	}
	
	// get metadata
	$文檔路徑 =
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 
		'by_doc_id' . DS .
		$版文檔碼;
	
	$後設資料 = 提取後設資料( $文檔路徑 );
	//print_r( $後設資料 );
	
	// store pieces in relevant arrays
	$異_sid_a = array();
	$注_sid_b_a = array();
	$評_sid_b_a = array();
	$永明校記_sid_b_a = array();
	$永明按語_sid_b_a = array();
	$sid_texts = array();
	
	foreach( $後設資料 as $item )
	{
		$sid_texts[ $item[ 'rid' ][ 'sid' ] ] = $item[ T ];
		
		if( $item[ CAT ] == '異' )
		{
			$異_sid_a[ $item[ 'rid' ][ 'sid' ] ] = $item[ A ];
		}
		elseif( $item[ CAT ] == '永明按語' || 
			$item[ CAT ] == '永明校記' )
		{
			$陣列名 = $item[ CAT ] . '_sid_b_a';
			$$陣列名[] = $item[ 'rid' ][ 'sid' ];
		}
		// 注、評
		else
		{
			$陣列名 = $item[ CAT ] . '_sid_b_a';
			//echo $陣列名, NL;
			
			if( !array_key_exists( $item[ B_A ], $$陣列名 ) )
			{
				$$陣列名[ $item[ B_A ] ] = array();
			}
			$$陣列名[ $item[ B_A ] ][] = $item[ 'rid' ][ 'sid' ];
			//print_r( $$陣列名 );
		}
	}
	
	// store the texts
	$json = json_encode(
		$sid_texts,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 
		'doc_id_texts' . DS .
		"${版文檔碼}.json",
		$json . PHP_EOL );
		
	// 異
	$doc_id_異 = 提取後設資料(
		$書名 . DS . METADATA_DIR . 'doc_id_異' );
	$doc_id_異[ $版文檔碼 ] = $異_sid_a;
	$json = json_encode(
		$doc_id_異,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);
	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS .
		"doc_id_異.json",
		$json . PHP_EOL );
		
	// 注
	$doc_id_注 = 提取後設資料(
		$書名 . DS . METADATA_DIR . 'doc_id_注' );
	$doc_id_注[ $版文檔碼 ] = $注_sid_b_a;
	$json = json_encode(
		$doc_id_注,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);
	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS .
		"doc_id_注.json",
		$json . PHP_EOL );
	// 評
	$doc_id_評 = 提取後設資料(
		$書名 . DS . METADATA_DIR . 'doc_id_評' );
	$doc_id_評[ $版文檔碼 ] = $評_sid_b_a;
	$json = json_encode(
		$doc_id_評,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);
	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS .
		"doc_id_評.json",
		$json . PHP_EOL );
	// 永明校記
	$doc_id_永明校記 = 提取後設資料(
		$書名 . DS . METADATA_DIR . 'doc_id_永明校記' );
	$doc_id_永明校記[ $版文檔碼 ] = $永明校記_sid_b_a;
	$json = json_encode(
		$doc_id_永明校記,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);
	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS .
		"doc_id_永明校記.json",
		$json . PHP_EOL );
	// 永明按語
	$doc_id_永明按語 = 提取後設資料(
		$書名 . DS . METADATA_DIR . 'doc_id_永明按語' );
	$doc_id_永明按語[ $版文檔碼 ] = $永明按語_sid_b_a;
	$json = json_encode(
		$doc_id_永明按語,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);
	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS .
		"doc_id_永明按語.json",
		$json . PHP_EOL );
	
	return true;
}
?>