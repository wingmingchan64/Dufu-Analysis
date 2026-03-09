<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成默認詩文檔碼_詩文.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼_詩文 = array();
$行碼_詩文 = 提取數據結構( 行碼_詩文 );

foreach( $行碼_詩文 as $默認詩文檔碼 => $碼_行 )
{
	$默認詩文檔碼_詩文[ $默認詩文檔碼 ] = "";
	
	foreach( $碼_行 as $碼 => $行 )
	{
		if( $行 != "" )
		{
			$默認詩文檔碼_詩文[ $默認詩文檔碼 ] .= $行;
		}
			
	}
}

$json = json_encode(
	$默認詩文檔碼_詩文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_MAPPING_DIR .
	"默認詩文檔碼_詩文.json",
	$json . PHP_EOL );

?>