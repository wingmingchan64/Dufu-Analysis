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
$默文檔碼_全文檔碼 = array();
$全文檔碼_默文檔碼 = array();
$默詩碼_全詩碼 = array();
$全詩碼_默詩碼 = array();
$全文檔碼_全詩碼 = array();

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
	'《全唐詩》' . DS . 'catalog' . DS . '全目錄.json',
	$contents . PHP_EOL );

$path = 	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . 'catalog' . DS . '全目錄.json';
$file = file_get_contents( $path );
//echo $file;
$全目錄 = json_decode( $file, true );

foreach( $全目錄 as $item )
{
	$默詩碼 = $item[ "默詩碼" ];
	$默文檔碼 = substr( $默詩碼, 0, 4 );
	$全詩碼 = $item[ "全詩碼" ];
	$全文檔碼 = substr( $全詩碼, 0, 4 );
	
	if( !array_key_exists( $默詩碼, $默詩碼_全詩碼 ) )
	{
		$默詩碼_全詩碼[ $默詩碼 ] = $全詩碼;
	}
	
	if( !array_key_exists( $全詩碼, $全詩碼_默詩碼 ) )
	{
		$全詩碼_默詩碼[ $全詩碼 ] = $默詩碼;
	}
	
	if( !array_key_exists( $默文檔碼, $默文檔碼_全文檔碼 ) )
	{
		$默文檔碼_全文檔碼[ $默文檔碼 ] = array();
	}
	if( !in_array( $全文檔碼, $默文檔碼_全文檔碼[ $默文檔碼 ] ) )
	{
		array_push( $默文檔碼_全文檔碼[ $默文檔碼 ], $全文檔碼 );
	}
	
	if( !array_key_exists( $全文檔碼, $全文檔碼_默文檔碼 ) )
	{
		$全文檔碼_默文檔碼[ $全文檔碼 ] = array();
	}
	if( !in_array( $默文檔碼, $全文檔碼_默文檔碼[ $全文檔碼 ] ) )
	{
		array_push( $全文檔碼_默文檔碼[ $全文檔碼 ], $默文檔碼 );
	}
	
	if( !array_key_exists( $全文檔碼, $全文檔碼_全詩碼 ) )
	{
		$全文檔碼_全詩碼[ $全文檔碼 ] = array();
	}
	array_push( $全文檔碼_全詩碼[ $全文檔碼 ], $全詩碼 );
}

//print_r( $全目錄[ 3 ] );
// 詩碼
$json = json_encode(
    $全詩碼_默詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . 'catalog' . DS . '全詩碼_默詩碼.json',
	$json . PHP_EOL );
	
$json = json_encode(
    $默詩碼_全詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . 'catalog' . DS . '默詩碼_全詩碼.json',
	$json . PHP_EOL );
	
// 文檔碼
$json = json_encode(
    $全文檔碼_默文檔碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . 'catalog' . DS . '全文檔碼_默文檔碼.json',
	$json . PHP_EOL );

$json = json_encode(
    $默文檔碼_全文檔碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . 'catalog' . DS . '默文檔碼_全文檔碼.json',
	$json . PHP_EOL );

// 文檔碼_詩碼
$json = json_encode(
    $全文檔碼_全詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . 'catalog' . DS . '全文檔碼_全詩碼.json',
	$json . PHP_EOL );

?>