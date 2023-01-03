<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\函式測試.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 詩組_詩題 );
require_once( 頁碼_路徑 );

/*
// test getAnnotation
// 員外季弟執金吾，見知於代，故有下句
echo $頁碼_路徑[ '0048' ], 新行;
echo getAnnotation( $頁碼_路徑[ '0048' ] ), 新行;
*/

/*
// test getOrderOfPoem
// line 42 belongs to #6 其六
echo getOrderOfPoem( $詩組_詩題[ '0241' ][ 1 ], 42 ), 新行;
*/

/*
// test getPoem
echo getPoem( $頁碼_路徑[ '0241' ] ), 新行;
*/

/*
// test getLN
print_r( getLN( $頁碼_路徑[ '0048' ] ) );
*/

/*
// test getPreface
echo getPreface( $頁碼_路徑[ '5308' ] );
*/

// test getSection
/*
Array
(
    [0] => 浦起龍《讀杜心解》1.1、早稻田2.3
    [1] =>
    [2] => 【異文、夾注】
    [3] => 〚5.2.2〛音恣
    [4] =>
    [5] => 【注釋】
    [6] => 〚1〛按履歷，公遊齊魯，在開元二十五六年間。公集當以是爲首。
    [7] => 〚3.1.1〛《前漢·郊祀志》：岱宗，泰山也。
    [8] => 〚5.2.2〛《廣韻》：眥，目睫也。
    [9] =>
    [10] => 【評論】
    [11] => 公望嶽詩凡三首，此望東嶽也。越境連綿，蒼峯不斷，寫嶽勢只「青未了」三字，勝人千
    [12] => 百矣。「鍾神秀」，在嶽勢前推出；「割昏曉」，就嶽勢上顯出。「蕩胸」、「決眥」，
    [13] => 明逗「望」字。末聯則以將來之凌眺，剔現在之遙觀，是透過一層收也。仇氏詳註以遠望、
    [14] => 近望、細望、極望，分配四聯，未見清楚。
    [15] => ◯杜子心胸氣魄，於斯可觀。取爲壓卷，屹然作鎮。豈惟鐫剋年月云爾。
    [16] =>
    [17] => 【按語】
    [18] => 永明按：
    [19] => 「鐫剋年月」，指爲杜詩編年排序。
)

print_r( getSection( $頁碼_路徑[ '0003' ], '=浦' ) );
*/

/*
// test 提取簡化坐標
echo 提取簡化坐標("〚5.2.2〛"), 新行;         // 〚5.2.2〛
echo 提取簡化坐標("〚0003:5.2.2〛"), 新行;    // 〚5.2.2〛
echo 提取簡化坐標("〚0003:1:5.2.2〛"), 新行;  // 〚1:5.2.2〛
*/

/*
// test 提取首碼
echo 提取首碼("〚0003:1:5.2.2〛"), 新行; // 1
echo 提取首碼("〚12:5.2.2〛"), 新行;     // 12
echo 提取首碼("〚5.2.2〛"), 新行;        // 〚5.2.2〛
*/
/*
echo 提取頁碼( "〚0003:1:5.2.2〛" ), 新行; // 0003
echo 提取頁碼( "〚0003:5.2.2〛" ), 新行;   // 0003
echo 提取頁碼( "〚5.2.2〛" ), 新行;        // 〚5.2.2〛
*/
/*
echo 生成完整坐標( "〚0003:5.2.2〛", "0003" ), 新行;
echo 生成完整坐標( "〚5.2.2〛", "0013" ), 新行;
echo 生成完整坐標( "〚12:45.2.2〛", "0013" ), 新行;
echo 生成完整坐標( "〚0003:12:45.2.2〛", "0013" ), 新行;
*/
var_dump( getExpandedPages( '〚4〛' ) );
var_dump( getExpandedPages( '〚4.1〛' ) );
var_dump( getExpandedPages( '〚4.1.5〛' ) );
var_dump( getExpandedPages( '〚4.1.3-5〛' ) );

//var_dump( getExpandedPages( '〚4.1.4-5〛' ) );
//var_dump( getExpandedPages( '〚4.1.4-5〛' ) );
//var_dump( getExpandedPages( '〚4.1.4-5〛' ) );
//var_dump( getExpandedPages( '〚4.1.4-5〛' ) );
//var_dump( getExpandedPages( '〚4.1.4-5〛' ) );
?>
