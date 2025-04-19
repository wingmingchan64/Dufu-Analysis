<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\版本詩文.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

// 想要的版本
$版本 = '=蕭';
// 頁碼
$頁  = '0079';
echo 提取版本詩文( $版本, $頁), NL;
print_r( 提取版本坐標版本異文、夾注( $版本, $頁) );
?>
