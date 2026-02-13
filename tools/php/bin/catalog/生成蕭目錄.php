<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成蕭目錄.php
 */
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
$file_name = __DIR__ . DS . '蕭目錄.txt';

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
	$默詩碼 = $parts[ 2 ];
	$頁s = explode( ',', $parts[ 3 ] );
	$contents .=
"{\"詩題\":\"${題}\",\"默詩碼\":\"${默詩碼}\",\"蕭詩碼\":\"${頁s[0]}\",\"所在頁\":{\"人民\":{\"實體書\":\"${頁s[1]}\",\"電子書\":\"${頁s[2]}\"}}},";
}
$contents = rtrim( $contents, ',' ) . ']';

file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'蕭滌非主編《杜甫全集校注》' . DS . '蕭目錄.json',
	$contents . PHP_EOL );
	
$蕭目錄 = json_decode( $contents, true );
print_r( $蕭目錄[ 215 ] );
?>