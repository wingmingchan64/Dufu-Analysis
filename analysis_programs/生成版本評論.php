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
生成程式：
php H:\github\Dufu-Analysis\analysis_programs\生成版本評論.php $簡稱
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
		
		if( array_key_exists( 評論, $$陣列名 ) && 
			is_string( $$陣列名[ 評論 ] ) )
		{
			$評論内容 = $$陣列名[ 評論 ]; // string
			// insert 仇引
			if( $簡稱 == '奭' && strpos( $評論内容, 仇引 ) !== false )
			{
				require_once( 杜詩詳註 . $頁 . 程式後綴 );
				$仇評論 = $仇内容[ 評論 ];
				
				if( is_string( $仇評論 ) )
				{
					$lines = explode( "\n", $仇評論 );
					
					foreach( $lines as $l )
					{
						if( strpos( $l, 引奭 ) !== false )
						{
							$l = str_replace( 引奭, '', $l );
							$l = 仇註引文 . $l;
							$評論内容 = str_replace( 仇引, $l, $評論内容 );
						}
					}
				}
			}
			$code .= "'〚$頁:〛'=>array(\n";
			//$parts = explode( "\n", $$陣列名[ 評論 ] );
			$parts = explode( "\n", $評論内容 );

			foreach( $parts as $p )
			{
				$code .= "'$p',\n";
			}
			$code .= "),\n";
		}
		elseif( array_key_exists( 評論, $$陣列名 ) && 
			is_array( $$陣列名[ 評論 ] ) )
		{
			$temp = array();

			foreach( $$陣列名[ 評論 ] as $頁首 => $評s )
			{
				$評論内容 = $評s;
				/*
				// insert 仇引
				if( $簡稱 == '奭' && strpos( $評論内容, 仇引 ) !== false )
				{
					echo "Requiring 2", NL;

					require_once( 杜詩詳註 . $頁 . 程式後綴 );
					echo "Requiring", NL;
				
					$評論 = $仇内容[ 評論 ];
				
					if( is_string( $評論 ) )
					{
						$lines = explode( "\n", $評論 );
						foreach( $lines as $l )
						{
							if( strpos( $l, 引奭 ) !== false )
							{
								$l = preg_replace( 夾注regex, '', $l );
								$l = str_replace( 仇引, $l, $評論内容 );
							}
						}
					}
				}
				*/
				
				if( !in_array( $頁首, $temp ) )
				{
					array_push( $temp, $頁首 );
					$code .= "'${頁首}'=>array(\n";
					//$子評s = explode( "\n", $評s );
					$子評s = explode( "\n", $評論内容 );
					
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