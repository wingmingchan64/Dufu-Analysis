<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成字典注釋.php 今 注釋

*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );
require_once( 杜甫資料庫 . '書目簡稱.php' );

if( sizeof( $argv ) < 3 )
{
	echo "必須提供簡稱、種類。", "\n";
	exit;
}

$簡稱 = '=' . $argv[ 1 ];
$種類 = $argv[ 2 ];
/*
$簡稱   = '=譯';
$簡稱   = '=今';
$種類   = '大意';
$種類   = '注釋';
*/
$文件夾 = $書目簡稱[ $簡稱 ];
$out_path = 杜甫資料庫 . "${文件夾}\\";
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