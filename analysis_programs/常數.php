<?php
const 杜甫資料庫 = "h:\\杜甫資料庫\\";
const 詩集文件夾 = "h:\\杜甫資料庫\\詩集\\";

const 杜甫分析文件夾  = "h:\\github\\Dufu-Analysis\\";
const 杜甫文件夾     = "h:\\github\\Dufu\\";
const 杜甫全集       = 'h:\github\DuFu\杜甫全集.txt';
const 杜甫全集粵音注音 = 'h:\github\DuFu\杜甫全集粵音注音.txt';
const 目錄          = 'h:\github\DuFu\目錄.txt';

// 字符
const 分隔線 =
"\n=====================================================\n";
const 新行 = "\n";
const 坐標開括號 = '〚';
const 坐標關括號 = '〛';
const 坐標括號 = "〚〛";
const 夾注regex = '/\[\X+?]/';

// php data files
const 異體字 = 'h:\github\Dufu-Analysis\異體字.php';
const 詩組_詩題 = 'h:\github\Dufu-Analysis\詩組_詩題.php';
const 頁碼_路徑 = 'h:\github\Dufu-Analysis\頁碼_路徑.php';

// 書名文件夾
const 全唐詩   = 杜甫資料庫 . "《全唐詩》\\";
const 杜詩詳註 = 杜甫資料庫 . "仇兆鰲《杜詩詳註》\\";
const 杜詩全集今注本 = 杜甫資料庫 . "張志烈主編《杜詩全集（今注本）》\\";
const 讀杜心解 = 杜甫資料庫 . "浦起龍《讀杜心解》\\";
const 杜臆    = 杜甫資料庫 . "王嗣奭《杜臆》\\";
const 杜甫全集校注 = 杜甫資料庫 . "蕭滌非主編《杜甫全集校注》\\";
const 杜甫全集粵音注音文件夾 = 杜甫資料庫 . "陳永明《杜甫全集粵音注音》\\";
const 杜甫詩全譯 = 杜甫資料庫 . "韓成武、張志民《杜甫詩全譯》\\";

// 書本部分
const 坐標 = '坐標';
const 内容 = "内容";
const 大意 = '大意';
const 行碼 = "行碼";
const 書名 = "書名";
const 版本 = "版本";
const 詩題 = "詩題";
const 詩文 = "詩文";
const 參數 = '參數';
const 注釋 = '注釋';
const 注音 = '注音';
const 譯文 = '譯文';
const 評論 = '評論';
const 校記 = '校記';
const 異文夾注 = '異文、夾注';
const 詩文注音 = '詩文注音';


// programs
const 選項指令 = "要搜索什麽？請輸入選項數字；用 exit 來結束。\n";
const 搜索程式文件夾 = "h:\\github\\Dufu-Analysis\\analysis_programs\\搜索程式\\";
const 搜索程式 = array(
	'以頁碼提取詩題' => "請輸入頁碼:\n",
	'以頁碼提取詩文' => "請輸入頁碼:\n",
	'以頁碼詩文用字提取坐標' => "請輸入頁碼 詩文用字:\n",
	'以詩題用字搜索詩題' => "請輸入詩題用字:\n",
);
const 程式後綴 = '.php';

?>