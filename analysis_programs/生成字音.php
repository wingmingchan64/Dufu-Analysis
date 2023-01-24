<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );

$文件夾 = "h:\\github\\Dufu-Analysis\\陳永明《杜甫全集粵音注音》\\";
$out_file = "${文件夾}陳永明《杜甫全集粵音注音》字音.php";
$out_file2 = "${文件夾}陳永明《杜甫全集粵音注音》字音用字.php";

$code = "<?php
/*
生成：本文檔用 PHP 生成。
說明：杜詩用字粵語讀音，按部首、筆劃數排列。
*/
\$字音=array(\n";
$code2 = "<?php
/*
生成：本文檔用 PHP 生成。
說明：杜詩用字粵語讀音檢索。
*/
\$音字=array(\n";

$字音陣列 = array();
$音字陣列 = array();

foreach( $頁碼 as $頁 )
{
	$頁路徑 = $文件夾 . "${頁}.php";

	if( file_exists( $頁路徑 ) )
	{
		require_once( $頁路徑 );
		echo $頁路徑, "\n";
		foreach( $粵内容[ "字音" ] as $字 => $音陣列 )
		{
			if( !array_key_exists( $字, $字音陣列 ) )
			{
				$字音陣列[ $字 ] = $音陣列;
			}
			else
			{
				foreach( $音陣列 as $音 )
				{
					if( !in_array( $音, $字音陣列[ $字 ] ) )
					{
						array_push( $字音陣列[ $字 ], $音 );
					}
				}
			}
			
			foreach( $音陣列 as $字音 )
			{
				if( !array_key_exists( $字音, $音字陣列 ) )
				{
					$音字陣列[ $字音 ] = array();
				}
				if( !in_array( $字, $音字陣列[ $字音 ] ) )
				{
					array_push( $音字陣列[ $字音 ], $字 );
				}
			}
		}
	}
}

ksort( $字音陣列 );
ksort( $音字陣列 );

foreach( $字音陣列 as $字 => $音陣列 )
{
	$code = $code . "\"${字}\"=>array(";
	foreach( $音陣列 as $音 )
	{
		$code = $code . "\"${音}\",";
	}
	$code = substr( $code, 0, -1 );
	$code = $code . "),\n";
}
$code = substr( $code, 0, -2 );		
$code = $code . ");\n?>";
file_put_contents( $out_file, $code );

foreach( $音字陣列 as $音 => $字陣列 )
{
	$code2 = $code2 . "\"${音}\"=>array(";
	sort( $字陣列 );
	foreach( $字陣列 as $字 )
	{
		$code2 = $code2 . "\"${字}\",";
	}
	$code2 = substr( $code2, 0, -1 );
	$code2 = $code2 . "),\n";
}
$code2 = substr( $code2, 0, -2 );		
$code2 = $code2 . ");\n?>";
file_put_contents( $out_file2, $code2 );

?>