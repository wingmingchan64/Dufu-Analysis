<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成默認詩文檔碼_行碼_內容.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認詩文檔碼_行碼_內容 = array();

$text_dir = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR . 
	'DuFu' . DIRECTORY_SEPARATOR . 
	'默認版本' . DIRECTORY_SEPARATOR . 
	'詩' . DIRECTORY_SEPARATOR;

if( !is_dir( $text_dir ) )
{
    throw new RuntimeException( '文件夾不存在: ' . $text_dir );
}
$files = scandir( $text_dir );
sort( $files, SORT_STRING );

foreach( $files as $file )
{
	$文檔碼 = str_replace( '.txt', '', $file );
	
	if( intval( $文檔碼 ) > 6093 )
	{
		break;
	}
	
	$path = $text_dir . $file;
	
	if(
		is_file( $path )
		&& preg_match( '/\.txt$/i', $file )
	)
	{
		$默認詩文檔碼_行碼_內容[ $文檔碼 ] = array();
		$contents = file_get_contents( $path );
		$lines = explode( NL, $contents );
		$size = sizeof( $lines );
		
		for( $i=0; $i<$size; $i++ )
		{
			$行碼 = $i + 1;
			$默認詩文檔碼_行碼_內容[ $文檔碼 ][ "〚${文檔碼}:${行碼}〛" ] =
				$lines[ $i ];
		}
	}
}

$json = json_encode(
    $默認詩文檔碼_行碼_內容,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_COORDS_DIR .
'默認詩文檔碼_行碼_內容.json',
	$json . PHP_EOL );
?>