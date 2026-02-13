<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成全目錄.php
 */
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
$file_name = __DIR__ . DS . '全目錄.txt';

if( !file_exists( $file_name ) )
{
	throw new RumtimeException( "File not found." );
}
$file = file_get_contents( $file_name );
$lines = explode( NL, $file );
$contents = '[';

foreach( $lines as $line )
{
	$parts = explode( ' ', $line );
	$題 = $parts[ 0 ];
	$默 = $parts[ 2 ];
	$頁s = explode(',', $parts[ 3 ] );
	//echo $頁s, NL;
	$全 = $頁s[ 0 ];
	$中1 = str_replace( '中', '', $頁s[ 1 ] );
	$中2 = str_replace( '中PDF', '', $頁s[ 2 ] );
	$揚 = str_replace( '揚', '', $頁s[ 3 ] );
	$template =
"{\"詩題\":\"${題}\",\"默詩碼\":\"${默}\",
\"全詩碼\":\"${全}\",
\"所在頁\":{\"中華\":{\"實體書\":\"${中1}\",\"電子書\":\"${中2}\"},\"揚州\":{\"電子書\":\"${揚}\"}}},";
	$contents .= $template;
}
$contents = rtrim( $contents, ',' ) . ']';

file_put_contents(
	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . '全目錄.json',
	$contents . PHP_EOL );

$path = 	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . '全目錄.json';
$file = file_get_contents( $path );
//echo $file;
$全目錄 = json_decode( $file, true );
print_r( $全目錄[ 3 ] );
?>