<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫全集_版本.php 蕭

$簡稱 = '=蕭';
$簡稱 = '=默';
$簡稱 = '=全';
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

$前綴 = trim( $argv[ 1 ] );
$簡稱 = '=' . $前綴;

$默認路徑 = 詩集文件夾;
$默認文檔路徑 = "";

if( $簡稱 != '=默' )
{
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
	$temp_storage = array();
}

foreach( $頁碼 as $頁 )
{
	if( $頁 == "" )
	{
		continue;
	}
	if( $簡稱 == '=蕭' && $頁 == '1989' ) // 蕭缺此詩
	{
		continue;
	}
	//echo $頁, "\n";
	$首 = 0;
	$裸坐標 = "";
	if( mb_strpos( $頁, ":" ) )
	{
		$裸坐標 = $頁;
		$碼s = explode( ":", $頁 );
		$頁 = trim( $碼s[ 0 ] );
		$首 = intval( trim( $碼s[ 1 ], ":" ) );
		//echo $頁, "\n";
		//echo $首, "\n";
		//continue;
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
				if( $簡稱 == '=全' &&
					$裸坐標 != "" )
				{
					if( $全目錄[ $裸坐標 ][ 0 ] != "" )
					{
						$new_content = $new_content .
							$全目錄[ $裸坐標 ][ 0 ] .
							"\n\n";
					}
				}
				else
				{
					if( $頁 == "1395" || $頁 == "0241" )
					{
						$new_content = $new_content .
							"\n";
					}
					$new_content = $new_content . $頁 . ' ' . trim( $内容[ "詩題" ] );
					if( in_array( "題注", array_keys( $内容 ) ) )
					{
						$new_content = $new_content .
							'[' . $内容[ "題注" ] . ']';
					}
					$new_content = $new_content . "\n\n";
				}
			}

			if( is_array( $$陣列名[ "版本" ][ "詩文" ] ) )
			{
				//echo $頁, "\n";
				//echo $首, "\n";
				if( $首 != 0 )
				{
					//echo $首, "\n";
					$new_content = $new_content .
						$$陣列名[ "版本" ][ "詩文" ][ $首 - 1 ];
					// ad hoc code just to make it work
					if( $頁 == "1376" )
					{
						$temp_storage[ "1376:3:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 2 ];
						$temp_storage[ "1376:4:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 3 ];
						$temp_storage[ "1376:5:" ] =
							$$陣列名[ "版本" ][ "詩文" ][ 4 ];
					}
					
					if( $頁 == "1390" && $首 == 2 )
					{
						$new_content = $new_content .
						"\n" .
						$temp_storage[ "1376:3:" ] . "\n" .
						$temp_storage[ "1376:4:" ] . "\n" .
						$temp_storage[ "1376:5:" ] . "\n";
					}
					
				}
				else
				{
					foreach( $$陣列名[ "版本" ][ "詩文" ] as $詩 )
					{
						$new_content = $new_content .
							trim( $詩 ) . "\n";
					}
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