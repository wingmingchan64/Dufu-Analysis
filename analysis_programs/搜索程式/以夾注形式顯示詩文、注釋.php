<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以夾注形式顯示詩文、注釋.php 0003 仇
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以夾注形式顯示詩文、注釋.php 0003 今
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫資料庫 . "書目簡稱.php" );
require_once( 杜甫資料庫 . "頁碼.php" );
require_once( 杜甫資料庫 . "頁碼_詩題.php" );

if( sizeof( $argv ) != 3 )
{
	echo "必須提供頁碼、版本簡稱。", "\n";
	exit;
}
$result = array();
$頁 = trim( $argv[ 1 ] );

if( !in_array( $頁, $頁碼 ) )
{
	echo "頁碼不存在。\n";
	exit;
}

$簡稱 = trim( $argv[ 2 ] );
$書名 = $書目簡稱[ '=' . $簡稱 ];
$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
$陣列名 = "${簡稱}内容";
require_once( $默認路徑 );
require_once( $版本路徑 );

$詩題 = $内容[ 詩題 ];
$詩文 = str_replace( $頁, '', implode( "\n\n", array_values( $内容[ 行碼 ] ) ) );

foreach( array_values( $$陣列名[ 注釋 ] ) as $注 )
{
	if( mb_strpos( $注, "："  ) !== false ) // 題注
	{
		$note = explode( "：", $注 );
		$term = $note[ 0 ];
		$詩文 = str_replace( $term, "〖${term}〗", $詩文 );
	}
}
foreach( array_values( $$陣列名[ 注釋 ] ) as $注 )
{
	if( mb_strpos( $注, "："  ) === false ) // 題注
	{
		$詩文 = str_replace( $詩題, $詩題 . "\n[" . $注 . ']', $詩文 );
	}
	else
	{
		$note = explode( "：", $注 );
		$term = $note[ 0 ];
		$exp  = trim( $note[ 1 ], '。' );
		$詩文 = str_replace( "〖${term}〗", $term . "[" . $exp . ']', $詩文 );
	}
}


print_r( $詩文 );
/*
2552, 2628 */
?>