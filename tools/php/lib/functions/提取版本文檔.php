<?php
/*
 * 
 */
function 提取版本文檔(
	string $簡稱,
	string $版文檔碼, 
	bool $插入文字 = true,
	bool $debug=false ) : array
{
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	// 版本名字
	$書名 = $書目簡稱[ $簡稱 ]; // 
	$版文檔碼_詩碼s = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_${簡稱}詩碼" );
	$版文檔碼_默文檔碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}文檔碼_默文檔碼" );
	$默文檔碼 = $版文檔碼_默文檔碼[ $版文檔碼 ][ 0 ];
	debug_echo( __FILE__, __LINE__, $版文檔碼, $debug );
	
	// 可能是組詩
	$版詩碼s = $版文檔碼_詩碼s[ $版文檔碼 ];
	$版詩碼_默詩碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
		"${簡稱}詩碼_默詩碼" );
	// 詩題、序言
	$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );
	$默認詩文檔碼_序言 = 提取數據結構( 默認詩文檔碼_序言 );
	
	$後設資料 = 提取後設資料( $書名 . DS . 'metadata' . DS .
		'by_doc_id' . DS . $版文檔碼 );
	$資料 = $後設資料[ $簡稱 . $版文檔碼 ];
	// retrieve base text
	$bt = array();
	// set the default 詩題、序言
	$bt[ 詩題 ] = $默認詩文檔碼_詩題[ $默文檔碼 ];
	
	if( array_key_exists( $默文檔碼, $默認詩文檔碼_序言 ) )
	{
		$bt[ 序言 ] = $默認詩文檔碼_序言[ $默文檔碼 ];
	}
	
	$是組詩 = 是組詩( $默文檔碼 );
	
	if( $是組詩 )
	{
		foreach( $版詩碼s as $版詩碼 )
		{
			$默詩碼 = $版詩碼_默詩碼[ $版詩碼 ];
			$默文檔碼 = substr( $默詩碼, 0, 4 );
			$默首碼 = substr( $默詩碼, 5 );
			// store all default poems of 組詩
			$parts = explode( '-', $默詩碼 );
			$bt[ $parts[ 0 ] ][ $parts[ 1 ] ]  =
				提取數據結構( BASE_TEXT_DIR . $默詩碼 )
					[ $默文檔碼 ][ $默首碼 ];
		}
	}
	else
	{
		$bt = 提取數據結構( BASE_TEXT_DIR . $默文檔碼 );
	}
/*
	// $資料 per 文檔，not per 詩
	for( $i=0; $i<sizeof( $資料 ); $i++ )
	{
		$類別 = $資料[ $i ][ CAT ];
		$錨値 = $資料[ $i ][ B_A ];
		$文字 = $資料[ $i ][ T ];
		// the first record
		// 詩題、序言、詩文
		$regex = '/〚(\d{4}):([13])〛/u';
		$matches = array();
		$r = preg_match( $regex, $錨値, $matches );
		
		// 詩題
		if( $r && $matches[ 2 ] == '1' )
		{
			if( $是組詩 )
			{
				$bt[ 詩題 ] = $文字;
			}
			else
			{
				$bt[ $默文檔碼 ][ 詩題 ] = $文字;
			}
		}
		// 序言
		elseif( $r && $matches[ 2 ] == '3' )
		{
			if( $是組詩 )
			{
				$bt[ 序言 ] = $文字;
			}
			else
			{
				$bt[ $默文檔碼 ][ 序言 ] = $文字;
			}
		}
		// 副題、詩文
		
		else
		{
			// read from other files instead
			
			if( $類別 == '異' )
			{
				替換詩陣列文字( $bt, $錨値, $文字, $debug  );
			}
			else
			{
				//debug_echo( __FILE__, __LINE__, $錨値, $debug );

				插入詩陣列文字( $bt, $錨値, $文字, $debug );
			}
				
		}
		
	}
	*/
	// read from other files instead
	$簡稱_部分 = 提取後設資料( '簡稱_部分' );
	
	$部分s = $簡稱_部分[ $簡稱 ];
	
	foreach( $部分s as $部分 )
	{
		$doc_id_texts = 提取後設資料( $書名 . DS .
			METADATA_DIR . 'doc_id_texts' . DS . $版文檔碼 );
			
		if( $部分 == '異' )
		{
			$doc_id_異 = 提取後設資料( $書名 . DS .
				METADATA_DIR . 'doc_id_異' );
			foreach( $doc_id_異[ $版文檔碼 ] as $mm_id => $錨 )
			{
				替換詩陣列文字( $bt, $錨, $doc_id_texts[ $mm_id ], $debug  );
			}
		}
		else
		{
			$後設資料名 = 'doc_id_' . $部分; 
			$$後設資料名 = 提取後設資料( $書名 . DS .
				METADATA_DIR . $後設資料名 );
				
			foreach( $$後設資料名[ $版文檔碼 ] as $坐標 => $mm_ids )
			{
				$text = '[';
				
				foreach( $mm_ids as $mm_id )
				{
					$text .= $doc_id_texts[ $mm_id ];
				}
				
				$text .= ']';
				
				if( 提取行碼( $坐標 ) == 1 )
				{
					$bt[ $默文檔碼 ][ 詩題 ] = $bt[ $默文檔碼 ][ 詩題 ] . '[' . $doc_id_texts[ $mm_id ] . ']';
				}
				else
				{
					echo $坐標 . ' ' . $text, NL;
					插入詩陣列文字( $bt, $坐標, $text, $debug  );
				}
			}
		}
	}
	
	
	if( $是組詩 )
	{
		return array( $簡稱 . $版文檔碼 => $bt );
	}
	
	return $bt;
}

function get_edition_document(
	string $簡稱,
	string $版文檔碼, 
	bool $插入文字 = true,
	bool $debug=false ) : array
{
	return 提取版本文檔( $簡稱, $版文檔碼, $插入文字, $debug );
}
?>