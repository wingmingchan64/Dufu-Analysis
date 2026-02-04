<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\生成默認詩文檔碼_詩文黑名單.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認詩文檔碼_詩文 = 提取數據結構( 默認詩文檔碼_詩文 );

$詩文_默文檔 = array();
$默文檔_詩文 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	$詩文 = normalize( 
		$默認詩文檔碼_詩文[ $文檔碼 ], true, true, true );
	$字數 = mb_strlen( $詩文 );

	$temp = array();

	for( $k = 0; $k < 8; $k++ )
	{
		$temp = array();
		
		for( $i=0; $i<$字數; $i++ )
		{
			$字 = mb_substr( $詩文, $i, $k );
			if( $字 == '' )
				continue;
			if( !array_key_exists( $字, $temp ) )
			{
				$temp[ $字 ] = 0;
			}
			$temp[ $字 ]++;
		}

		foreach( $temp as $字 => $頻率 )
		{
			if( $頻率 > 1 )
			{
				if( !array_key_exists( $文檔碼, $默文檔_詩文 ) )
				{
					$默文檔_詩文[ $文檔碼 ] = array();
				}
				if( !in_array( $字, $默文檔_詩文[ $文檔碼 ] ) )
				{
					array_push( $默文檔_詩文[ $文檔碼 ], $字 );
				}
			}
		}
	}
}

$json = json_encode(
    $默文檔_詩文,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"數據結構" . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_詩文重見名單.json",
	$json . PHP_EOL );

?>
