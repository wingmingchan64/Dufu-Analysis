<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成奭目錄.php
 */
require_once( 
	dirname( __DIR__, 3) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$簡稱 = '奭';
$書目簡稱 = 提取數據結構( 書目簡稱 );
$書名 = $書目簡稱[ $簡稱 ];
$目錄 = __DIR__ . DS . "${簡稱}目錄.txt";
$result = array();

if( !file_exists( $目錄 ) )
{
	throw new RuntimeException( "找不到目錄。" );
}
$file = file_get_contents( $目錄 );
$lines = explode( NL, $file );
$counter = 1;
$sub_counter = 0;
$prev_id = '';
$curr_id = '';

foreach( $lines as $line )
{
	$parts = explode( ' ', $line );
	$題 = $parts[ 0 ];
	//echo $題, NL;
	$默文檔碼 = $parts[ 2 ]; // -53
	$頁s = $parts[ 3 ];
	
	$parts = explode( ',', $頁s );
	$電頁 = $parts[ 0 ];
	$實頁 = intval( $電頁 ) - 53;
	$上頁s = array();
	
	for( $i = 1; $i < sizeof( $parts ); $i++ )
	{
		array_push( $上頁s, $parts[ $i ] );
	}

	$temp = array();
	$temp[ "詩題" ] = $題;
	$temp[ "默文檔碼" ] = 修復文檔碼( $默文檔碼 );
	$temp[ "${簡稱}文檔碼" ] = 修復文檔碼( $counter );
	
	$temp[ "所在頁" ] = array(
		"中" => array(
			"電子書" => $電頁,
			"實體書" => $實頁 . ''
			),
		"上" => array(
			"電子書" => $上頁s
		)
	);
	
	array_push( $result, $temp );
	$counter++;
/*
	$contents .= 
"{\"詩題\":\"${題}\",\"默詩碼\":\"${默詩碼}\",\"${簡稱}詩碼\":\"${版詩碼}\",\"所在頁\":{\"臺北\":{\"電子書\":\"${臺頁}\"},\"中華\":{\"電子書\":\"${中頁}\"},\"四庫\":{\"電子書\":\"${四頁}\"},\"聶巧平\":{\"實體書\":\"${聶頁}\"}}},";
*/
}


$json = json_encode(
    $result,
    JSON_UNESCAPED_UNICODE //| JSON_PRETTY_PRINT
);

file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	$書名 . DS .
	'catalog' . DS .
	"${簡稱}目錄.json",
	$json . PHP_EOL );
	
print_r( json_decode( 
	file_get_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . 'catalog' . DS . "${簡稱}目錄.json"), true ) ) ;
/*
try {
	$目錄陣列 = json_decode(
		$contents, true, 1024, JSON_THROW_ON_ERROR );
		
	print_r( $目錄陣列[ 438 ] );
}
catch (\JsonException $e)
{
    // Handle the exception
    echo "JSON Decode Error: " . $e->getMessage();
}
*/
?>