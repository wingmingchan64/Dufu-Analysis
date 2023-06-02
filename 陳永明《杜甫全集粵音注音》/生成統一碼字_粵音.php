<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成統一碼字_粵音.php

*/
/*
CJK Unified Ideographs Range: 4E00–9FFF
*/
// 20950
$字表 = file_get_contents( 'h:\github\unicode\unified.txt' );
// 6582
$字表 = file_get_contents( 'h:\github\unicode\A.txt' );
// 42711
$字表 = file_get_contents( 'h:\github\unicode\B.txt' );
$字數 = mb_strlen( $字表 );
//echo $字數, "\n";
//exit;

$count   = 0;
$pattern = '|class="jyutping">\w+</span>|';
$result  = array();
$missing = array();


for( $i = 30000; $i < 35000; $i++ ) // 30-35
{
	$字 = mb_substr( $字表, $i, 1 );
	// no exception thrown
	try
	{
		// read page from jyut.net
		$source  = file_get_contents( "https://jyut.net/query?q=${字}" );
		//$len     = strlen( $source);
		$matches = array();
		// read all pronunciations
		preg_match_all( $pattern, $source, $matches );

		foreach( $matches[ 0 ] as $item )
		{
			$item = str_replace( '</span>', '',
				str_replace( 'class="jyutping">', '', $item ) );
		
			if( !array_key_exists( $字, $result ) )
			{
				$result[ $字 ] = array();
			}
			elseif( !in_array( $item, $result[ $字 ] ) )
			{
				array_push( $result[ $字 ], $item );
			}
		}
	}
	catch( Exception $e )
	{
		echo $字, "\n";
		array_push( $missing, $字 );
	}
	
}

$outfile = 'h:\github\unicode\統一碼字_粵音.php';
$code = "<?php
/*
本文檔以 PHP 生成。
php h:\github\Dufu-Analysis\analysis_programs\生成統一碼字_粵音.php
粵音資料來源： https://jyut.net/
*/
\$統一碼字_粵音=array(
";
foreach( $result as $字 => $粵音列陣 )
{
	$code = $code . "'$字'=>array(";
	foreach( $粵音列陣 as $粵音 )
	{
		$code = $code . "'$粵音',";
	}
	$code = $code . "),\n";
}
$code = $code . ");
?>";
file_put_contents( $outfile, $code );

print_r( $missing );
?>