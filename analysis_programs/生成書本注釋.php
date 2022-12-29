<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );

$簡稱   = '=浦';
$文件夾 = $書目簡稱[ $簡稱 ];
$out_path = "h:\\github\\Dufu-Analysis\\${文件夾}\\";

$code = "<?php\n\$注釋=array(\n";


foreach( $頁碼 as $頁 )
{
	$頁路徑 = $out_path . "${頁}.php";
	//echo $頁路徑, "\n";
	if( file_exists( $頁路徑 ) )
	{
		require_once( $頁路徑 );
		
		foreach( $content[ "注釋" ] as $坐標 => $注釋 )
		{
			$坐標 = 生成完整坐標( $坐標, $頁 );
			$注釋 = trim( $注釋 );
			$code = $code . "\"${坐標}\"=>\"${注釋}\",\n";
		}
	}
	//$code = substr( $code, 0, -1 );
}

$code = $code . ");\n?>";
file_put_contents( $out_path . "注釋.php", $code );
?>