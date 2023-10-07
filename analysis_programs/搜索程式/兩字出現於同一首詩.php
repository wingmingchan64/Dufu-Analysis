<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\兩字出現於同一首詩.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\github\\Dufu-Analysis\\用字_頁碼.php" );
//require_once( "h:\\github\\Dufu-Analysis\\坐標_詩句.php" );

$字1 = "愁";
$字2 = "酒";
$字1_頁碼 = $用字_頁碼[ $字1 ];
$字2_頁碼 = $用字_頁碼[ $字2 ];

//print_r( $字1_頁碼 );
//print_r( $字2_頁碼 );

$同頁列陣 = array_intersect( $字1_頁碼, $字2_頁碼 );
print_r( $同頁列陣 );
/*
Array
(
    [0] => 0276 賦料揚雄敵，詩看子建親。
    [7] => 4892
    [9] => 5763
)

*/
?>
