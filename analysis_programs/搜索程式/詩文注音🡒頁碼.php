<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩文注音🡒頁碼.php "git3"
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩句_頁碼 );
require_once( 頁碼_詩題 );
require_once( 注音_詩句 );

checkARGV( $argv, 2, 提供詩文注音 );
$音 = trim( $argv[ 1 ] );
$result = array();
echo $音, NL;

foreach( $注音_詩句 as $注音 => $詩句 )
{
	if( containsPronunciation( $注音, $音 ) )
	{
		echo "hit $音", NL;
		array_push( $result, $詩句_頁碼[ $詩句 ] . ' ' .
			$頁碼_詩題[ $詩句_頁碼[ $詩句 ] ] );
	}
}

if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}

print_r( $result );
?>