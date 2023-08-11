<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
$out_file  = 杜甫資料庫 . '詩句_頁碼.php';
$code      = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成詩句_頁碼.php
說明：單句詩句=>頁碼。
*/
\$詩句_頁碼=array(\n";
//$count = 0;
$temp = array();

foreach( $頁碼 as $p )
{
	$path = 詩集文件夾 . $p . ".php";
	require_once( $path );
	$line = $内容[ "詩句" ];

	foreach( $line as $l )
	{
		if( !array_key_exists( $l, $temp ) )
		{
			$temp[ $l ] = $p;
		}
		elseif( is_array( $temp[ $l ] ) )
		{
			//echo "Array\n";
			array_push( $temp[ $l ], $p );
		}
		elseif( is_string( $temp[ $l ] ) )
		{
			$first = $temp[ $l ];
			$temp[ $l ] = array( $first, $p );
		}
	}
}
foreach( $temp as $詩句 => $頁碼s )
{
	if( is_string( $頁碼s ) )
	{
		$code = $code . "\"" . $詩句 . "\"=>\"" .
			$頁碼s . "\",\n";
	}
	elseif( is_array( $頁碼s ) )
	{
		//echo "Array\n";
		$code = $code . "\"" . $詩句 . "\"=>array(\n";
		
		foreach( $頁碼s as $頁 )
		{
			$code = $code . "\"${頁}\",";
		}
		
		$code = $code . "),\n";
	}
}

$code = substr( $code, 0, -1 );
$code = $code . "\n);\n?>";
file_put_contents( $out_file, $code );
file_put_contents( 杜甫分析文件夾 . '詩句_頁碼.php', $code );
?>