<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\生成數據結構.php
*/

require_once(
	dirname( __DIR__, 1 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

/*
 * 生成：默認詩文檔碼.json
 */
require( 'ids\生成默認詩文檔碼.php' );

/*
 * 生成：默認版本詩碼.json
 */
require( 'ids\生成默認版本詩碼.php' );

/*
 * 生成：默認文檔碼_默認詩碼.json
 */
require( 'ids\生成默認詩文檔碼_默認詩碼.php' );

 

require( 'mapping\生成默認詩文檔碼_詩題.php' );


// after 默認版本詩碼
/*
 * 生成：.json
 */
// after base_text
require( 'coords\生成詩碼坐標.php' );
// after 默認詩文檔碼、帶序言之詩、組詩_副題
require( 'coords\生成坐標_詩文.php' );
// after 默認詩文檔碼、默認詩文檔碼_序言、組詩_副題、句碼_詩句
require( 'coords\生成默認詩文檔碼_完整坐標表.php' );
// after 數字對照陣列
require( 'coords\生成默認詩文檔碼_詩文_坐標.php' );
// after 完整坐標表
require( 'coords\生成含範圍完整字碼坐標.php' );
// after 完整坐標表
require( 'coords\生成非完整坐標.php' );
// after 完整坐標表
require( 'coords\生成完整坐標_路徑陣列.php' );
// after 行碼_詩文
require( 'coords\生成默認詩文檔碼_單句行坐標.php' );
// after 句碼_詩句
require( 'coords\生成默認詩碼_句坐標.php' );
//require( 'coords\' );
//require( 'coords\' );
//require( 'coords\' );


require( 'mapping\生成組詩_副題.php' );
require( 'mapping\生成默認詩文檔碼_序言.php' );
require( 'mapping\生成默認詩文檔碼_行碼_內容.php' );
// after 行碼_詩文
require( 'mapping\生成默認詩文檔碼_詩文.php' );
require( 'mapping\生成默認詩文檔碼_詩文黑名單.php' );







// 5 files per book
require( 'catalog\生成默詩碼_版本詩碼.php' );
// 2 files
require( 'catalog\生成版本目錄對照表.php' );

// 1457 files in base_text
require( 'base_text\生成杜甫詩陣列.php' );

?>