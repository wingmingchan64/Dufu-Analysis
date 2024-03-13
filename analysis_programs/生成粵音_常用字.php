<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成粵音_常用字.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "常用字廣州話讀音表.php" );

$result = array();

foreach( $常用字廣州話讀音表 as $字 => $音s )
{
	foreach( $音s as $音 )
	{
		if( !array_key_exists( $音, $result ) )
		{
			$result[ $音 ] = array( $字 );
		}
		else
		{
			array_push( $result[ $音 ], $字 );
		}
	}
}
$content = "<?php
\$粵音_常用字=array(
";
foreach( $result as $音 => $字s )
{
	$content = $content . "'$音'=>array(";
	foreach( $字s as $字 )
	{
		$content = $content . "'$字',";
	}
	$content = $content . "),\n";
}
$content = $content . "\n);\n?>\n";
file_put_contents( "H:\\github\\unicode\\粵音_常用字.php", $content );

?>