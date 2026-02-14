<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成詩碼坐標.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$詩陣列文件夾 = dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_BASE_TEXT_DIR;
	
if( !is_dir( $詩陣列文件夾 ) )
{
    throw new RuntimeException( 'exceptions 文件夾: ' . $excep_dir );
}
$詩碼坐標 = array();
$files = scandir( $詩陣列文件夾 );
sort( $files, SORT_STRING );

foreach( $files as $file )
{
	$path = $詩陣列文件夾 . $file;
	
	if(
		is_file( $path )
		&& preg_match( '/\d+(-\d)?\.json$/i', $file )
	)
	{
		$詩碼 = str_replace( '-', ':', 
			str_replace( '.json', '', $file ) );
		array_push( $詩碼坐標, "〚${詩碼}:〛" );
	}
}
//print_r( $詩碼坐標 );


$json = json_encode(
	$詩碼坐標,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR .
	"詩碼坐標.json",
	$json . PHP_EOL );
?>