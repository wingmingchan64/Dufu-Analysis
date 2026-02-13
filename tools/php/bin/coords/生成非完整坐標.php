<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成非完整坐標.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$非完整坐標 = array();
//$文檔碼 = '0003';

foreach( $默認詩文檔碼 as $文檔碼 )
{
	$坐標s = $默認詩文檔碼_完整坐標表[ $文檔碼 ];
	foreach( $坐標s as $坐標 )
	{
		$坐標 = str_replace( "${文檔碼}:", '', $坐標 );
		if( $坐標 != '〚〛' && !in_array( $坐標, $非完整坐標 ) )
		{
			array_push( $非完整坐標, $坐標 );
		}
	}
}

sort( $非完整坐標 );

//print_r( $非完整坐標 );


$json = json_encode(
	$非完整坐標,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"非完整坐標表.json",
	$json . PHP_EOL );

?>