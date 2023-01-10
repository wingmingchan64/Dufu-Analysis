<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( "h:\\github\\Dufu-Analysis\\詩句_坐標.php" );

$四字組合_坐標陣列 = array();

foreach( $詩句_坐標 as $詩句 => $坐標 )
{
	$len = mb_strlen( $詩句 );
	$count = 0;
	
	while( $count < $len - 3 )
	{
		$組合 = mb_substr( $詩句, $count, 4 );
		
		$坐   = trim( $坐標, 坐標括號 );
		
		if( !array_key_exists( $組合, $四字組合_坐標陣列 ) )
		{
			$四字組合_坐標陣列[ $組合 ] = array();
		}
		
		$coor = 坐標開括號 . $坐 . '.' . 
			$count+1 . '-' . $count+4 . 坐標關括號;
		array_push( $四字組合_坐標陣列[ $組合 ], $coor );
		
		$count++;
	}
}

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：四字組合=>坐標。
*/
\$四字組合_坐標=array(\n";

foreach( $四字組合_坐標陣列 as $組合 => $坐標陣列 )
{
	$code = $code . "\"${組合}\"=>array(\n";
	
	foreach( $坐標陣列 as $坐標 )
	{
		$code = $code . "\"$坐標\",";
	}
	$code = substr( $code, 0, -1 );
	$code = $code . "),\n";
}
$code = substr( $code, 0, -2 );
$code = $code . "\n);\n?>";

file_put_contents( 'h:\github\Dufu-Analysis\四字組合_坐標.php', $code );
?>
