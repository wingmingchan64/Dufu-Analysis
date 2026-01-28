<?php
/**
 * 將 PHP array 轉為 JSON（保留 key、UTF-8、穩定排序）
 *
 * 用法：
 *   php H:\github\Dufu-Analysis\JSON\程式\array_to_json.php H:\github\Dufu-Analysis\詩組_詩題.php H:\github\Dufu-Analysis\JSON\杜甫全集\詩組_詩題.json
 */
// check and log errors
if( $argc < 3 )
{
    fwrite( STDERR, "Usage: php array_to_json.php input.php output.json\n" );
    exit( 1 );
}

$input  = $argv[ 1 ]; // input php
$output = $argv[ 2 ]; // output json

// check input file
if( !file_exists( $input ) ) {
    fwrite( STDERR, 
		"Input file not found: $input\n" );
    exit( 1 );
}

/**
 * 安全載入 PHP 檔案，並抓出第一個 array 變數
 */
$data = ( function() use ( $input )
{
    require $input;
	
    foreach( get_defined_vars() as $v )
	{
        if( is_array( $v ) )
		{
            return $v;
        }
    }
    return null;
} )();

if( !is_array( $data ) )
{
    fwrite( STDERR, 
		"No array found in input file.\n");
    exit( 1 );
}

/**
 * 依 key 排序（確保 Git diff 穩定）
 */
ksort( $data, SORT_STRING );

/**
 * 輸出 JSON（UTF-8、漂亮縮排、不轉義中文）
 */
$json = json_encode(
    $data,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

if( $json === false )
{
    fwrite( STDERR, "JSON encode error.\n");
    exit( 1 );
}

file_put_contents( $output, $json . PHP_EOL );

echo "OK: $output\n";
?>