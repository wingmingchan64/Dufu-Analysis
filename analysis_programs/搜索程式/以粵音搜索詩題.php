<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以粵音搜索詩題.php "fung6 sin1"
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "陳永明《杜甫全集粵音注音》\\詩題_注音.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供詩題粵音注音。", "\n";
	exit;
}
$音 = trim( $argv[ 1 ] );
$result = array();
$注音_詩題 = array_flip( $詩題_注音 );

foreach( $注音_詩題 as $注音 => $詩題 )
{
	if( containsPronunciation( $注音, $音 ) )
	{
		$result[ $注音 ] = $詩題;
	}
}
if( sizeof( $result ) == 0 )
{
	array_push( "沒有結果。" );
}
print_r( $result );
?>