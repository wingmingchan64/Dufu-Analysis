<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\test.php
*/
require_once( "函式.php" );

/*
echo 提取詩句( "〚0022:5.2〛" ), NL;
echo 提取詩句( "〚0013:2:12.1〛" ), NL;
echo 提取頁碼( "〚0013:2:12.1〛" ), NL;
echo 提取首碼( "〚0022:5.2〛" ), NL;
echo 提取行碼( "〚0013:2:12.1〛" ), NL;
echo 提取句碼( "〚0013:2:12.1〛" ), NL;
*/
echo 提取詩句( "〚0022:5.2〛" ), NL;
echo 提取詩文( "〚0022:5.2.1-5〛" ), NL;

/*
php H:\github\Dufu-Analysis\analysis_programs\test.php

//require_once( "h:\\github\\Dufu-Analysis\\用字_頻率.php" );
//require_once( "h:\\github\\Dufu-Analysis\\用字_部首.php" );

require_once( 'H:\github\Dufu-Analysis\詩集\0079.php' );
require_once( 'H:\github\Dufu-Analysis\蕭滌非主編《杜甫全集校注》\0079.php' );
$詩文 = $内容["詩文"];
print_r( $蕭内容["版本"]["坐標版本異文、夾注"] );
foreach( $蕭内容["版本"]["坐標版本異文、夾注"] as $坐 => $異文、夾注 )
{
	$異文 = explode( '〗', $異文、夾注 );
	$默認 = mb_substr( $異文[0], 1);
	//echo $默認, '=>', $異文[1], "\n";
	$詩文 = str_replace( $默認, $異文[1], $詩文 );
}
echo $詩文;
*/
/*
東藩駐皁蓋。北渚凌青荷。海右此亭古。濟南名士多。雲山已發興。玉佩仍當歌。修竹不受暑。交流空湧波。蘊眞愜所遇。落日將如何。貴賤俱物役。從公難重過。

東藩駐皂蓋。北渚淩青荷。海右此亭古。濟南名士多。雲山已發興。玉佩仍當謌。修竹不受暑。交流空湧波。蘊真愜所遇。落日將如何。貴賤俱物役。從公難重過。
*/
/*
$haystack = "sing4 hing3 miu5 jin4 mai4 ceot1 cyu5/cyu3";
$needle   = "sing4 hing3 miu5 jin4";
$needle   = "sing4 hing3 miu5 jin4 mai4 ceot1 cyu5";
echo
containsPronunciation( $haystack, $needle ) ? "yes" : "no", "\n";
*/
?>

