<?php
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
$page_path = ( "h:\\github\\Dufu-Analysis\\詩集\\" );

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：詩句=>坐標，坐標=>詩句。
*/
\$詩句_坐標=array(\n";	
	foreach( $頁碼 as $p )
	{
		require_once( $page_path . $p . '.php' );
		
		foreach( $content[ "坐標_句" ] as $坐 => $句 )
		{
			$code = $code . "\"${坐}\"=>\"${句}\",\n";
			$code = $code . "\"${句}\"=>\"${坐}\",\n";
		}
	}
	
	// truncate last ,\n
	$code = substr( $code, 0, -2 );
	$code = $code . ");\n?>";
	file_put_contents( 'h:\github\Dufu-Analysis\詩句_坐標.php', 
	$code );
?>