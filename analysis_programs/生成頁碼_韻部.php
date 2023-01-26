<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );

$in_folder = 杜甫資料庫 . "陳永明《杜甫全集粵音注音》\\";
$頁碼out_file = 杜甫資料庫 . '頁碼_韻部.php';
$韻部out_file = 杜甫資料庫 . '韻部_頁碼.php';
$頁碼_韻部陣列 = array();
$韻部_頁碼陣列 = array();

$頁碼code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成頁碼_韻部.php
說明：頁碼=>韻部。
*/
\$頁碼_韻部=array(\n";
$韻部code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成頁碼_韻部.php
說明：韻部=>頁碼。
*/
\$韻部_頁碼=array(\n";

foreach( $頁碼 as $頁 )
{
	$file = $in_folder . "${頁}.php";
	
	if( file_exists( $file ) )
	{
		require_once( $file );
		
		foreach( $粵内容[ "韻部" ] as $坐標 => $字_韻部 )
		{
			$字_韻陣列 = explode( '：', $字_韻部 );
			echo $頁, "\n";
			print_r( $字_韻陣列 );
			$韻 = trim( $字_韻陣列[ 1 ] );
			
			if( !array_key_exists( $頁, $頁碼_韻部陣列 ) )
			{
				$頁碼_韻部陣列[ $頁 ] = array();
			}

			if( !in_array( $韻, $頁碼_韻部陣列[ $頁 ] ) )
			{
				array_push( $頁碼_韻部陣列[ $頁 ], $韻 );
			}
			
			if( !array_key_exists( $韻, $韻部_頁碼陣列 ) )
			{
				$韻部_頁碼陣列[ $韻 ] = array();
			}
			
			if( !in_array( $頁, $韻部_頁碼陣列[ $韻 ] ) )
			{
				array_push( $韻部_頁碼陣列[ $韻 ], $頁 );
			}
		}
	}
}
$code = "";
foreach( $頁碼_韻部陣列 as $頁 => $韻s )
{
	$code = $code . "\"${頁}\"=>array(";
	
	foreach( $韻s as $韻 )
	{
		$code = $code . "\"${韻}\",";
	}
	$code = substr( $code, 0, -1 );
	$code = $code . "),\n";
}

$code = $code . ");\n?>";
$頁碼code = $頁碼code . $code;
file_put_contents( $頁碼out_file, $頁碼code );

$code = "";
foreach( $韻部_頁碼陣列 as $韻 => $頁s )
{
	$code = $code . "\"${韻}\"=>array(";
	
	foreach( $頁s as $頁 )
	{
		$code = $code . "\"${頁}\",";
	}
	$code = substr( $code, 0, -1 );
	$code = $code . "),\n";
}

$code = $code . ");\n?>";
$韻部code = $韻部code . $code;
file_put_contents( $韻部out_file, $韻部code );

?>