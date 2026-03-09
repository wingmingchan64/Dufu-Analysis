<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成非完整坐標.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼_完整坐標表 = 提取數據結構( 默認詩文檔碼_完整坐標表 );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );

$非完整坐標 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	if( intval( $文檔碼 ) > 6093 )
	{
		break;
	}

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
	dirname( __DIR__, 4 ) . DIRECTORY_SEPARATOR . 
	SCHEMAS_JSON_COORDS_DIR .
	"非完整坐標表.json",
	$json . PHP_EOL );

?>