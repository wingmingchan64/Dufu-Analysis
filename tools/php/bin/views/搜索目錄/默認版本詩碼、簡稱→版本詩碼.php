<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索目錄\默認版本詩碼、簡稱→版本詩碼.php 3 全
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 3, 提供默詩碼、簡稱 );

$默詩碼 = 修復文檔碼( trim( $argv[ 1 ] ) );
echo $默詩碼, NL;
$簡稱 = fix_text( trim( $argv[ 2 ] ) );
$書目簡稱 = 提取數據結構( REGISTRY_DIR . '書目簡稱' );
$書名 = $書目簡稱[ $簡稱 ];
if( 是組詩( $默詩碼 ) && strpos( $默詩碼, '-' ) === false   )
{
	$默詩碼 .= '-1';
}

$默詩碼_版本詩碼 = 提取目錄( $書名 . DS . 'catalog' . DS .
	"默詩碼_${簡稱}詩碼" );
$版本詩碼 = $簡稱 . str_replace( '-', ':', $默詩碼_版本詩碼[ $默詩碼 ] );
$默詩碼 = str_replace( '-', ':', $默詩碼 );
echo "〚${默詩碼}:〛 → 〚${版本詩碼}:〛" . NL;



//print_r( $result );
?>