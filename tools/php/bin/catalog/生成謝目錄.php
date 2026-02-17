<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成謝目錄.php
 */
require_once( 
	dirname( __DIR__, 3) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$簡稱 = '謝';
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

foreach( $lines as $line )
{
	$parts = explode( ' ', $line );
	$題 = $parts[ 0 ];
	//echo $題, NL;
	$默詩碼 = $parts[ 2 ];
	$實頁 = $parts[ 3 ];
	$版詩碼 = $parts[ 4 ];

	if( mb_strpos( $默詩碼, '-' ) )
	{
	}
	else
	{
		if( 是組詩( $默詩碼 ) )
		{
			echo $默詩碼, NL;
		}
		
	}

	$temp = array();
	$temp[ "詩題" ] = $題;
	$temp[ "默詩碼" ] = $默詩碼;
	$temp[ "${簡稱}詩碼" ] = $版詩碼;
	
	$temp[ "所在頁" ] = array(
		"古" => array(
			"實體書" => $實頁
			)
	);
	
	array_push( $result, $temp );
		
/*
	$contents .= 
"{\"詩題\":\"${題}\",\"默詩碼\":\"${默詩碼}\",\"${簡稱}詩碼\":\"${版詩碼}\",\"所在頁\":{\"臺北\":{\"電子書\":\"${臺頁}\"},\"中華\":{\"電子書\":\"${中頁}\"},\"四庫\":{\"電子書\":\"${四頁}\"},\"聶巧平\":{\"實體書\":\"${聶頁}\"}}},";
*/
}

$fix = array(
// fix 默詩碼
'9001-1' => '1376-1',
'9001-2' => '1376-2',
'9001-3' => '1197-1',
'9001-4' => '1197-2',
'9001-5' => '1197-3',
'9002-1' => '1390-1',
'9002-2' => '1390-2',
'9002-3' => '1376-3',
'9002-4' => '1376-4',
'9002-5' => '1376-5',



);

$默詩碼s = array_keys( $fix );
$temp = array();

foreach( $result as $record )
{
	if( in_array( $record[ "默詩碼" ], $默詩碼s ) )
	{
		//echo $record[ "默詩碼" ] . ' ' . $fix[ $record[ "默詩碼" ] ], NL;
		$record[ "默詩碼" ] = $fix[ $record[ "默詩碼" ] ];
	}
	array_push( $temp, $record );
}

$json = json_encode(
    $temp,
    JSON_UNESCAPED_UNICODE //| JSON_PRETTY_PRINT
);

file_put_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	$書名 . DS .
	"${簡稱}目錄.json",
	$json . PHP_EOL );
	
print_r( json_decode( 
	file_get_contents(
		dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書名 . DS . "${簡稱}目錄.json" ), true ) [ 79 ] );
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