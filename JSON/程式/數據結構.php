<?php
declare( strict_types = 1 );

/**
 * 安全讀取 JSON 檔並回傳 associative array
 */
function load_json_array( string $path ): array
{
    if ( !is_file( $path ) )
	{
        throw new RuntimeException("JSON 檔不存在：$path");
    }

    $json = file_get_contents( $path );
	
    if( $json === false )
	{
        throw new RuntimeException( "讀取失敗：$path" );
    }

    $data = json_decode( $json, true );
	
    if( !is_array( $data ) )
	{
        $err = function_exists(
			'json_last_error_msg' ) ? json_last_error_msg() : 'unknown';
        throw new RuntimeException( "JSON 解析失敗：$path；error=$err" );
    }

    return $data;
}

$base = "H:\\github\\Dufu-Analysis\\JSON\\杜甫全集";

$code_file_vars = [
    "詩頁碼",
    "頁碼_路徑",
];

foreach ($code_file_vars as $var) {
    $pathVar = "{$var}_path";
    $$pathVar = $base . "\\{$var}.json";

    // 直接把資料放進同名變數：$詩頁碼, $頁碼_路徑
    $$var = load_json_array( $$pathVar );
}
?>

