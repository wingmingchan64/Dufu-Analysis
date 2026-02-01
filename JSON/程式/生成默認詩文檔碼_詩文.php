<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成默認詩文檔碼_詩文.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$默認詩文檔碼_詩文 = array();

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
//print_r( $默認詩文檔碼_詩文 );

$json = json_encode(
	$默認詩文檔碼_詩文,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_詩文.json",
	$json . PHP_EOL );

?>