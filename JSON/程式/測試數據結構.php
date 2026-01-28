<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\測試數據結構.php
*/
require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"常數.php" );
require_once( 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"函式.php" );
//print_r( 提取數據結構( 七字組合_坐標 ) );
// 坐標
$字碼_詩字 = 提取數據結構( 字碼_詩字 );
$字 = "再";
$詞 = "胡馬大宛名";


//print_r( $字碼_詩字[ $字 ] );
//print_r( $數字對照[ mb_strlen( $詞 ) ] );
//print_r( 提取數據結構( 數字對照陣列[ mb_strlen( $詞 ) ] )[ $詞 ] );
//print_r( 提取詩文坐標( $詞 ) );

//print_r( 提取詩文默詩碼( array( "乾坤", "醉", "大" ) ) );
//print_r( 提取詩陣列( "0013-1" ) );
echo 杜甫詩陣列首ToString( 提取詩陣列( "0003" ), true, false, true, true );
?>

