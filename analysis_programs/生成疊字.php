<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成疊字.php
*/
require_once( "函式.php" );
require_once( "h:\\github\\Dufu-Analysis\\二字組合.php" );

$疊字 = array();
$code = "<?php
/*
*/
\$疊字=array(\n";

foreach( array_keys( $二字組合 ) as $組合 ) 
{
	if( mb_substr( $組合, 0, 1 ) == mb_substr( $組合, 1, 1 ) )
	{
		array_push( $疊字, $組合 );
	}
}
foreach( $疊字 as $組合 )
{
	$code = $code . "\"${組合}\",";
}
$size = sizeof( $疊字 );
$code = $code . "\n); // size: ${size}
\n?>";
file_put_contents( "h:\\github\\Dufu-Analysis\\疊字.php",
	$code );
?>

