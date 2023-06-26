<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字注音搜索詩句.php "hung4 zi1 jat6 taai3 ho4 cau4 zeot6"
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\杜甫資料庫\\陳永明《杜甫全集粵音注音》\\注音_詩句.php" );
require_once( "h:\\杜甫資料庫\\詩句_坐標.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩文用字注音。", "\n";
	exit;
}
$粵音注音 = trim( $argv[ 1 ] );
$result = array();
$result[ "詩句" ] = array();
$result[ "注音" ] = array();
$result[ "坐標" ] = array();

foreach( array_keys( $注音_詩句  ) as $注音 )
{
	if( containsPronunciation( $注音, $粵音注音 ) )
	{
		array_push( $result[ "詩句" ], $注音_詩句[ $注音 ] );
		array_push( $result[ "注音" ], $注音 );
		array_push( $result[ "坐標" ], 
			$詩句_坐標[ $注音_詩句[ $注音 ] ] );
	}
}
print_r( $result );
?>