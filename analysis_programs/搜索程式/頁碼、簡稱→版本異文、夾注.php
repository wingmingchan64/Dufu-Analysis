<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→版本異文、夾注.php 0824 名
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
require_once( 頁碼 );

check_argv( $argv, 3, 提供頁、簡 );
$result = array();
$頁 = fix_doc_id( trim( $argv[ 1 ] ) );

if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}
require_once( 詩集文件夾 . $頁 . 程式後綴 );

$簡稱 = fix_text( trim( $argv[ 2 ] ) );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無簡稱, NL;
	exit;
}
// 提取資料
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$陣列名 = "${簡稱}内容";
require_once( 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴 );
$content = '';

if( !array_key_exists( 詩題, $$陣列名[ 版本 ] ) )
{
	$content = $内容[ 詩題 ];
}
else
{
	$content = $$陣列名[ 版本 ][ 詩題 ];
}

if( is_array( $$陣列名[ 版本 ][ 詩文 ] ) )
{
	foreach( $$陣列名[ 版本 ][ 詩文 ] as $詩 )
	{
		$content = 
			$content . NL . NL . $詩;
	}
}
elseif( is_string( $$陣列名[ 版本 ][ 詩文 ] ) )
{
	$content = $content . NL . NL . $$陣列名[ 版本 ][ 詩文 ];
}
echo $content, NL;
?>