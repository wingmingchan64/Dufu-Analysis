<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成含範圍碼完整坐標_路徑集.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
	
$含範圍字碼完整坐標 = 提取數據結構( 含範圍字碼完整坐標 );
$含範圍行碼完整坐標 = 提取數據結構( 含範圍行碼完整坐標 );
$含範圍碼完整坐標_路徑集 = array();

foreach( $含範圍字碼完整坐標 as $坐標 )
{
	$含範圍碼完整坐標_路徑集[ $坐標 ] = array();
	$坐標列陣 = 含範圍字碼完整坐標轉換成坐標列陣( $坐標 );
	
	foreach( $坐標列陣 as $標 )
	{
		$含範圍碼完整坐標_路徑集[ $坐標 ][] = $標;
		
	}
}

foreach( $含範圍行碼完整坐標 as $坐標 )
{
	$含範圍碼完整坐標_路徑集[ $坐標 ] = array();
	$坐標列陣 = 含範圍行碼完整坐標轉換成坐標列陣( $坐標 );
	
	foreach( $坐標列陣 as $標 )
	{
		$含範圍碼完整坐標_路徑集[ $坐標 ][] =
			完整坐標轉換成路徑( $標 );
	}
}

$json = json_encode(
	$含範圍碼完整坐標_路徑集,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR .
	"含範圍碼完整坐標_路徑集.json",
	$json . PHP_EOL );
?>