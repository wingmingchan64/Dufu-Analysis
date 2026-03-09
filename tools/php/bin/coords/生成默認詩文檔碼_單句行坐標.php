<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成默認詩文檔碼_單句行坐標.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$行碼_詩文 = 提取數據結構( 行碼_詩文 );
$默認詩文檔碼_單句行坐標 = array();

foreach( $行碼_詩文 as $文檔碼 => $坐標詩文 )
{
	foreach( $坐標詩文 as $坐標 => $詩文 )
	{
		if( !preg_match( 兩句regex, $詩文 ) )
		{
			if( !array_key_exists( 
				$文檔碼, $默認詩文檔碼_單句行坐標 ) )
			{
				$默認詩文檔碼_單句行坐標[ $文檔碼 ] = array();
			}
			$默認詩文檔碼_單句行坐標[ $文檔碼 ][] = $坐標;
		}
	}
}

//print_r( $默認詩文檔碼_單句行坐標 );


$json = json_encode(
    $默認詩文檔碼_單句行坐標,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR . "默認詩文檔碼_單句行坐標.json",
	$json . PHP_EOL );

?>
