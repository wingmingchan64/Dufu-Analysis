<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成郭目錄.php
 */
require_once( 
	dirname( __DIR__, 3) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$簡稱 = '郭';
$書目簡稱 = 提取數據結構( 書目簡稱 );
$書名 = $書目簡稱[ $簡稱 ];
$目錄 = __DIR__ . DS . "${簡稱}目錄.txt";

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
//echo $file, NL;

$contents = '[';

foreach( $lines as $line )
{
	$parts = explode( ' ', $line );
	$題 = $parts[ 0 ];
	$默詩碼 = $parts[ 2 ];
	
	// ad hoc logic to deal with special grouping of poems
	if( mb_strpos( $默詩碼, '-' ) )
	{
		$curr_id = substr( $默詩碼, 0, 4 );
		
		if( $prev_id == '3694' && $curr_id == '3702' )
		{
			$counter--;
			$sub_counter++;
			$prev_id = $curr_id;
			$版詩碼 = str_pad( $counter, 4, '0', STR_PAD_LEFT );
			$版詩碼 .= '-' . $sub_counter;
		}
		elseif( ( $prev_id == '1376' && $curr_id == '1197' ) ||
			( $prev_id == '1390' && $curr_id == '1376' ) )
		{
			$counter--;
			$sub_counter++;
			$prev_id = $curr_id;
			$版詩碼 = str_pad( $counter, 4, '0', STR_PAD_LEFT );
			$版詩碼 .= '-' . $sub_counter;
		}
		elseif( $prev_id != $curr_id )
		{
			$prev_id = $curr_id;
			$sub_counter = 1;
			$版詩碼 = str_pad( $counter, 4, '0', STR_PAD_LEFT );
			$版詩碼 .= '-' . $sub_counter;
		}
		else
		{
			$counter--;
			$sub_counter++;
			$版詩碼 = str_pad( $counter, 4, '0', STR_PAD_LEFT );
			$版詩碼 .= '-' . $sub_counter;
		}
		
		if( $題 == '屏跡' )
		{
			$版詩碼 = substr( $版詩碼, 0, 4 );
		}
		
		if( $默詩碼 == '3694-1' )
		{
			$默詩碼 = substr( $默詩碼, 0, 4 );
		}

		$counter++;
	}
	else
	{
		$版詩碼 = str_pad( $counter, 4, '0', STR_PAD_LEFT );
		$counter++;
		
		if( $默詩碼 == '3052' )
		{
			if( mb_strpos( $題, '巴西' ) !== false )
			{
				$默詩碼 .= '-1';
			}
			else
			{
				$默詩碼 .= '-2';
			}
		}
	}
	
	$頁s = explode( ',', $parts[ 3 ] );
	$臺頁 = str_replace( '臺PDF', '', $頁s[0] );
	$中頁 = str_replace( '中PDF', '', $頁s[1] );
	$四頁 = '1068-' . str_replace( '四', '', $頁s[2] );
	$聶頁 = str_replace( '聶', '', $頁s[3] );

	$contents .= 
"{\"詩題\":\"${題}\",\"默詩碼\":\"${默詩碼}\",\"${簡稱}詩碼\":\"${版詩碼}\",\"所在頁\":{\"臺北\":{\"電子書\":\"${臺頁}\"},\"中華\":{\"電子書\":\"${中頁}\"},\"四庫\":{\"電子書\":\"${四頁}\"},\"聶巧平\":{\"實體書\":\"${聶頁}\"}}},";
	
}
$contents = rtrim( $contents, ',' ) . ']';
//echo $contents, NL;

file_put_contents(
	__DIR__ . DS . "${簡稱}目錄.json",
	$contents . PHP_EOL );

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
?>