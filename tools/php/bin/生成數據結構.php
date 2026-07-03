<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\生成數據結構.php
*/
require_once(
	dirname( __DIR__, 1 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );
	
$step = 8;

switch( $step )
{
	case 1: // ids and mapping, 8 files
		// 生成：默認詩文檔碼.json
		require( 'ids\生成默認詩文檔碼.php' );
		// 生成：默認版本詩碼.json
		// depends on 手編的 $組詩_副題 for 0013-1, etc
		require( 'ids\生成默認版本詩碼.php' );
		// 生成：默認文檔碼_默認詩碼.json
		require( 'ids\生成默認詩文檔碼_默認詩碼.php' );
		// 生成：詩題_默認詩文檔碼.json, 默認詩文檔碼_詩題.json
		//     默認詩文檔碼_題注.json, 默認詩文檔碼_序言.json
		require( 'mapping\生成默認詩文檔碼_詩題.php' );
		//     組詩_副題.json
		require( 'mapping\生成組詩_副題.php' );
		break;
	case 2: // 3 files
		// after 默認版本詩碼
		// after base_text
		// 生成：默認詩碼坐標.json 〚0003:〛
		//     坐標_默認詩碼.json 〚0013:1:〛-> 0013-1
		//     默認詩碼_坐標.json
		require( 'coords\生成詩碼坐標.php' );
		break;
	case 3: // 18 files
		// after 默認詩文檔碼、帶序言之詩、組詩_副題
		// 生成：默認詩文檔碼_碼_字.json 0003->〚0003:3.1.1〛->岱
		//     字_碼.json 岱->〚0003:3.1.1〛
		//     行碼_詩文.json 〚0003:3〛->岱宗夫如何。齊魯青未了。
		//     行碼_副題.json 0013->〚0013:1:3〛->其一
		//     句碼_詩句.json 0003->〚0003:3.1〛->岱宗夫如何
		//     字碼_詩字.json 0003->〚0003:3.1.1〛->岱
		//     一字組合_坐標.json 岱->〚0003:3.1.1〛
		//     二字組合_坐標.json 岱宗->〚0003:3.1.1-2〛
		//     三字組合_坐標.json
		//     四字組合_坐標.json
		//     五字組合_坐標.json
		//     六字組合_坐標.json
		//     七字組合_坐標.json
		//     八字組合_坐標.json
		//     九字組合_坐標.json
		//     十字組合_坐標.json
		//     十一字組合_坐標.json
		//     坐標_句.json 〚0003:3.1〛->岱宗夫如何
		//     坐標_行.json 〚0003:3〛->岱宗夫如何。齊魯青未了。
		require( 'coords\生成坐標_詩文.php' );
		break;
	case 4: // 1137 files
		// after 默認詩文檔碼、默認詩文檔碼_序言、組詩_副題、句碼_詩句
		// 生成：默認詩文檔碼_字碼坐標.json
		//     默認詩文檔碼_行碼坐標.json
		//     含範圍行碼完整坐標.json
		//     默認詩文檔碼_完整坐標表.json
		//     完整坐標表/X.json
		require( 'coords\生成默認詩文檔碼_完整坐標表.php' );
		break;
	case 5: // 1 file
		// all combinations of char within segments
		require( 'coords\生成默認詩文檔碼_詩文_坐標.php' );
		break;
	case 6: // 9 files
		// after 數字對照陣列
		// after 完整坐標表
		// 生成：含範圍完整字碼坐標.json
		//     不含範圍完整字碼坐標.json
		require( 'coords\生成含範圍完整字碼坐標.php' );
		// after 完整坐標表
		// 生成：非完整坐標表.json
		require( 'coords\生成非完整坐標.php' );
		// after 完整坐標表，不含範圍
		// 生成：完整坐標_路徑陣列.json
		require( 'coords\生成完整坐標_路徑陣列.php' );
		// after 行碼_詩文
		// 生成：默認詩文檔碼_單句行坐標.json
		require( 'coords\生成默認詩文檔碼_單句行坐標.php' );
		// after 句碼_詩句
		// 生成：默認詩碼_句坐標.json 0003->〚0003:3.1〛
		require( 'coords\生成默認詩碼_句坐標.php' );
		// after 行碼_詩文
		// 生成：默認詩文檔碼_行碼_內容.json
		// 內容 could be the empty string
		require( 'coords\生成默認詩文檔碼_行碼_內容.php' );
		// 生成：默認詩文檔碼_詩文.json
		// 0003->岱宗夫如何。齊魯青未了。造化鍾……
		require( 'mapping\生成默認詩文檔碼_詩文.php' );
		// 生成：默認詩文檔碼_詩文重見名單
		require( 'mapping\生成默認詩文檔碼_詩文黑名單.php' );
		break;
	case 7: //  files
		// 5 files per book
		require( 'catalog\生成默詩碼_版本詩碼.php' );
		// 2 files
		require( 'catalog\生成版本目錄對照表.php' );
		break;
	case 8: //  files
		//生成：杜甫詩陣列.json
		//    組詩樹.json
		// 1457 files in base_text
		require( 'base_text\生成杜甫詩陣列.php' );
		require( 'base_text\生成組詩樹.php' );
		break;
/*
//require( 'coords\' );
//require( 'coords\' );
//require( 'coords\' );
*/
}
?>