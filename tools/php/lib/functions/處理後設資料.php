<?php
/*
 *
 */
function 處理後設資料(
	string $簡稱, // 郭, 全
	string $版本詩碼, // 0001, 0098
	string $版本名稱 = '',
 ) : bool
{
	$doc_id = $簡稱 . $版本詩碼;
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new InvalidAnchorValueException( "簡稱「${簡稱}」不存在。" );
	}
	
	$書名 = $書目簡稱[ $簡稱 ];
	$版文檔碼 = substr( $版本詩碼, 0, 4 );
	
	if( $版本名稱 != '' )
	{
		$版本名稱 .= DS;
	}
	
	$文檔路徑 =
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 
		'by_doc_id' . DS .
		$版文檔碼;
	
	$後設資料 = 提取後設資料( $文檔路徑 );
	//print_r( $後設資料 );
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
	$異_doc_ids = array();
	$注_doc_ids = array();
	$評_doc_ids = array();
	$永明校記_doc_ids = array();
	$永明按語_doc_ids = array();
	$b_a_doc_l_id = array();
	$b_a_to_keep = array( '注', '評' );
*/	
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
		
		/*
		if( !array_key_exists( $doc_id, $$varname ) )
		{
			$$varname[ $doc_id ] = array();
		}
		
		array_push( $$varname[ $doc_id ], $entry[ 後設標記ID ] );
		*/
	}
	//print_r( $doc_l_id_texts );
	/*
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
	
	file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . 
		'metadata' . DS . 
		'doc_id_texts' . DS .
		"${版本詩碼}.json",
		$json . PHP_EOL );

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
*/
	//$異_doc_ids
	
	
	return true;
}
?>