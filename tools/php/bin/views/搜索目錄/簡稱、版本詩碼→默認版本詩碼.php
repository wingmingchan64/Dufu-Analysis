<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索目錄\簡稱、版本詩碼→默認版本詩碼.php 全 3 
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 3, 提供簡稱、版本詩碼 );
$簡稱 = fix_text( trim( $argv[ 1 ] ) );
$版本詩碼 = 修復文檔碼( trim( $argv[ 2 ] ) );
$書目簡稱 = 提取數據結構( REGISTRY_DIR . '書目簡稱' );
$書名 = $書目簡稱[ $簡稱 ];

$版本詩碼_默詩碼 = 提取目錄( $書名 .DS . "${簡稱}詩碼_默詩碼" );

if( !array_key_exists( $版本詩碼, $版本詩碼_默詩碼 ) )
{
	$版本詩碼 .= '-1';
}

if( array_key_exists( $版本詩碼, $版本詩碼_默詩碼 ) )
{
	echo "〚${簡稱}${版本詩碼}:〛 → 〚" . 
		$版本詩碼_默詩碼[ $版本詩碼 ] . ":〛", NL;
}
else
{
	echo 無結果, NL;
}
?>