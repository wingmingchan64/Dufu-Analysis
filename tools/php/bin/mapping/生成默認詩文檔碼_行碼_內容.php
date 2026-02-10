<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\mapping\生成默認詩文檔碼_行碼_內容.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
require_once( dirname( __DIR__, 2 ) . DS . BIN_DIR .
	'載入身份數據結構.php' );

$默認詩文檔碼_行碼_內容 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	$默認詩文檔碼_行碼_內容[ $文檔碼 ] = array();
	$contents = file_get_contents( 
		"H:\\github\\DuFu\\默認版本\\詩\\${文檔碼}.txt" );
	$lines = explode( NL, $contents );
	$size = sizeof( $lines );
	
	for( $i=0; $i<$size; $i++ )
	{
		$行碼 = $i + 1;
		$默認詩文檔碼_行碼_內容[ $文檔碼 ][ "〚${文檔碼}:${行碼}〛" ] =
			$lines[ $i ];
	}
}

$json = json_encode(
    $默認詩文檔碼_行碼_內容,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
file_put_contents(
	'H:\github\Dufu-Analysis\schemas\json\mapping\默認詩文檔碼_行碼_內容.json',
	$json . PHP_EOL );
?>