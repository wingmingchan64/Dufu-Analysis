<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫全集_版本.php 蕭
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );

if( sizeof( $argv ) < 2 )
{
	echo "必須提供簡稱。", "\n";
	exit;
}

$簡稱   = '=' . $argv[ 1 ];
/*
$簡稱 = '=蕭';
$簡稱 = '=默';
$簡稱 = '=全';
*/

$默認路徑 = 詩集文件夾;
$默認文檔路徑 = "";

if( $簡稱 != '=默' )
{
	$前綴 = trim( $簡稱, '=' );
	$陣列名 = "${前綴}内容";
	$書名 = $書目簡稱[ $簡稱 ];
	$outfile = 杜甫資料庫 . "${書名}\\杜甫全集.txt";
	$outfile_clean = 杜甫資料庫 . "${書名}\\杜甫全集無夾注.txt";

	$new_content = $書名 . "\n\n";
	$版本路徑 = 杜甫資料庫 . "${書名}\\";
}
else
{
	$new_content = "";
	$outfile = 杜甫資料庫 . "杜甫全集.txt";
	$outfile_clean = 杜甫資料庫 . "杜甫全集無夾注.txt";
}

// 全唐詩
if( $簡稱 == '=全' )
{
	require_once( 杜甫資料庫 . "${書名}\目錄.php" );
	$頁碼 = array_keys( $全目錄 );
}

foreach( $頁碼 as $頁 )
{
	//echo $頁, "\n";
	if( mb_strpos( $頁, ":" ) )
	{
		//echo $頁, "\n";
		continue;
	}
	$默認文檔路徑 = $默認路徑 . $頁 . ".php";
	require_once( $默認文檔路徑 );
	
	if( $簡稱 != '=默' )
	{
		$版本文檔路徑 = $版本路徑 . $頁 . '.php';
	
		if( file_exists( $版本文檔路徑 ) )
		{
			require_once( $版本文檔路徑 );

			//echo $頁, "\n";
		
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
		elseif( $簡稱 == '=蕭' )
		{
			$new_content = $new_content . $頁 . ' ' .
				trim( $内容[ "詩題" ] );
			if( in_array( "題注", array_keys( $内容 ) ) )
			{
				$new_content = $new_content .
					'[' . $内容[ "題注" ] . ']';
			}
			$new_content = $new_content . "\n\n";
			$new_content = $new_content . 
				$内容[ "詩文" ] . "\n\n";
		}
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
		$new_content = $new_content . 
			$内容[ "詩文" ] . "\n\n";
	}
}
// add msg and write to files
$msg = file_get_contents( 'msg.txt', true );
if( $簡稱 != '=默' )
{
	file_put_contents( $outfile, $new_content . $msg );
	file_put_contents( "h:\\github\\Dufu-Analysis\\" . $書目簡稱[ $簡稱 ] . "\\杜甫全集.txt", $new_content . $msg );
}
else
{
	file_put_contents( "h:\\github\\Dufu-Analysis\\杜甫全集.txt", $new_content . $msg );
}

$cleaned_text = 
	preg_replace( '/\[\X+?]/', '', $new_content );
file_put_contents( $outfile_clean, $cleaned_text . $msg );
if( $簡稱 != '=默' )
{
	file_put_contents( "h:\\github\\Dufu-Analysis\\" . $書目簡稱[ $簡稱 ] . "\\杜甫全集無夾注.txt", $cleaned_text . $msg );
}
else
{
	file_put_contents( "h:\\github\\Dufu-Analysis\\杜甫全集無夾注.txt", $cleaned_text . $msg );
}
?>