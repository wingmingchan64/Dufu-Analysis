<?php
require_once( '常數.php' );
require_once( 杜甫資料庫 . '用字_詩句.php' );
require_once( 杜甫資料庫 . '詩句_頁碼.php' );
require_once( 杜甫資料庫 . '用字_頻率.php' );

$char_page = array();
$chars     = array_keys( $用字_頻率 );

foreach( $chars as $ch )
{
	$ch_p  = array();
	$lines = $用字_詩句[ $ch ];
	
	foreach( $lines as $l )
	{
		$p = $詩句_頁碼[ $l ];
		
		if( !in_array( $p, $ch_p ) )
		{
			array_push( $ch_p, $p );
		}
	}
	if( !empty( $ch_p ) )
	{
		$char_page[ $ch ] = $ch_p;
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成用字_頁碼.php
說明：用字=>頁碼。。
*/
\$用字_頁碼=array(\n";

foreach( $char_page as $ch => $pages )
{
	$code = $code . '"' . $ch . "\"=>array(\n";

	foreach( $pages as $p )
	{
		if( is_string( $p ) )
		{
			$code = $code . '"' . $p . "\",";
		}
		elseif ( is_array( $p ) )
		{
			foreach( $p as $頁 )
			{
				//echo $ch, "\n";
				$code = $code . '"' . $頁 . "\",";
			}
		}
	}

	$code = $code . "),\n";
}
$code = substr( $code, 0, -2 );
$code = $code . ");\n?>";

file_put_contents( 杜甫資料庫 . '用字_頁碼.php', $code );
file_put_contents( 杜甫分析文件夾 . '用字_頁碼.php', $code );
?>