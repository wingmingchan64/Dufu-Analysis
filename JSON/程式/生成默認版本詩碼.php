<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\生成默認版本詩碼.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
$dir = 	杜甫文件夾 . "默認版本" . DS . "詩" . DS;
$默認版本詩碼 = array();

// 0003, 0008, 0013, ...
foreach( $默認詩文檔碼 as $文檔 )
{
	//echo $文檔, NL;
	//print_r( array_keys( $組詩_副題 ) );
	// 0013-1, 0013-2
	
	if( array_key_exists( $文檔, $組詩_副題 ) )
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
//print_r( $默認版本詩碼 );
$json = json_encode(
    $默認版本詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents( 數據結構文件夾 . "默認版本詩碼.json",
	$json . PHP_EOL );
?>
