<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\schemas\生成默認詩文檔碼.php
*/
require_once( 
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

$dir = dirname( __DIR__, 5 ) . DS . 'DuFu' . DS . '默認版本' . DS .
	'詩' . DS;

if( !is_dir( $dir ) )
{
	throw new RuntimeException( "找不到默認版本文件夾。" );
}

$files = scandir( $dir );
sort( $files, SORT_STRING );
$默認詩文檔碼 = array();

foreach( $files as $file )
{
	$path = $dir . $file;

	if(
		is_file( $path )
		&& preg_match( '/\.txt$/i', $file )
	)
	{
		$file = str_replace( '.txt', '', $file );
		array_push( $默認詩文檔碼, $file );
	}
}

$json_dir = dirname( __DIR__, 4 ) . DS . 'schemas' . DS . 'json' . DS;
$json = json_encode(
    $默認詩文檔碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents( 
	$json_dir .
	"默認詩文檔碼.json",
	$json . PHP_EOL );

?>
