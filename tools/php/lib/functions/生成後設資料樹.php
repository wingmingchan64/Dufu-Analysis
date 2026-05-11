<?php
/*
 * 
 */
function 生成後設資料樹(
	string $默文碼, 
	string $著述碼,
	string $版文檔碼 ) : array
{
	global $ctt_registry;

	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	
	// retrieve lookup maps
	$簡稱 = 提取數據結構( 著述碼_簡稱 )[ $著述碼 ];
	$processing_order = 
		提取數據結構(
			METADATA_DIR . 'processing_order' )[ $著述碼 ];
	$部分_函式 = 提取數據結構(
			METADATA_DIR . '部分_函式' )[ $著述碼 ];

	// get the source folder
	$著述碼_簡稱 = 提取數據結構( 著述碼_簡稱 );
	//$書目簡稱 = 提取數據結構( 書目簡稱 );
	$df_folder = dirname( __DIR__, 5 ) .
		DIRECTORY_SEPARATOR .
		杜甫版本文件夾 .
		提取書目簡稱()[ $簡稱 ] . DIRECTORY_SEPARATOR .
		METADATA_DIR . $版文檔碼 . DIRECTORY_SEPARATOR;
	
	// get the target folder
	$ctt_dir = dirname( __DIR__, 5 ) . 
		DIRECTORY_SEPARATOR .
		'CanonicalTextTrees' . DIRECTORY_SEPARATOR;
	$ctt_folder = 提取ctt文件夾( $著述碼 ) . 
		DIRECTORY_SEPARATOR . 
		METADATA_DIR;
	$ctt_folder = $ctt_dir . $ctt_folder;
	
	$m_tree = array();
	$m_tree[ $著述碼 ] = array( $版文檔碼 => array() );
	
	foreach( $processing_order as $部分 )
	{
		$file = $df_folder . $部分 . '.txt';
		
		if( file_exists( $file ) )
		{
			$m_tree[ $著述碼 ][ $版文檔碼 ][ $部分 ] = array();
			$contents = file_get_contents( $file );
			$markers = explode( NL, $contents );
			
			foreach( $markers as $marker )
			{
				$map = json_decode( $marker, true );
				$範圍 = $map[ 'scope' ];
				
				if( 不是路徑( $範圍 ) && $範圍 != 'a' )
				{
					$範圍 = 提取詩文唯一路徑( $默文碼, $範圍 );
				}
				
				$來源路徑 = $map[ 'src_path' ];
				
				if( array_key_exists( 'op', $map ) )
				{
					$函式 = $map[ 'op' ];
				}
				else
				{
					$函式 = $部分_函式[ $部分 ];
				}
				$m_tree[ $著述碼 ][ $版文檔碼 ][ $部分 ]
				[ $範圍 ][ $來源路徑 ] = $函式;
			}
			
		}
	}
	print_r( json_encode( $m_tree , JSON_UNESCAPED_UNICODE  ) );
	
	//echo $df_folder, NL;
	//echo $ctt_folder, NL;
	return $m_tree;
}
?>