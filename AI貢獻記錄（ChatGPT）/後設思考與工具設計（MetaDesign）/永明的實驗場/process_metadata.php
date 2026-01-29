<?php
/*
php H:\github\Dufu-Analysis\AI貢獻記錄（ChatGPT）\後設思考與工具設計（MetaDesign）\永明的實驗場\process_metadata.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$詩碼 = '0001';
$默詩碼 = '0276';
$後設資料 = array();
$後設資料集 = array();
$後設資料_原文 = array();
if( !array_key_exists( $詩碼, $後設資料集 ) )
{
	$後設資料集[ $詩碼 ] = array();
}

$str = 
	file_get_contents( "H:\\github\\Dufu-Analysis\\AI貢獻記錄（ChatGPT）\\後設思考與工具設計（MetaDesign）\\永明的實驗場\\《全唐詩》\\${詩碼}.txt" );

$strings = explode( "〙", $str );

foreach( $strings as $line )
{
	if( $line == '' )
		continue;
	$parts = explode( "〘", $line );

	if( sizeof( $parts ) == 2 )
	{
		$tag = "〘id:${詩碼};" . trim( $parts[ 1 ] ) . "〙";
		$後設資料_原文[ $tag ] = trim( $parts[ 0 ] );
		$ary = create_array( $詩碼, $parts[ 1 ] );
		//$ary[ 'text' ] = trim( $parts[ 0 ] );
		array_push( $後設資料, $ary );
	}
}
$後設資料集[ $詩碼 ] = $後設資料;
print_r( $後設資料集 );
print_r( $後設資料_原文 );

function create_array( string $id, string $str ) : array
{
	//global $後設資料鍵;
	$temp = array();
	//$temp[ 'id' ] = $id;
	$parts = explode( ";", $str );
	
	foreach( $parts as $part )
	{
		if( strpos( $part, ':' ) !== false )
		{
			$k_v = explode( ':', $part );
			$key   = $k_v[ 0 ];
			$value = trim( $k_v[ 1 ] );
			
			if( $value != '' )
			{
				if( strpos( $key, 'pos' ) !== false )
				{
					$value = 
						提取詩文末字坐標(
						'0276', $value, true );
				}
				$temp[ $key ] = $value;
			}
		}
	}
	
	return $temp;
}
?>