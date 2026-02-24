<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\test_all_functions.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$func_dir = __DIR__ . DS;

if( ! is_dir( $func_dir ) )
{
    throw new RuntimeException( '函式目錄不存在: ' . $func_dir );
}

$files = scandir( $func_dir );
sort( $files, SORT_STRING );

echo NL, "Test Result:", NL;
echo "============", NL;

foreach( $files as $file )
{
	$path = $func_dir . $file;

	if(
		is_file( $path )
		&& preg_match( '/\_test.php$/i', $file )
	)
	{
		require( $path );
	}
}
$json = json_encode( $test_results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
echo 清理JSON括號( $json, true );
//print_r( $test_results );
?>