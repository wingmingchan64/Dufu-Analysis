<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\ids\生成默認詩文檔碼_默認詩碼.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
	
$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
$默認文檔碼_默認詩碼 = array();

foreach( $默認版本詩碼 as $詩碼 )
{
	if( strlen( $詩碼 ) == 4 )
	{
		$默認文檔碼_默認詩碼[ $詩碼 ] = $詩碼;
	}
	else
	{
		$默文檔碼 = substr( $詩碼, 0, 4 );
		
		if( !array_key_exists( $默文檔碼, $默認文檔碼_默認詩碼 ) )
		{
			$默認文檔碼_默認詩碼[ $默文檔碼 ] = array();
		}
		$默認文檔碼_默認詩碼[ $默文檔碼 ][] = $詩碼;
	}
}

$json = json_encode(
	$默認文檔碼_默認詩碼,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	
file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_IDS_DIR .
	"默認文檔碼_默認詩碼.json",
	$json . PHP_EOL );
?>
