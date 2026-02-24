<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\基準正文樹深度優先遍歷_test.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$tree = json_decode( file_get_contents( 'H:\github\Dufu-Analysis\schemas\json\base_text\0003.json' ), true );
$根 = array_keys( $tree )[ 0 ];

if( array_key_exists( 詩題, $tree[ $根 ] ) )
{
	$題 = $tree[ $根 ][ 詩題 ];
	unset( $tree[ $根 ][ 詩題 ] );
}
$store = array();

基準正文樹加句號( $tree, $store );
print_r( $tree );
///echo $題, NL;
//echo implode( $store );

//print_r( $tree );
exit;


$store = array();
基準正文樹深度優先遍歷( $tree, $store );
//print_r( $store );
echo $題, NL;
echo implode( $store );

array_push( $test_results, "是合法錨値_test: 8 cases tested." );

?>