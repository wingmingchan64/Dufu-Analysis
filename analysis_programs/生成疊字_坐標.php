<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成疊字_坐標.php
*/
require_once( '常數.php' );
require_once( 杜甫資料庫 . '二字組合.php' );
require_once( 杜甫資料庫 . '二字組合_坐標.php' );

$疊字 = array();
$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成疊字.php
說明：疊字=>坐標。
*/
\$疊字_坐標=array(\n";

foreach( array_keys( $二字組合 ) as $組合 ) 
{
	if( mb_substr( $組合, 0, 1 ) == mb_substr( $組合, 1, 1 ) )
	{
		$坐標 = $二字組合_坐標[ $組合 ];
		
		foreach( $坐標 as $坐 )
		{
			$坐標s = explode( '-', $坐 );
			$坐標1 = $坐標s[ 0 ] . '〛';
			$坐標2 = substr( $坐標s[ 0 ], 0, strlen( $坐標s[ 0 ] ) - 1 ) .
				$坐標s[ 1 ];
			//array_push( $疊字, $組合 );
			if( !array_key_exists( $組合, $疊字 ) )
			{
				$疊字[ $組合 ] = array( $坐標1, $坐標2 );
			}
			else
			{
				array_push( $疊字[ $組合 ], $坐標1 );
				array_push( $疊字[ $組合 ], $坐標2 );
			}
		}
	}
}
foreach( $疊字 as $組合 => $坐標s )
{
	$code .= "\"${組合}\"=>array(";
	foreach( $坐標s as $坐標 )
	{
		$code .= "\"${坐標}\",";
	}
	$code .= "),\n";
}
$size = sizeof( $疊字 );
$code = $code . "\n); // size: ${size}
\n?>";
file_put_contents( 杜甫資料庫 . '疊字_坐標.php', $code );
file_put_contents( 杜甫分析文件夾 . '疊字_坐標.php', $code );
?>