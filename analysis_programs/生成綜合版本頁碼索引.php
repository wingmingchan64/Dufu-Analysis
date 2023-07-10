<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成綜合版本頁碼索引.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
require_once( 杜甫資料庫 . '頁碼_詩題.php' );

$簡稱s = array( '蕭', '全', '仇', '浦' );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成綜合版本頁碼索引.php
說明：不同注本頁碼。
*/
\$頁碼_各版本頁碼=array(\n";
foreach( $簡稱s as $簡稱 )
{
	require_once( 杜甫資料庫 . $書目簡稱[ '=' . $簡稱 ] . "\\" .
		$書目簡稱[ '=' . $簡稱 ] . '頁碼索引.php' );
}

foreach( $頁碼 as $頁 )
{
	$詩題 = $頁碼_詩題[ $頁 ];
	$code = $code . "\"${頁}\"=>array(\n\"${詩題}\",\n";
	
	foreach( $簡稱s as $簡稱 )
	{
		$列陣名 = "頁碼_${簡稱}頁碼";
		
		if( array_key_exists( $頁, $$列陣名 ) )
		{
			$code = $code . "\"" . $書目簡稱[ '=' . $簡稱 ] .
			$$列陣名[ $頁 ] . "\",\n";
		}
	}
	$code = $code . "),\n";
}
$code = $code . ");\n?>";
file_put_contents( 杜甫資料庫 . "\\綜合版本頁碼索引.php", $code );

?>

