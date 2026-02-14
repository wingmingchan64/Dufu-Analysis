<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成含範圍完整字碼坐標.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$完整坐標表 = 提取數據結構( 完整坐標表 );
$含範圍完整字碼坐標 = array();
$不含範圍完整字碼坐標 = array();
$regex1 = '/\d{4}:\d+\.\d.\d+-\d+/u'; // 〚0003:5.1.2-4〛
$regex2 = '/\d{4}:\d+:\d+\.\d.\d+-\d+/u'; //〚0013:2:11.2.1-3〛
$regex3 = '/\d{4}:\d+\.\d.\d+〛/u'; // 〚0003:5.1.2〛
$regex4 = '/\d{4}:\d+:\d+\.\d.\d+〛/u'; //〚0013:2:11.2.1〛

foreach( $完整坐標表 as $坐標 )
{
	//echo $坐標, NL;
	if( preg_match( $regex1, $坐標 ) ||
		preg_match( $regex2, $坐標 ) )
	{
		array_push( $含範圍完整字碼坐標, $坐標 );
	}
	elseif( preg_match( $regex3, $坐標 ) ||
		preg_match( $regex4, $坐標 ) )
	{
		array_push( $不含範圍完整字碼坐標, $坐標 );
	}
}

$json = json_encode(
	$含範圍完整字碼坐標,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR .
	"含範圍完整字碼坐標.json",
	$json . PHP_EOL );
	
$json = json_encode(
	$不含範圍完整字碼坐標,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR .
	"不含範圍完整字碼坐標.json",
	$json . PHP_EOL );
?>