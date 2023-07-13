<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成中原音韻聲母.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '用字_頻率.php' );
require_once( 杜甫資料庫 . '中原音韻\字_聲母.php' );

$用字 = array_keys( $用字_頻率 );
$字聲 = array_keys( $字_聲母 );
print_r( array_diff( $字聲, $用字) );
/*
$pattern = "|<p>\s+<a href=\".+?\">(\\X+?)</a>母|";
$matches = array();
$字s = array_keys( $用字_頻率 );
$count = 0;

foreach( $字s as $字 )
{
	if( $count < 1000 )
	{
		$count++;
		continue;
	}
//$字 = '簟';
$contents = file_get_contents(
"https://ytenx.org/zim?dzih=${字}&dzyen=1&jtkb=1&jtkd=1&jtdt=1&jtgt=1"
 );
preg_match_all( $pattern, $contents, $matches );
//print_r( $matches );
if( is_array( $matches[1] ) && sizeof( $matches[1] ) > 0 )
{
echo "\"${字}\"=>\"", $matches[1][0], "\",", NL;
}
else
{
echo "\"${字}\"=>\"not found", "\",", NL;
}
$count++;

}*/
?>
