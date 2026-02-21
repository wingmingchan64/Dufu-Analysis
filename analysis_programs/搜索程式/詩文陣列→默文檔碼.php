<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩文陣列→默文檔碼.php 
=> 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

check_argv( $argv, 2, 提供詩文陣列 );
$詩文 = fix_text( trim( $argv[ 1 ] ) );
$詩文陣列 = explode( ',', $詩文 );
print_r( 提取詩文默詩碼陣列( $詩文陣列 ) );
?>