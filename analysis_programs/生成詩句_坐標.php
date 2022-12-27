<?php
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
$page_path = ( "h:\\github\\Dufu-Analysis\\詩集\\" );

$code1 = "<?php
/*
生成：本文檔用 PHP 生成。
說明：坐標=>詩句。
*/
\$詩句_坐標=array(\n";

$code2 = "<?php
/*
生成：本文檔用 PHP 生成。
說明：詩句=>坐標。
*/
\$詩句_坐標=array(\n";

	foreach( $頁碼 as $p )
	{
		require_once( $page_path . $p . '.php' );
		
		foreach( $content[ "坐標_句" ] as $坐 => $句 )
		{
			$code1 = $code1 . "\"${坐}\"=>\"${句}\",\n";
			$code2 = $code2 . "\"${句}\"=>\"${坐}\",\n";
		}
	}
	
	// truncate last ,\n
	$code1 = substr( $code1, 0, -2 );
	$code2 = substr( $code2, 0, -2 );
	$code1 = $code1 . ");\n?>";
	$code2 = $code2 . ");\n?>";
	file_put_contents( 'h:\github\Dufu-Analysis\坐標_詩句.php', 
	$code1 );
	file_put_contents( 'h:\github\Dufu-Analysis\詩句_坐標.php', 
	$code2 );
?>