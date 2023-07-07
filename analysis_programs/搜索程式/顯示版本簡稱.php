<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\顯示版本簡稱.php
=>

)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );

echo NL;

foreach( $書目簡稱 as $簡稱 => $書名 )
{
	echo trim( $簡稱, '=' ), ' ';
}
echo NL;
//print_r( $書目簡稱 );
?>