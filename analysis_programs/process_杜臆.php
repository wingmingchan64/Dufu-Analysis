<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_杜臆.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 頁碼_詩題 );

$text = getFile( 'H:\杜甫資料庫\王嗣奭《杜臆》\text.txt' );
$lines = explode( "\n", $text );
$store = array();
$i = 1;

foreach( $lines as $l )
{
	if( $l == '' )
	{
		continue;
	}
	elseif( mb_strpos( $l, '//' ) === false )
	{
		continue;
	}
	else
	{
		
		$l = str_replace( '// ', '', $l );
		$l_array = explode( ' ', $l );
		//echo $l_array[ 0 ], NL;
		//echo $l_array[ 1 ], NL;
		if( $l_array[ 1 ] == '6497' )
		{
			continue;
		}
		
		$k = trim( $l_array[ 2 ] ) . ' ' . $l_array[ 0 ];
		$v = $l_array[ 1 ] . ' ' . $頁碼_詩題[ $l_array[ 1 ] ];
		$store[ $k ] = $v;
		$i++;
	}
}
print_r( $store );
?>

