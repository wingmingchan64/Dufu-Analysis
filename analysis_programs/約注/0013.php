<?php
/*
爲
h:\github\Dufu-Analysis\analysis_programs\生成約注.php
提供所需資料，用以生成某詩的注本。
*/
require_once( 'h:\github\Dufu-Analysis\analysis_programs\常數.php' );
require_once( 'h:\github\Dufu-Analysis\analysis_programs\函式.php' );

$頁碼 = '0013';
$約注_陣列 = array(
	提取詩文末字坐標( $頁碼, '石門' )  => 
		提取内容( "〚1:6.2.1-2〛", $頁碼, '=今', 注釋 ),
	提取詩文末字坐標( $頁碼, '乘興杳' )  => '杳【jiu2】',
	提取詩文末字坐標( $頁碼, '伐木丁丁' )  => '丁【丁丁：zang1，象聲詞，伐木聲。】',	
	提取詩文末字坐標( $頁碼, '霽潭鱣發發' )  => '發【發發：but6，象聲詞，魚跳動貌。】',	
	提取詩文末字坐標( $頁碼, '杜酒' )  => 
		提取内容( "〚2:14.1.1-2〛", $頁碼, '=楊', 注釋 ),
);
?>