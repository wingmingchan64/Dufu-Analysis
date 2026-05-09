<?php
/*
 * JINGQUAN, 0001
 */
use CTT\Exceptions\IllegalWorkIDException;

function 挂樹飾( 
	string $默文碼, 
	string $著述版文碼 ) : 	void
{
	global $ctt_registry;
	[ $著述碼, $版文碼 ] = explode( ',', $著述版文碼 );
	// error checking
	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	// retrieve lookup maps
	$簡稱 = 提取數據結構( 著述碼_簡稱 )[ $著述碼 ];
	$data_dir = 提取書目簡稱()[ $簡稱 ] . DIRECTORY_SEPARATOR;
	$processing_order = 
		提取數據結構(
			METADATA_DIR . 'processing_order' )[ $著述碼 ];
	$部分_函式 = 提取數據結構(
			METADATA_DIR . '部分_函式' )[ $著述碼 ];
	// 正文樹
	$樹 = 提取基準正文樹( $默文碼 );
	添加錨( $樹 );
	// CTT: text source
	$ctt = retrieve_ctt( $著述版文碼 );
	// parts
	$metadata_dir =
		dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR .
		杜甫版本文件夾 . $data_dir . METADATA_DIR;
	//echo $metadata_dir, NL;
	
	$metadata_markers = array();
	
	foreach( $processing_order as $部分 )
	{
		$部分_dir = $metadata_dir . $部分 . 	
			DIRECTORY_SEPARATOR;
			
		if( is_dir( $部分_dir ) &&
			file_exists( $部分_dir . $版文碼 . '.txt' ) )
		{
			$metadata_markers[ $部分 ] =
				explode( NL, file_get_contents( 
					$部分_dir . $版文碼 . '.txt' ) );
		}
	}
	//print_r( $metadata_markers );
	foreach( $metadata_markers as $部分 => $mms )
	{
		foreach( $mms as $mm )
		{
			if( $mm != '' )
			{
				$rel = json_decode( $mm, true );
				$函式 = $部分_函式[ $部分 ];
				$replace = false;
				
				if( array_key_exists( "op", $rel ) )
				{
					$函式 = $rel[ "op" ];
					$replace = true;
				}
				
				$範圍 = $rel[ "scope" ];
				$路徑 = explode( ',', $rel[ "scope" ] );
				
				// replace scope x-y with a
				if( strpos( 
						$路徑[ count( $路徑 ) - 1 ],
						'-' ) !== false )
				{
					$路徑[ count( $路徑 ) - 1 ] = 'a';
				}
				
				$文字 = 提取ctt正文( $rel[ "src_path"] );
				$text = 
					提取ctt正文( $rel[ "src_path"] );
					
				if( !$replace )
				{
					$text =
						"〈${部分}*${範圍}*${text}〉";
				}

				if( $函式 == 'insert' )
				{
					插入路徑字( $樹, $路徑, $text );
				}
				elseif( $函式 == 'replace' )
				{
					替換路徑字( $樹, $路徑, $text );
				}
			}
		}
		// 
	}
	
	echo json_encode( $樹, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
}
?>