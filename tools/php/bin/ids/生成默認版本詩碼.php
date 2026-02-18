<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\ids\生成默認版本詩碼.php
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

$組詩_副題 = 提取數據結構( 組詩_副題 );
$files = scandir( $dir );
sort( $files, SORT_STRING );

$默認版本詩碼 = array();

foreach( $files as $file )
{
	$path = $dir . $file;

	if(
		is_file( $path )
		&& preg_match( '/\.txt$/i', $file )
	)
	{
		$文檔 = str_replace( '.txt', '', $file );
		
		if( 是組詩( $文檔 ) )
		{
			$counter = 1;
			
			foreach( $組詩_副題[ $文檔 ][ 1 ] as $dummy )
			{
				array_push( $默認版本詩碼,
					$文檔 . '-' . $counter );
				$counter++;
			}
		}
		else
		{
			array_push( $默認版本詩碼, $文檔 );
		}
	}
}

$json_dir = dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_IDS_DIR;

$json = json_encode(
    $默認版本詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents( 
	$json_dir .
	"默認版本詩碼.json",
	$json . PHP_EOL );
?>
