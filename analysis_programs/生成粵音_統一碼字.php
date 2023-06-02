<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成粵音_統一碼字.php
*/
require_once( "h:\\杜甫資料庫\\統一碼字_粵音.php" );
$outfile = 'h:\github\unicode\粵音_統一碼字.php';

$粵音_統一碼字 = array();

foreach( $統一碼字_粵音 as $字 => $音s )
{
	foreach( $音s as $音 )
	{
		if( !array_key_exists( $音, $粵音_統一碼字 ) )
		{
			$粵音_統一碼字[ $音 ] = array( $字 );
		}
		else
		{
			array_push( $粵音_統一碼字[ $音 ], $字 );
		}
	}
}
ksort( $粵音_統一碼字 );
//print_r( $粵音_統一碼字[ "si1" ] );

$code = "<?php
/*
本文檔以 PHP 生成。
php h:\github\Dufu-Analysis\analysis_programs\生成粵音_統一碼字.php
粵音資料來源： https://jyut.net/
*/
\$粵音_統一碼字=array(\n";
foreach( $粵音_統一碼字 as $音 => $字s )
{
	$code = $code . "'$音'=>array(";
	foreach( $字s as $字 )
	{
		$code = $code . "'$字',";
	}
	$code = $code . "),\n";
}
$code = $code . ");\n?>";
file_put_contents( $outfile, $code );

?>