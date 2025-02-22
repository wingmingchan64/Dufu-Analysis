<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成書本注釋.php 今 注釋
php h:\github\Dufu-Analysis\analysis_programs\生成書本注釋.php 楊 旁注
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

$前綴 = trim( $argv[ 1 ] );
$簡稱 = '=' . $前綴;
$種類 = trim( $argv[ 2 ] );
$陣列名 = "${前綴}内容";
$文件夾 = $書目簡稱[ $簡稱 ];
$文件名 = str_replace( ' ', '_', $書目簡稱[ $簡稱 ] );

$out_path = 杜甫資料庫 . "${文件夾}\\";
$code = "<?php\n
/*
生成：本文檔用 PHP 生成。
程式：生成書本注釋.php
說明：把${種類}集中在一個文檔裏。
*/
\$${文件名}${種類}=array(\n";

foreach( $頁碼 as $頁 )
{
	$頁路徑 = $out_path . "${頁}.php";
	//echo $頁路徑, "\n";

	if( file_exists( $頁路徑 ) )
	{
		require_once( $頁路徑 );
		//print_r( $$陣列名 );
		
		if( array_key_exists( $種類, $$陣列名 ) )
		{
			//echo $頁, "\n";
			
			if( $$陣列名[ $種類 ] == "" )
			{
				continue;
			}
			
			if( $$陣列名[ $種類 ] == 旁注 && intval( $頁 ) >=  59 )
			{
				continue;
			}
			
			if( is_array( $$陣列名[ $種類 ] ) )
			{
				foreach( $$陣列名[ $種類 ] as $坐標 => $内容 )
				{
					$坐標 = 生成完整坐標( $坐標, $頁 );
					$内容 = trim( $内容 );
					$code = $code . 
						"\"${坐標}\"=>\"${内容}\",\n";
				}
			}
			else
			{
				//echo $頁, NL;
				//echo $$陣列名[ $種類 ], NL;
				$content = $$陣列名[ $種類 ];
				$line = "\"〚${頁}:〛\"=>\"${content}\",\r\n";
				$code = $code . $line . NL;
			}
		}
	}
}

$code = $code . ");\n?>";
file_put_contents( $out_path . "${書目簡稱[ $簡稱 ]}${種類}.php", 
	$code );
$out_path = "h:\\github\Dufu-Analysis\\${書目簡稱[ $簡稱 ]}\\";
file_put_contents( $out_path . "${書目簡稱[ $簡稱 ]}${種類}.php", 
	$code );
?>