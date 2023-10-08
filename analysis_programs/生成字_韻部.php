<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成字_韻部.php
*/

require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '平水韻\平水韻所屬字.php' );

$字_韻部 = array();

foreach( $平水韻所屬字 as $韻部 => $字s )
{
	foreach( $字s as $字 )
	{
		if( !array_key_exists( $字, $字_韻部 ) )
		{
			$字_韻部[ $字 ] = array( $韻部 );
		}
		elseif( !in_array( $韻部, $字_韻部[ $字 ] ) )
		{
			array_push( $字_韻部[ $字 ], $韻部 );
		}
	}
}

$out_file = 杜甫資料庫 . '平水韻\字_韻部.php';
$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成字_韻部.php
說明：字=>韻部。
*/
\$字_韻部=array(\n";

foreach( $字_韻部 as $字 => $韻部s )
{
	$code .= "\"${字}\"=>array(";
	foreach( $韻部s as $韻部 )
	{
		$code .= "\"${韻部}\",";
	}
	
	$code .= "),\n";
}

$code .= ");\n?>";
file_put_contents( $out_file, $code );
?>