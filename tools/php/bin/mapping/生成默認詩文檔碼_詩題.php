<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成默認詩文檔碼_詩題.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼_詩題 = array();
$詩題_默認詩文檔碼 = array();
$默認詩文檔碼_題注 = array();
$默認詩文檔碼_序言 = array();

$帶序言之詩 = 提取數據結構( 帶序言之詩 );

$text_dir = dirname( __DIR__, 5 ) . DIRECTORY_SEPARATOR . 
	杜甫默認版本詩文件夾;

if( !is_dir( $text_dir ) )
{
    throw new RuntimeException( '文件夾不存在: ' . $text_dir );
}

$files = scandir( $text_dir );
sort( $files, SORT_STRING );

foreach( $files as $file )
{
	$path = $text_dir . $file;
	if(
		is_file( $path )
		&& preg_match( '/\.txt$/i', $file )
	)
	{
		$contents = file_get_contents( $path );
		$lines = explode( NL, $contents );
		$first_line = $lines[ 0 ];
		$third_line = $lines[ 2 ];
		$temp = $first_line;
		$first_line = 
			preg_replace( 夾注regex, '', $first_line );
		$parts = explode( ' ', $first_line );
		$文檔碼 = trim( $parts[ 0 ] );
		$默認詩文檔碼_詩題[ $文檔碼 ] = trim( $parts[ 1 ] );
		$matches = array();
		
		if( preg_match( 夾注regex, $temp, $matches ) )
		{
			$默認詩文檔碼_題注[ $文檔碼 ] = $matches[ 0 ];
		}
		
		if( in_array( $文檔碼, $帶序言之詩 ) )
		{
			$默認詩文檔碼_序言[ $文檔碼 ] = $third_line;
		}
	}
}

$詩題_默認詩文檔碼 = array_flip( $默認詩文檔碼_詩題 );

$json = json_encode(
    $默認詩文檔碼_詩題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"默認詩文檔碼_詩題.json",
	$json . PHP_EOL );

$json = json_encode(
    $詩題_默認詩文檔碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"詩題_默認詩文檔碼.json",
	$json . PHP_EOL );

$json = json_encode(
    $默認詩文檔碼_題注,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"默認詩文檔碼_題注.json",
	$json . PHP_EOL );

$json = json_encode(
    $默認詩文檔碼_序言,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"默認詩文檔碼_序言.json",
	$json . PHP_EOL );
?>