<?php
/*
 * 
 */
function 提取後設資料樹(
	string $著述碼,
	string $版文檔碼 ) : array
{
	global $ctt_registry;

	if( !array_key_exists( $著述碼, $ctt_registry ) )
	{
		throw new IllegalWorkIDException( "「${著述碼}」不存在。" );
	}
	
	// get the source folder
	$ctt_dir = dirname( __DIR__, 5 ) . 
		DIRECTORY_SEPARATOR .
		'CanonicalTextTrees' . DIRECTORY_SEPARATOR;
	$ctt_folder = 提取ctt文件夾( $著述碼 ) . 
		DIRECTORY_SEPARATOR . 
		METADATA_DIR;
	$ctt_folder = $ctt_dir . $ctt_folder;
	$m_tree_file = $ctt_folder . $版文檔碼 .
		DIRECTORY_SEPARATOR . 'm_tree.json';
	$m_tree = json_decode( 
		file_get_contents( $m_tree_file ), true );
	
	return $m_tree;
}

function get_m_tree( 	string $著述碼,
	string $版文檔碼 ) : array
{
	return 提取後設資料樹( $著述碼, $版文檔碼 );
}
?>