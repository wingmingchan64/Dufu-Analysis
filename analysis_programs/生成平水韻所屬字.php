<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成平水韻所屬字.php
*/
require_once( '常數.php' );
require_once( '函式.php' );

$平水韻文件 = file_get_contents( 平水韻文件夾 . 韻部 . '.txt' );
$out_file = 平水韻文件夾 . '平水韻所屬字.php';
//echo $平水韻文件;
$平水韻韻部s = explode( NL, $平水韻文件 );

$平水韻所屬字 = array();

foreach( $平水韻韻部s as $韻部 )
{
	$韻部 = trim( $韻部 );
	$平水韻所屬字[ $韻部 ] = array();
}

$韻部s = array_keys( $平水韻所屬字 );
//$pattern = "|<td><a href=\"/wiki/\w+?\" title=\"\X\">\X</a></td>|";
$pattern = "|<td><a href=\".+?\" title=\"(\\X+?)\"|";
//$韻部 = '一東';
foreach( $韻部s as $韻部 )
{
	$matches = array();
	$url = "https://zh.wiktionary.org/wiki/Rhymes:%E6%BC%A2%E8%AA%9E/%E5%B9%B3%E6%B0%B4%E9%9F%BB/${韻部}";
	$file_constent = file_get_contents( $url );
	preg_match_all( $pattern, $file_constent, $matches );
	
	foreach( $matches[ 1 ] as $字 )
	{
		if( mb_strlen( $字 ) == 1 )
		{
			array_push( $平水韻所屬字[ $韻部 ], $字 );
		}
	}
	
	//print_r( $平水韻所屬字[ $韻部 ] );
}

//print_r( $平水韻所屬字 );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成平水韻.php
說明：平水韻各韻部所屬字。
*/
\$平水韻所屬字=array(\n";
foreach( $平水韻所屬字 as $韻 => $字s )
{
	$code .= "\"${韻}\"=>array(\n";
	
	foreach( $字s as $字 )
	{
		$code .= "\"${字}\",";
	}
	
	$code .= "),\n";
}


$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";
file_put_contents( $out_file, $code );
?>
