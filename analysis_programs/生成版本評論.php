<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成版本評論.php 名
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 書目簡稱 );
require_once( 頁碼 );

checkARGV( $argv, 2, 提供簡稱 );
$簡稱 = trim( $argv[ 1 ] );
$result = array();

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . "${書名}評論" . 程式後綴;
$陣列名 = $簡稱 . '内容';

$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式： php H:\github\Dufu-Analysis\analysis_programs\生成版本評論.php $簡稱
說明：本文檔儲存${書名}評論。
應用程式： 
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→評論.php 0003 $簡稱
*/
\$${簡稱}評論=array(\n";
	
foreach( $頁碼 as $頁 )
{
	//echo $頁, NL;
	if( file_exists( 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴 ) )
	{
		require_once( 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴 );
		
		if( is_string( $$陣列名[ 評論 ] ) )
		{
			$code .= "'〚$頁:〛'=>array(\n";
			$parts = explode( "\n", $$陣列名[ 評論 ] );

			foreach( $parts as $p )
			{
				$code .= "'$p',\n";
			}
			$code .= "),\n";
		}
		elseif( is_array( $$陣列名[ 評論 ] ) )
		{
			$temp = array();
			
			foreach( $$陣列名[ 評論 ] as $頁首 => $評s )
			{
				if( !in_array( $頁首, $temp ) )
				{
					array_push( $temp, $頁首 );
					$code .= "'${頁首}'=>array(\n";
					$子評s = explode( "\n", $評s);
					
					foreach( $子評s as $子評 )
					{
						$code .= "'$子評',\n";
					}
				}
				else
				{
					$code .= "'$評',\n";
				}
				$code .= "),\n";
			}
			//$code .= "),\n";
		}
	}
}
// truncate last ,\n
$code = substr( $code, 0, -2 );
$code = $code . ");\n?>";
file_put_contents( 杜甫資料庫 . $書名 . "\\" . $書名 . '評論.php', $code );
file_put_contents( 杜甫分析文件夾 . $書名 . "\\" . $書名 . '評論.php', $code );
//}
?>