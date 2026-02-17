<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\字→平水韻韻部.php 居
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字_韻部 );

check_argv( $argv, 2, 提供單字 );
// standardize the text
$字 = fixText( trim( $argv[ 1 ] ) );

if( array_key_exists( $字, $字_韻部 ) )
{
	print_r( $字_韻部[ $字 ] );
}
elseif( mb_strlen( $字 ) == 2 )
{
	print_r( 
		array( $字_韻部[ mb_substr( $字, 0, 1 ) ], 
			$字_韻部[ mb_substr( $字, 1, 1 ) ] )
	);
}
else
{
	echo 無結果, NL;
}
?>