<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字注音搜索詩句.php "hung4 zi1 jat6 taai3 ho4 cau4 zeot6"
=>
Array
(
    [詩句] => Array
        (
            [0] => 雄姿逸態何𡷾崒
        )

    [注音] => Array
        (
            [0] => hung4 zi1 jat6 taai3 ho4 cau4 zeot6
        )

    [坐標] => Array
        (
            [0] => 〚0608:5.1〛
        )
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 注音_詩句 );
require_once( 詩句_坐標 );

checkARGV( $argv, 2, 提供詩文注音 );
$粵音注音 = trim( $argv[ 1 ] );
$result = array();
$result[ 詩句 ] = array();
$result[ 注音 ] = array();
$result[ 坐標 ] = array();

foreach( array_keys( $注音_詩句  ) as $注音 )
{
	if( containsPronunciation( $注音, $粵音注音 ) )
	{
		array_push( $result[ 詩句 ], $注音_詩句[ $注音 ] );
		array_push( $result[ 注音 ], $注音 );
		array_push( $result[ 坐標 ], 
			$詩句_坐標[ $注音_詩句[ $注音 ] ] );
	}
}
print_r( $result );
?>