<?php
/*
php h:\github\Dufu-Analysis\JSON\程式\生成杜甫詩陣列.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$杜甫詩陣列 = array();

foreach( $默認詩文檔碼 as $文檔 )
{
	$杜甫詩陣列[ $文檔 ] = array();
	// 詩題
	$杜甫詩陣列[ $文檔 ][ 詩題 ] = $默認詩文檔碼_詩題[ $文檔 ];
	
	// 題注
	if( array_key_exists( $文檔, $默認詩文檔碼_題注 ) )
	{
		$杜甫詩陣列[ $文檔 ][ 題注 ] = $默認詩文檔碼_題注[ $文檔 ];
	}
	
	// 序言
	if( array_key_exists( $文檔, $默認詩文檔碼_序文 ) )
	{
		$杜甫詩陣列[ $文檔 ][ 序言 ] = $默認詩文檔碼_序文[ $文檔 ];
	}
	// 組詩
	if( array_key_exists( $文檔, $組詩_副題 ) )
	{
		//echo "組詩", NL;

		// 副題
		$副題s = $行碼_副題[ $文檔 ];
		
		foreach( $副題s as $坐標 => $副題 )
		{
			$首碼 = 提取首碼( $坐標 );
			//echo $首碼, NL;
			
			if( !array_key_exists( $首碼, $杜甫詩陣列[ $文檔 ] ) )
			{
				$杜甫詩陣列[ $文檔 ][ $首碼 ] = array();
				$杜甫詩陣列[ $文檔 ][ $首碼 ][ 副題 ] = $副題;
			}
		}
/*		
		$詩組數目 = sizeof( $詩組_詩題[ $文檔 ][ 1 ] );
		
		for( $i = 1; $i <= $詩組數目; $i++ )
		{
			$杜甫詩陣列[ $文檔 ][ "$i" ] = array();
		}
		foreach( $内容[ 副題 ] as $坐標 => $副題 )
		{
			$路徑 = 坐標轉換成列陣路徑( $坐標 );
			$杜甫詩陣列[ $路徑[ 0 ] ][ $路徑[ 1 ] ] = array();
			$杜甫詩陣列[ $路徑[ 0 ] ][ $路徑[ 1 ] ][ 副題 ] = $副題;
		}
*/
	}
	// 詩文
	$詩句s = $句碼_詩句[ $文檔 ];
	
	foreach( $詩句s as $坐標 => $句 )
	{
		$路徑列陣 = 坐標轉換成列陣路徑( $坐標 );
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
}

$json = json_encode(
    $杜甫詩陣列,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"杜甫詩陣列.json",
	$json . PHP_EOL );
?>

