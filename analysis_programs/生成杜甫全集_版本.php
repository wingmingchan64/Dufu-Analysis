<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫全集_版本.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );

$簡稱 = '=蕭';
$簡稱 = '=全';
$前綴 = trim( $簡稱, '=' );
$陣列名 = "${前綴}内容";
$書名 = $書目簡稱[ $簡稱 ];
$outfile = "h:\\github\\Dufu-Analysis\\${書名}\\杜甫全集.txt";
$outfile_clean = "h:\\github\\Dufu-Analysis\\${書名}\\杜甫全集無夾注.txt";

$new_content = $書名 . "\n\n";
$默認路徑 = "h:\\github\\Dufu-Analysis\\詩集\\";
$版本路徑 = "h:\\github\\Dufu-Analysis\\${書名}\\";
$默認文檔路徑 = "";
// 全唐詩

if( $簡稱 == '=全' )
{
	$目錄 = file_get_contents( "h:\\github\\Dufu-Analysis\\${書名}\目錄.txt" );
	$lines = explode( "\n", $目錄 );
	$頁碼 = array();
	
	foreach( $lines as $l )
	{
		if( $l !== "" )
		{
			array_push( $頁碼, 
				trim( explode( ',', $l )[ 2 ] ) );
		}
	}
}

foreach( $頁碼 as $頁 )
{
	$默認文檔路徑 = $默認路徑 . $頁 . ".php";
	require_once( $默認文檔路徑 );
	
	$版本文檔路徑 = $版本路徑 . $頁 . '.php';
	
	if( file_exists( $版本文檔路徑 ) )
	{
		require_once( $版本文檔路徑 );

		if( array_key_exists( "詩題", $$陣列名[ "版本" ] ) )
		{
			//echo $$陣列名[ "版本" ][ "詩題" ], "\n";
			$new_content = $new_content . $頁 . ' ' .
				trim( $$陣列名[ "版本" ][ "詩題" ] ) . "\n\n";
		}
		else
		{
			$new_content = $new_content . $頁 . ' ' .
				trim( $内容[ "詩題" ] );
			if( in_array( "題注", array_keys( $内容 ) ) )
			{
				$new_content = $new_content .
					'[' . $内容[ "題注" ] . ']';
			}
			$new_content = $new_content . "\n\n";
		}

		if( is_array( $$陣列名[ "版本" ][ "詩文" ] ) )
		{
			foreach( $$陣列名[ "版本" ][ "詩文" ] as $詩 )
			{
				$new_content = $new_content .
					trim( $詩 ) . "\n";
			}
			$new_content = $new_content . "\n";
		}
		else
		{
			$new_content = $new_content .
				trim( $$陣列名[ "版本" ][ "詩文" ] ) . "\n\n";
		}
	}
}

// add msg and write to files
$msg = file_get_contents( 'msg.txt', true );
file_put_contents( $outfile, $new_content . $msg );

$cleaned_text = 
	preg_replace( '/\[\X+?]/', '', $new_content );
file_put_contents( $outfile_clean, $cleaned_text . $msg );


?>