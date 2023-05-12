<?php
require_once( '常數.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
//$page_path = ( "h:\\github\\Dufu-Analysis\\詩集\\" );
//詩集文件夾
$code1 = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成詩句_坐標.php
說明：坐標=>詩句。
*/
\$坐標_詩句=array(\n";

$code2 = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成詩句_坐標.php
說明：詩句=>坐標。
*/
\$詩句_坐標=array(\n";
	// 同一句可以出現在不同詩中
	$句坐 = array();

	foreach( $頁碼 as $p )
	{
		require_once( 詩集文件夾 . $p . '.php' );
		
		foreach( $内容[ "坐標_句" ] as $坐 => $句 )
		{
			$code1 = $code1 . "\"${坐}\"=>\"${句}\",\n";
			if( !array_key_exists( $句, $句坐 ) )
			{
				$句坐[ $句 ] = $坐;
			}
			else
			{
				if( !is_array( $句坐[ $句 ] ) )
				{
					$句坐[ $句 ] = array( $句坐[ $句 ], $坐 );
				}
				else
				{
					array_push( $句坐[ $句 ], $坐 );
				}
			}
			//$code2 = $code2 . "\"${句}\"=>\"${坐}\",\n";
		}
	}
	
	foreach( $句坐 as $句 => $坐 )
	{
		if( !is_array( $坐 ) )
		{
			$code2 = $code2 . "\"${句}\"=>\"${坐}\",\n";
		}
		else
		{
			$code2 = $code2 . "\"${句}\"=>array(";
			foreach( $坐 as $coor )
			{
				$code2 = $code2 . "\"" . $coor . "\",";
			}
			$code2 = $code2 . "),\n";
		}
	}
	// truncate last ,\n
	$code1 = substr( $code1, 0, -2 );
	$code2 = substr( $code2, 0, -2 );
	$code1 = $code1 . ");\n?>";
	$code2 = $code2 . ");\n?>";
	file_put_contents( 杜甫資料庫 . '坐標_詩句.php', $code1 );
	file_put_contents( 杜甫資料庫 . '詩句_坐標.php', $code2 );
?>