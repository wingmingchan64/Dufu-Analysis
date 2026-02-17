<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩題注音→頁碼.php "lei5 baak6"
=>
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 詩題_頁碼 );
require_once( 詩題_注音 );

check_argv( $argv, 2, 提供詩題注音 );
$音 = trim( $argv[ 1 ] );
$result = array();
$temp   = array();
echo $音, NL;

foreach( $詩題_注音 as $詩題 => $注音 )
{
	if( containsPronunciation( $注音, $音 ) )
	{
		//echo "hit $音", NL;
		array_push( $temp, $詩題 );
	}
}

foreach( $temp as $詩題 )
{
	$頁碼s = $詩題_頁碼[ $詩題 ];
	
	if( is_array( $頁碼s ) )
	{
		foreach( $頁碼s as $頁 )
		{
			$result[ $頁 ] = $詩題;
		}
	}
	else
	{
		$result[ $頁碼s ] = $詩題;
	}
}

if( sizeof( $result ) == 0 )
{
	array_push( $result, 無結果 );
}

print_r( $result );
?>