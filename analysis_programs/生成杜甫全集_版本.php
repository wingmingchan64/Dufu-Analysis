<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成杜甫全集_版本.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );

$簡稱 = '=蕭';
$前綴 = trim( $簡稱, '=' );
$陣列名 = "${前綴}内容";
$書名 = $書目簡稱[ $簡稱 ];
$outfile = "h:\\github\\Dufu-Analysis\\${書名}\\杜甫全集.php";
$new_content = $書名 . "\n\n";
$默認路徑 = "h:\\github\\Dufu-Analysis\\詩集\\";
$版本路徑 = "h:\\github\\Dufu-Analysis\\${書名}\\";

//$頁 = "0003";
foreach( $頁碼 as $頁 )
{
	$默認文檔路徑 = $默認路徑 . $頁 . '.php';
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
				trim( $内容[ "詩題" ] ) . "\n\n";
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
	else
	{
		$new_content = $new_content . $頁 . ' ' .
			trim( $内容[ "詩題" ] ) . "\n\n";
		$new_content = $new_content .
			trim( $内容[ "詩文" ] ) . "\n\n";
	}
}
$code = "<?php
\$詩文 = \"" . $new_content . "\";\n?>";

// add msg and write to files
//$msg = file_get_contents( 'msg.txt', true );
file_put_contents( $outfile, $code );

?>