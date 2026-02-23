<?php
/*
php h:\github\Dufu-Analysis\tools\php\bin\base_text\生成杜甫詩陣列.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
require_once( dirname( __DIR__, 2 ) . DS . BIN_DIR .
	'載入身份數據結構.php' );
require_once( dirname( __DIR__, 2 ) . DS . BIN_DIR .
	'載入映射數據結構.php' );
require_once( dirname( __DIR__, 2 ) . DS . BIN_DIR .
	'載入坐標數據結構.php' );

$杜甫詩陣列 = array();

// read from github\DuFu\默認版本\詩
foreach( $默認詩文檔碼 as $文檔 )
{
	if( intval( $文檔 ) > 6093 )
		break;
	
	$杜甫詩陣列[ $文檔 ] = array();
	
	// 詩題
	$杜甫詩陣列[ $文檔 ][ 詩題 ] = $默認詩文檔碼_詩題[ $文檔 ];
	
	// 題注
	if( array_key_exists( $文檔, $默認詩文檔碼_題注 ) )
	{
		$杜甫詩陣列[ $文檔 ][ 題注 ] = $默認詩文檔碼_題注[ $文檔 ];
	}
	
	// 序言
	if( array_key_exists( $文檔, $默認詩文檔碼_序言 ) )
	{
		$杜甫詩陣列[ $文檔 ][ 序言 ] = $默認詩文檔碼_序言[ $文檔 ];
	}
	// 組詩
	//if( array_key_exists( $文檔, $組詩_副題 ) )
	if( 是組詩( $文檔 ) )
	{
		// 副題
		$首_行_副s = $組詩_副題[ $文檔 ];
		
		foreach( $首_行_副s as $首碼 => $行_副 )
		{
			if( !array_key_exists( $首碼, $杜甫詩陣列[ $文檔 ] ) )
			{
				$副題 = array_values( $組詩_副題[ $文檔 ][ $首碼 ] )[ 0 ];
				//echo $副題, NL;
				$杜甫詩陣列[ $文檔 ][ $首碼 ] = array();
				$杜甫詩陣列[ $文檔 ][ $首碼 ][ 副題 ] = $副題;
			}
		}
	}
	// 詩文
	$詩句s = $句碼_詩句[ $文檔 ];
	
	foreach( $詩句s as $坐標 => $句 )
	{
		$路徑列陣 = 完整坐標轉換成路徑列陣( $坐標 );
		$句字數 = mb_strlen( $句 );
		
		// 有首碼
		if( sizeof( $路徑列陣 ) == 4 )
		{
			for( $i = 0; $i < $句字數; $i++ )
			{
				$字 = mb_substr( $句, $i, 1 );
				$杜甫詩陣列[ $路徑列陣[ 0 ] ]
					[ $路徑列陣[ 1 ] ]
					[ $路徑列陣[ 2 ] ]
					[ $路徑列陣[ 3 ] ]
					[ "" . $i + 1 ]= $字;
			}
		}
		elseif( sizeof( $路徑列陣 ) == 3 )
		{
			for( $i = 0; $i < $句字數; $i++ )
			{
				$字 = mb_substr( $句, $i, 1 );
				$杜甫詩陣列[ $路徑列陣[ 0 ] ]
					[ $路徑列陣[ 1 ] ]
					[ $路徑列陣[ 2 ] ]
					[ "" . $i + 1 ]= $字;
			}
		}
	}
	
	$文檔名 = '';
	
	if( 是組詩( $文檔 ) )
	{
		$首碼s = array_keys( $組詩_副題[ $文檔 ] );
		
		foreach( $首碼s as $首碼 )
		{
			if( $首碼 != 詩題 )
			{
				$文檔名 = "${文檔}-${首碼}.json";
				$temp = array();
				$temp[ $文檔 ][ $首碼 ] = $杜甫詩陣列[ $文檔 ][ $首碼 ];
				$json = json_encode(
					$temp,
					JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
				);

				file_put_contents(
					dirname( __DIR__, 4 ) . DS .
					SCHEMAS_JSON_BASE_TEXT_DIR .
					$文檔名,
					$json . PHP_EOL );
			}
		}
	}
	else
	{
		$temp = array();
		$temp[ $文檔 ] = $杜甫詩陣列[ $文檔 ];
		$文檔名 = "${文檔}.json";
		$json = json_encode(
			$temp,
			JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
		);

		file_put_contents(
			dirname( __DIR__, 4 ) . DS .
			SCHEMAS_JSON_BASE_TEXT_DIR .
			$文檔名,
			$json . PHP_EOL );
	}
}

$json = json_encode(
    $杜甫詩陣列,
    JSON_UNESCAPED_UNICODE //| JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS .
	SCHEMAS_JSON_BASE_TEXT_DIR .
	"杜甫詩陣列.json",
	$json . PHP_EOL );
?>

