<?php
/*
php H:\github\Dufu-Analysis\AI貢獻記錄（ChatGPT）\後設思考與工具設計（MetaDesign）\永明的實驗場\process_metadata.php
*/
require_once( "H:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "H:\\github\\Dufu-Analysis\\analysis_programs\\後設資料鍵.php" );

$metadata = array();

$str = 
	file_get_contents( "H:\\github\Dufu-Analysis\\AI貢獻記錄（ChatGPT）\\後設思考與工具設計（MetaDesign）\\永明的實驗場\\仇注奉贈韋左丞丈二十二韻_後設資料.txt" );

$strings = explode( "〙", $str );

foreach( $strings as $line )
{
	if( $line == '' )
		continue;
	$parts = explode( "〘", $line );

	if( sizeof( $parts ) == 2 )
	{
		$ary = create_array( $parts[ 1 ] );
		$ary[ 'text' ] = trim( $parts[ 0 ] );
		array_push( $metadata, $ary );
	}
}
print_r( $metadata );

function create_array( string $str ) : array
{
	global $後設資料鍵;
	$temp = array();
	$parts = explode( ";", $str );
	
	foreach( $parts as $part )
	{
		if( strpos( $part, ':' ) !== false )
		{
			$k_v = explode( ':', $part );
			$key   = $k_v[ 0 ];
			$value = trim( $k_v[ 1 ] );
			
			if( !in_array( $key, $後設資料鍵 ) )
			{
				echo "$key not a value key", NL;
				exit;
			}
			
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