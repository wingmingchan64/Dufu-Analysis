<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\生成默認詩文檔碼_詩文_坐標.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );


$默認詩文檔碼_詩文_坐標 = 提取數據結構( 默認詩文檔碼_空陣列 );

for( $i = 1; $i < 12; $i++ )
{
	$詩文_坐標 = 提取數據結構( 數字對照陣列[ $i ] );
	foreach( $詩文_坐標 as $詩文 => $坐標s )
	{
		foreach( $坐標s as $坐標 )
		{
			$文檔碼 = mb_substr( $坐標, 1, 4 );
			if( !array_key_exists( 
				$詩文, $默認詩文檔碼_詩文_坐標[ $文檔碼 ] ) )
			{
				$默認詩文檔碼_詩文_坐標[ $文檔碼 ][ $詩文 ] = array();
			}
			array_push( $默認詩文檔碼_詩文_坐標[ $文檔碼 ][ $詩文 ], $坐標 );
			
		}
	}
}
//print_r( $默認詩文檔碼_詩文_坐標 );

$json = json_encode(
    $默認詩文檔碼_詩文_坐標,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"數據結構" . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_詩文_坐標.json",
	$json . PHP_EOL );

?>
