<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\默認版本定位\組詩默文檔碼、詩題、副題.php
=> 
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

$組詩_副題 = 提取數據結構( 組詩_副題 );

foreach( $組詩_副題 as $默文檔碼 => $record )
{
	echo $默文檔碼, " ", $record[ 詩題 ], NL;
	
	foreach( $record as $k => $v )
	{
		if( $k != 詩題 )
		{
			
			echo "    ", $v[ array_keys( $v )[ 0 ] ], NL;
		}
	}
}
?>