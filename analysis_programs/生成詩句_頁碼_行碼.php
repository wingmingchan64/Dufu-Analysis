<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '詩句_頁碼.php' );
$out_file  = 杜甫資料庫 . '詩句_頁碼_行碼.php';
$code      = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成詩句_頁碼_行碼.php
說明：詩句=>（頁碼，行碼）。
*/
\$詩句_頁碼_行碼=array(\n";
foreach( $詩句_頁碼 as $l => $ps )
{
	if( is_string( $ps ) )
	{
		$path = 詩集文件夾 . $ps . ".php";
		require_once( $path );
	}
	elseif( is_array( $ps ) ) // process the first one
	{
		$temp[ $l ] = $ps;
		continue;
	}
	
	$ln_array = $内容[ "行碼" ];
	
	// search for the line
	$pln = "";
	foreach( $ln_array as $ln => $dl )
	{
		// find the first instance in the ln
		if( mb_strpos( $dl, $l ) !== false )
		{
			$pln = $ln ;
			break;
		}
	}
	$code = $code . "\"" . $l . "\"=>array(" .
		"\"" . $ps . "\",\"" . $pln . "\"),\n";
}

$code = $code . 
"\"驊騮開道路\"=>array(array(\"0328\",\"〚6〛\"),array(\"2025\",\"〚4〛\")),
\"回首一茫茫\"=>array(array(\"0896\",\"〚3〛\"),array(\"3459\",\"〚15〛\")),
\"萬事反覆何所無\"=>array(array(\"1989\",\"〚9〛\"),array(\"1989\",\"〚10〛\")),
\"嗚呼\"=>array(array(\"2345\",\"〚15〛\"),array(\"2988\",\"〚16〛\")),
\"江花未落還成都\"=>array(array(\"2460\",\"〚15〛\"),array(\"2460\",\"〚16〛\")),
\"元年建巳月\"=>array(array(\"2591\",\"〚5〛\"),array(\"2591\",\"〚12〛\")),
\"干戈未偃息\"=>array(array(\"2856\",\"〚11〛\"),array(\"3319\",\"〚6〛\")),
\"此身醒復醉\"=>array(array(\"2879\",\"〚10〛\"),array(\"3135\",\"〚8〛\")),
\"得不哀痛塵再蒙\"=>array(array(\"2988\",\"〚15〛\"),array(\"2988\",\"〚16〛\")),
";
/*

*/
$code = substr( $code, 0, -1 );
$code = $code . "\n);\n?>";
file_put_contents( $out_file, $code );
file_put_contents( 杜甫分析文件夾 . '詩句_頁碼_行碼.php', $code );
//print_r( $temp );
?>