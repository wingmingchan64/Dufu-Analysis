<?php
// $poem_folder_path
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );

//$詩集路徑 = 杜甫資料庫;
//$頁 = "0003";
foreach( $頁碼 as $頁 )
{
	require_once( 詩集文件夾 . "$頁.php" );
	$坐標_字 = array();
	$坐標_句 = $内容[ "坐標_句" ];

	$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成坐標_用字.php
說明：坐標=>字。
*/
\$坐標_用字=array(\n";

	foreach( $坐標_句 as $坐標 => $句 )
	{
		$句坐標 = trim( $坐標, "〚〛" );
		for( $i = 0; $i < mb_strlen( $句 ); $i++ )
		{
			$字坐標 = '〚' . $句坐標 . '.' . $i+1 . '〛';
			$字 = mb_substr( $句, $i, 1 );
			$code = $code . "\"${字坐標}\"=>\"${字}\",\n";
		}
	}
	$code = substr( $code, 0, -2 );
	$code = $code . "\n);\n?>";
	file_put_contents( 詩集文件夾 . "${頁}坐標_用字.php", $code );
}