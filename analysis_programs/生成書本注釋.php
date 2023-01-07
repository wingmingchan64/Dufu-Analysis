<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );

$簡稱   = '=譯';
$種類   = '注釋';
$文件夾 = $書目簡稱[ $簡稱 ];
$out_path = "h:\\github\\Dufu-Analysis\\${文件夾}\\";
$code = "<?php\n\$${書目簡稱[ $簡稱 ]}${種類}=array(\n";

foreach( $頁碼 as $頁 )
{
	$頁路徑 = $out_path . "${頁}.php";

	if( file_exists( $頁路徑 ) )
	{
		require_once( $頁路徑 );
		
		if( array_key_exists( $種類, $内容 ) )
		{
			foreach( $内容[ $種類 ] as $坐標 => $内容 )
			{
				$坐標 = 生成完整坐標( $坐標, $頁 );
				$内容 = trim( $内容 );
				$code = $code . 
					"\"${坐標}\"=>\"${内容}\",\n";
			}
		}
	}
}

$code = $code . ");\n?>";
file_put_contents( $out_path . "${書目簡稱[ $簡稱 ]}${種類}.php", $code );
?>