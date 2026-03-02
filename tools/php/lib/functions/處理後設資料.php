<?php
/*
 *
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
	$異_mm_id_a = array();
	$注_mm_id_b_a = array();
	$評_mm_id_b_a = array();
	$永明校記_mm_id_b_a = array();
	$永明按語_mm_id_b_a = array();
	$mm_id_texts = array();
	
	foreach( $後設資料[ $簡稱 . $版文檔碼 ] as $item )
	{
		$mm_id_texts[ $item[ MM_ID ] ] = $item[ T ];
		
		if( $item[ CAT ] == '異' )
		{
			$異_mm_id_a[ $item[ MM_ID ] ] = $item[ A ];
		}
		elseif( $item[ CAT ] == '永明按語' || 
			$item[ CAT ] == '永明校記' )
		{
			$陣列名 = $item[ CAT ] . '_mm_id_b_a';
			$$陣列名[] = $item[ MM_ID ];
		}
		// 注、評
		else
		{
			$陣列名 = $item[ CAT ] . '_mm_id_b_a';
			if( !array_key_exists( $item[ B_A ], $$陣列名 ) )
			{
				$$陣列名[ $item[ B_A ] ] = array();
			}
			$$陣列名[ $item[ B_A ] ][] = $item[ MM_ID ];
		}
	}
	
	// store the texts
	$json = json_encode(
		$mm_id_texts,
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
	$doc_id_異[ $版文檔碼 ] = $異_mm_id_a;
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
	if( !empty( $doc_id_注 ) )
	{
		$doc_id_注 = 提取後設資料(
			$書名 . DS . METADATA_DIR . 'doc_id_注' );
		$doc_id_注[ $版文檔碼 ] = $注_mm_id_b_a;
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
	}
	// 評
	if( !empty( $doc_id_評 ) )
	{
		$doc_id_評 = 提取後設資料(
			$書名 . DS . METADATA_DIR . 'doc_id_評' );
		$doc_id_評[ $版文檔碼 ] = $評_mm_id_b_a;
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
	}
	// 永明校記
	if( !empty( $doc_id_永明校記 ) )
	{
		$doc_id_永明校記 = 提取後設資料(
			$書名 . DS . METADATA_DIR . 'doc_id_永明校記' );
		$doc_id_永明校記[ $版文檔碼 ] = $永明校記_mm_id_b_a;
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
	}
	// 永明按語
	if( !empty( $doc_id_永明校記 ) )
	{
		$doc_id_永明按語 = 提取後設資料(
			$書名 . DS . METADATA_DIR . 'doc_id_永明按語' );
		$doc_id_永明按語[ $版文檔碼 ] = $永明按語_mm_id_b_a;
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
	}
	
/*
	$mm_id = 提取後設資料(
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 'by_doc_id' . DS . $版文檔碼 );
	// renew contents
	$doc_id_l_id[ $doc_id ] = array();
	
	$doc_l_id_tags = 提取後設資料(
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 'mapping' . DS . 'doc_l_id_tags' );
	// renew contents
	$doc_l_id_tags[ $doc_id ] = array();
	
	$doc_l_id_texts = array();
	$b_a_doc_l_id = array();
	$b_a_to_keep = array( '注', '評' );
	
	foreach( $後設資料[ $doc_id ] as $entry )
	{
		//echo $entry[ 後設資料行ID ], NL;
		//array_push( $doc_id_l_id[ $doc_id ], 
			//$entry[ 後設標記ID ] );
		//unset( $entry[ 後設資料行ID ] );
		
		//$doc_l_id_tags[ $doc_id ][ $entry[ 後設資料行ID ] ] = $entry;
		//$doc_l_id_texts[ $entry[ 後設資料行ID ] ] = 
			$entry[ 't' ];
			
		if( array_key_exists( 'b_a', $entry ) )
		{
			$坐標 = $entry[ 'b_a' ];
			
			if( $坐標 != '' && in_array( $entry[ 'cat' ], $b_a_to_keep ) )
			{
				if( !array_key_exists( $坐標, $b_a_doc_l_id ) )
				{
					$b_a_doc_l_id[ $坐標 ] = array();
				}
				array_push( $b_a_doc_l_id[ $坐標 ], $entry[ 後設標記ID ] );
			}
		}
		$cat = $entry[ 'cat' ];
		$varname = $cat . '_doc_ids';
		
		
		if( !array_key_exists( $doc_id, $$varname ) )
		{
			$$varname[ $doc_id ] = array();
		}
		
		array_push( $$varname[ $doc_id ], $entry[ 後設標記ID ] );
		
	}
	//print_r( $doc_l_id_texts );
	
	$json = json_encode(
		$doc_id_l_id,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 
		'mapping' . DS .
		"doc_id_l_id.json",
		$json . PHP_EOL );

	$json = json_encode(
		$doc_l_id_texts,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);
	

	$json = json_encode(
		$doc_l_id_tags,
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
	);

	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 
		'mapping' . DS .
		"doc_l_id_tags.json",
		$json . PHP_EOL );
	//$異_doc_ids
*/
	
	
	return true;
}
?>