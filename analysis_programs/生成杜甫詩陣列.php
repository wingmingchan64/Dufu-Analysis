<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫詩陣列.php
*/
require_once( '常數.php' );
require_once( "函式.php" );
require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"loader.php" );
$JSON_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .	
	"杜甫全集";
//$JSON_詩BASE = 
	//$JSON_BASE . DIRECTORY_SEPARATOR . "詩";
//$JSON_行碼_詩文BASE = 
	//$JSON_詩BASE . DIRECTORY_SEPARATOR . "行碼_詩文";
$DATA = new JsonDataLoader( $JSON_BASE );
$詩頁碼 = $DATA->get( "詩頁碼" );
$詩頁碼_詩題 = $DATA->get( "詩頁碼_詩題" );
$詩頁碼_序文 = $DATA->get( "詩頁碼_序文" );
$詩頁碼_題注 = $DATA->get( "詩頁碼_題注" );
$詩組_詩題 = $DATA->get( "詩組_詩題" );
$行碼_副題 = $DATA->get( "行碼_副題" );
$句碼_詩句 = $DATA->get( "句碼_詩句" );

$杜甫詩陣列 = array();

foreach( $詩頁碼 as $頁 )
{
	$杜甫詩陣列[ $頁 ] = array();
	// 詩題
	$杜甫詩陣列[ $頁 ][ 詩題 ] = $詩頁碼_詩題[ $頁 ];
	
	// 題注
	if( array_key_exists( $頁, $詩頁碼_題注 ) )
	{
		$杜甫詩陣列[ $頁 ][ 題注 ] = $詩頁碼_題注[ $頁 ];
	}
	
	// 序言
	if( array_key_exists( $頁, $詩頁碼_序文 ) )
	{
		$杜甫詩陣列[ $頁 ][ 序言 ] = $詩頁碼_序文[ $頁 ];
	}
	// 詩組
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		// 副題
		$副題s = $行碼_副題[ $頁 ];
		
		foreach( $副題s as $坐標 => $副題 )
		{
			$首碼 = 提取首碼( $坐標 );
			
			if( !array_key_exists( $首碼, $杜甫詩陣列[ $頁 ] ) )
			{
				$杜甫詩陣列[ $頁 ][ $首碼 ] = array();
				$杜甫詩陣列[ $頁 ][ $首碼 ][ 副題 ] = $副題;
			}
		}
/*		
		$詩組數目 = sizeof( $詩組_詩題[ $頁 ][ 1 ] );
		
		for( $i = 1; $i <= $詩組數目; $i++ )
		{
			$杜甫詩陣列[ $頁 ][ "$i" ] = array();
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
	$詩句s = $句碼_詩句[ $頁 ];
	
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

exit;

//print_r( $杜甫詩陣列 );
$code = "<?php
/*
生成： 生成杜甫詩陣列.php
*/
\$杜甫詩陣列=array(
";
foreach( $杜甫詩陣列 as $頁 => $子列陣 )
{
	$code = $code . "\"${頁}\"=>array(" . NL;
	
	if( in_array( $頁, array_keys( $詩組_詩題 ) ) )
	{
		foreach( $子列陣 as $首碼 => $行子列陣 )
		{
			if( is_string( $行子列陣 ) )
			{
				$code = $code . 
					" \"${首碼}\"=>\"${行子列陣}\"," . NL;
				continue;
			}
			$code = $code . " \"${首碼}\"=>array(" . NL;
			//print_r( $行子列陣 );

			foreach( $行子列陣 as $行碼 => $句子列陣 )
			{
				if( is_string( $句子列陣 ) )
				{
					$code = $code . 
						"  \"${行碼}\"=>\"${句子列陣}\"," . NL;
					continue;
				}

				
				$code = $code . "   \"${行碼}\"=>array(" . NL;
				foreach( $句子列陣 as $句碼 => $字子列陣 )
				{
					$code = $code . "\"${句碼}\"=>array(";
					foreach( $字子列陣 as $字碼 => $字 )
					{
						$code = $code . "\"${字碼}\"=>\"${字}\",";
					}
					$code = $code . ")," . NL;
				}
				
				$code = $code . ")," . NL;
			}
			$code = $code . ")," . NL;
		}
	}
	else
	{
		foreach( $子列陣 as $行碼 => $句子列陣 )
		{
			if( is_string( $句子列陣 ) )
			{
				$code = $code . 
					" \"${行碼}\"=>\"${句子列陣}\"," . NL;
				continue;
			}

			$code = $code . " \"${行碼}\"=>array(" . NL;
			foreach( $句子列陣 as $句碼 => $字子列陣 )
			{
				if( is_string( $字子列陣 ) )
				{
					$code = $code . 
						"  \"${句碼}\"=>\"${字子列陣}\"," . NL;
					continue;
				}

				$code = $code . "   \"${句碼}\"=>array(";
				foreach( $字子列陣 as $字碼 => $字 )
				{
					$code = $code . "\"${字碼}\"=>\"${字}\",";
				}
				$code = $code . ")," . NL;
			}
				
			$code = $code . ")," . NL;
		}
	}
	$code = $code . ")," . NL;
}

$code = $code . ");
?>" . NL;
file_put_contents( 杜甫資料庫 . '杜甫詩陣列.php', $code );
file_put_contents( 程式文件夾 . '杜甫詩陣列.php', $code );

?>

