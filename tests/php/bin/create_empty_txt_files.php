<?php
/*
php H:\github\Dufu-Analysis\tests\php\bin\create_empty_txt_files.php
*/

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$path = 'H:\github\DuFu\packages\郭知達《新刊校定集注杜詩》\\';
$start = 20;
$end = 1116;

//$郭文檔碼_默文檔碼 = 

for( $i = $start; $i <= $end; $i++ )
{
	$文檔碼 = 修復文檔碼( $i . '' );
	$filename = $path . $文檔碼 . '.txt';
	
	if( !file_exists( $filename ) )
	{
		file_put_contents( $filename, '' );
	}
	
	
}
?>