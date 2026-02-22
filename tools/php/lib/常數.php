<?php
/*
杜甫資料庫編程部分所應用的 PHP 常數
*/
// 系統文件夾
const DS = DIRECTORY_SEPARATOR;
// packages
const PACKAGES_DIR = 'packages' . DS;
// schemas
const SCHEMAS_DIR = 'schemas' . DS;
const SCHEMAS_JSON_DIR = SCHEMAS_DIR . 'json' . DS;
// 基文
const SCHEMAS_JSON_BASE_TEXT_DIR = SCHEMAS_JSON_DIR . 'base_text' . DS;
// 坐標
const SCHEMAS_JSON_COORDS_DIR = SCHEMAS_JSON_DIR . 'coords' . DS;
// 身份
const SCHEMAS_JSON_IDS_DIR = SCHEMAS_JSON_DIR . 'ids' . DS;
// 映射
const SCHEMAS_JSON_MAPPING_DIR = SCHEMAS_JSON_DIR . 'mapping' . DS;
// 後設資料
const SCHEMAS_JSON_METADATA_DIR = SCHEMAS_JSON_DIR . 'metadata' . DS;
// 籍
const SCHEMAS_JSON_REGISTRY_DIR = SCHEMAS_JSON_DIR . 'registry' . DS;
// 集合
const SCHEMAS_JSON_SETS_DIR = SCHEMAS_JSON_DIR . 'sets' . DS;
const ANCHORS_DIR = 'anchors' . DS;
const BASE_TEXT_DIR = 'base_text' . DS;
const COORDS_DIR = 'coords' . DS;
const IDS_DIR = 'ids' . DS;
const MAPPING_DIR = 'mapping' . DS;
const METADATA_DIR = 'metadata' . DS;
const REGISTRY_DIR = 'registry' . DS;
const SETS_DIR = 'sets' . DS;

// tests
const TESTS_DIR = 'tests' . DS;
const TESTS_PHP_DIR = TESTS_DIR . 'php' . DS;
const TESTS_PYTHON_DIR = TESTS_DIR . 'python' . DS;
// tools
const TOOLS_DIR = 'tools' . DS;
const TOOLS_PHP_DIR = TOOLS_DIR . 'php' . DS;
const TOOLS_PHP_BIN_DIR = TOOLS_PHP_DIR . 'bin' . DS;
const TOOLS_PHP_BIN_ANNOTATIONS_DIR = TOOLS_PHP_BIN_DIR . 'annotations' . DS;
const TOOLS_PHP_BIN_BASE_TEXT_DIR = TOOLS_PHP_BIN_DIR . 'base_text' . DS;
const TOOLS_PHP_BIN_CATALOG_DIR = TOOLS_PHP_BIN_DIR . 'catalog' . DS;
const TOOLS_PHP_BIN_SCHEMAS_DIR = TOOLS_PHP_BIN_DIR . 'schemas' . DS;
const TOOLS_PHP_BIN_VIEWS_DIR = TOOLS_PHP_BIN_DIR . 'views' . DS;
const TOOLS_PHP_LIB_DIR = TOOLS_PHP_DIR . 'lib' . DS;
const TOOLS_PHP_LIB_EXCEPTIONS_DIR = TOOLS_PHP_LIB_DIR . 'exceptions' . DS;
const TOOLS_PHP_LIB_FUNCTIONS_DIR = TOOLS_PHP_LIB_DIR . 'functions' . DS;
const TOOLS_PYTHON_DIR = TOOLS_DIR . 'python' . DS;
const LIB_DIR = 'lib' . DS;
const BIN_DIR = 'bin' . DS;
const EXCEPTIONS_DIR = 'exceptions' . DS;
const FUNCTIONS_DIR = 'functions' . DS;
const PHP_CODE_BASE_LIB_DIR = __DIR__ . DS;
const PHP_GLOBAL_FUNCTIONS = PHP_CODE_BASE_LIB_DIR . '函式.php';

// JSON data structures

//const 詩字_字碼 = '詩字_字碼';
// base_text


// coords 坐標
const 一字組合_坐標 = COORDS_DIR . '一字組合_坐標';
const 二字組合_坐標 = COORDS_DIR . '二字組合_坐標';
const 三字組合_坐標 = COORDS_DIR . '三字組合_坐標';
const 四字組合_坐標 = COORDS_DIR . '四字組合_坐標';
const 五字組合_坐標 = COORDS_DIR . '五字組合_坐標';
const 六字組合_坐標 = COORDS_DIR . '六字組合_坐標';
const 七字組合_坐標 = COORDS_DIR . '七字組合_坐標';
const 八字組合_坐標 = COORDS_DIR . '八字組合_坐標';
const 九字組合_坐標 = COORDS_DIR . '九字組合_坐標';
const 十字組合_坐標 = COORDS_DIR . '十字組合_坐標';
const 十一字組合_坐標 = COORDS_DIR . '十一字組合_坐標';
const 數字對照陣列 = array(
	"1"=>一字組合_坐標, // 單字字碼
	"2"=>二字組合_坐標, "3"=>三字組合_坐標,
	"4"=>四字組合_坐標, "5"=>五字組合_坐標,
	"6"=>六字組合_坐標, "7"=>七字組合_坐標,
	"8"=>八字組合_坐標, "9"=>九字組合_坐標,
	"10"=>十字組合_坐標, "11"=>十一字組合_坐標,
);
const 句碼_詩句 = COORDS_DIR . '句碼_詩句';
const 行碼_詩文 = COORDS_DIR . '行碼_詩文';
const 行碼_副題 = COORDS_DIR . '行碼_副題';
const 字碼_詩字 = COORDS_DIR . '字碼_詩字';
const 非完整坐標表 = COORDS_DIR . '非完整坐標表';
const 詩碼坐標 = COORDS_DIR . '詩碼坐標';
const 含範圍字碼完整坐標 = COORDS_DIR . '含範圍字碼完整坐標';
const 含範圍行碼完整坐標 = COORDS_DIR . '含範圍行碼完整坐標';
const 默認詩文檔碼_完整坐標表 = COORDS_DIR . '默認詩文檔碼_完整坐標表';
const 默認詩文檔碼_碼_字 = COORDS_DIR . '文檔碼_碼_字';
const 默認詩文檔碼_詩文_坐標 = COORDS_DIR . '默認詩文檔碼_詩文_坐標';

// ids
const 默認詩文檔碼 = IDS_DIR . '默認詩文檔碼'; // 0013
const 默認版本詩碼 = IDS_DIR . '默認版本詩碼'; // 0013-1
const 帶序言之詩 = IDS_DIR . '帶序言之詩';
// mapping
const 默認詩文檔碼_詩題 = MAPPING_DIR . '默認詩文檔碼_詩題';
const 詩題_默認詩文檔碼 = MAPPING_DIR . '詩題_默認詩文檔碼';
const 組詩_副題       = MAPPING_DIR . '組詩_副題';
const 默認詩文檔碼_詩文 = MAPPING_DIR . '默認詩文檔碼_詩文';
const 默認詩文檔碼_序言 = MAPPING_DIR . '默認詩文檔碼_序言';
const 默認詩文檔碼_題注 = MAPPING_DIR . '默認詩文檔碼_題注';
const 默認詩文檔碼_行碼_內容 = MAPPING_DIR . '默認詩文檔碼_行碼_內容';
const 默認詩文檔碼_詩文重見名單 = 
	MAPPING_DIR . '默認詩文檔碼_詩文重見名單';
const 默認詩碼_首句 = MAPPING_DIR . '默認詩碼_首句';
const 首句_默認詩碼 = MAPPING_DIR . '首句_默認詩碼';
// metadata
const 版文檔碼_後設標記紀錄 = METADATA_DIR . '版文檔碼_後設標記紀錄';
// registry
const 書目簡稱 = REGISTRY_DIR . '書目簡稱';
const 異體字 = REGISTRY_DIR . '異體字';
// sets
const 詩文組合 = SETS_DIR . '詩文組合';
// 


const 空語鏈 = '';



const 杜甫資料庫 = 'h:'.DS.'杜甫資料庫'.DS;
const 平水韻文件夾 = 杜甫資料庫.'平水韻'.DS;
const 中古聲母文件夾 = 杜甫資料庫.'中古聲母'.DS;
const 資料匯總文件夾 = 杜甫資料庫 . '資料匯總' . DS;
const 杜甫分析文件夾 = 'h:'.DS.'github'.DS.'Dufu-Analysis'.DS;
const 程式文件夾 = 'h:'.DS.'github'.DS.'Dufu-Analysis'.DS.'analysis_programs'.DS;
const 杜甫文件夾 = 'h:'.DS.'github'.DS.'Dufu'.DS;
const 默認版本文件夾 = 杜甫文件夾.'默認版本'.DS;
const 默認版本詩文件夾 = 杜甫文件夾.'默認版本'.DS.'詩'.DS;
// 文檔
const 杜甫全集       = 'h:\github\DuFu\杜甫全集.txt';


define( 'NL', PHP_EOL ); // System-independent newline
const 等號 = '=';
const 坐標開括號 = '〚';
const 杜甫全集粵音注音 = 'h:\github\DuFu\杜甫全集粵音注音.txt';
const 目錄          = 'h:\github\DuFu\目錄.txt';
const 資料陣列       = 資料匯總文件夾 . '資料陣列.php';
// 字符
const 分隔線 =
"\r\n=====================================================\r\n";
const 新行 = "\r\n";
const 坐標關括號 = '〛';
const 坐標括號 = "〚〛";
const 冒號 = '：'; // UNICODE!!!
// preg_replace( 夾注regex, '', $ )
const 夾注regex = '/\[\X+?]/u';
const 兩句regex = "/(\\X+?。\\X+?。)/u";
const 四句regex = "/(\\X+?。\\X+?。\\X+?。\\X+?。)/u";
const 第一組新行regex = "$1\n";
const ASCII = 'ASCII';
const 數字 = '[0123456789 ]';

// php data files
/*
const 頁碼     = 杜甫資料庫 . '頁碼.php';
const 頁碼_路徑 = 杜甫資料庫 . '頁碼_路徑.php';
const 頁碼_詩題 = 杜甫資料庫 . '頁碼_詩題.php';
const 詩題_頁碼 = 杜甫資料庫 . '詩題_頁碼.php';
const 詩組_詩題 = 杜甫資料庫 . '詩組_詩題.php';
const 詩句_坐標 = 杜甫資料庫 . '詩句_坐標.php';
const 詩句_頁碼 = 杜甫資料庫 . '詩句_頁碼.php';
const 用字_頁碼 = 杜甫資料庫 . '用字_頁碼.php';
const 用字_詩句 = 杜甫資料庫 . '用字_詩句.php';
const 用字_頻率 = 杜甫資料庫 . '用字_頻率.php';
const 行碼_詩行 = 杜甫資料庫 . '行碼_詩行.php';
const 書目簡稱  = 杜甫資料庫 . '書目簡稱.php';
const 異體字    = 杜甫資料庫 . '異體字.php';
const 帶序文之詩歌 = 杜甫資料庫 . '帶序文之詩歌.php';
//const 杜甫詩陣列 = 杜甫資料庫 . '杜甫詩陣列.php';
const 詩題_注音 = 杜甫資料庫 . '陳永明《杜甫全集粵音注音》\詩題_注音.php';
const 詩句_注音 = 杜甫資料庫 . '陳永明《杜甫全集粵音注音》\詩句_注音.php';
const 注音_詩句 = 杜甫資料庫 . '陳永明《杜甫全集粵音注音》\注音_詩句.php';
const 字音     = 杜甫資料庫 . '陳永明《杜甫全集粵音注音》\陳永明《杜甫全集粵音注音》字音.php';
const 字_韻部   = 平水韻文件夾 . '字_韻部.php';
const 字_聲母   = 中古聲母文件夾 . '字_聲母.php';
const 二字組合_坐標 = 杜甫資料庫 . '二字組合_坐標.php';
const 三字組合_坐標 = 杜甫資料庫 . '三字組合_坐標.php';
const 四字組合_坐標 = 杜甫資料庫 . '四字組合_坐標.php';
const 五字組合_坐標 = 杜甫資料庫 . '五字組合_坐標.php';
*/
const 地名詞典     = 杜甫分析文件夾 . "《地名詞典》\\";
const 頁碼_詞條    = 地名詞典 . '頁碼_詞條.php';

// 書名文件夾
const 全唐詩        = 杜甫資料庫 . "《全唐詩》\\";
const 杜詩詳註       = 杜甫資料庫 . "仇兆鰲《杜詩詳註》\\";
const 杜詩全集今注本  = 杜甫資料庫 . "張志烈主編《杜詩全集（今注本）》\\";
const 讀杜心解       = 杜甫資料庫 . "浦起龍《讀杜心解》\\";
const 杜臆          = 杜甫資料庫 . "王嗣奭《杜臆》\\";
const 杜甫全集校注    = 杜甫資料庫 . "蕭滌非主編《杜甫全集校注》\\";
const 杜甫全集粵音注音文件夾 = 杜甫資料庫 . "陳永明《杜甫全集粵音注音》\\";
const 杜甫詩全譯      = 杜甫資料庫 . "韓成武、張志民《杜甫詩全譯》\\";
const 新刊校定集注杜詩 = 杜甫資料庫 . "郭知達《新刊校定集注杜詩》\\";
const 杜甫全詩訳注    = 杜甫資料庫 . "下定雅弘、松原_朗《杜甫全詩訳注》\\";

// 書本部分
const 坐標 = '坐標';
const 内容 = "内容";
const 大意 = '大意';
const 【大意】 = '【大意】';
const 行碼 = "行碼";
const 書名 = "書名";
const 版本 = "版本";
const 詩題 = "詩題";
const 題注 = '題注';
const 題解 = '題解';
const 【題解】 = '【題解】';
const 序言 = '序言';
const 【序言】 = '【序言】';
const 詩文 = "詩文";
const 【詩文】 = "【詩文】";
const 詩句 = "詩句";
const 【詩句】 = "【詩句】";
const 參數 = '參數';
const 注釋 = '注釋';
const 【注釋】 = '【注釋】';
const 坐標_句 = '坐標_句';
const 注音 = '注音';
const 【注音】 = '【注音】';
const 韻部 = '韻部';
const 【韻部】 = '【韻部】';
const 譯文 = '譯文';
const 【譯文】 = '【譯文】';
const 評論 = '評論';
const 【評論】 = '【評論】';
const 校記 = '校記';
const 【校記】 = '【校記】';
const 體裁 = '體裁';
const 【體裁】 = '【體裁】';
const 補充說明 = '補充說明';
const 【補充說明】 = '【補充說明】';
const 〖分行討論〗 = '〖分行討論〗';
const 〖通篇討論〗= '〖通篇討論〗';
const 〖地名〗= '〖地名〗';
const 附錄 = '附錄';
const 【附錄】 = '【附錄】';
const 旁注 = '旁注';
const 【旁注】 = '【旁注】';
const 坐標版本異文、夾注 = '坐標版本異文、夾注';
const 定義 = '定義';
const 參考 = '參考';

const 仇引 = '[仇引]';
const 引奭 = '[引奭]';
const 仇註引文 = "仇兆鰲《杜詩詳註》引文：\n";

//const 行音 = '行音';
//const 平仄 = '平仄';

const 副題 = '副題';
const 序文 = '序文';

const 異文、夾注 = '異文、夾注';
const 【異文、夾注】 = '【異文、夾注】';
const 補充説明 = '補充説明';
const 詩文注音 = '詩文注音';
const 【詩文注音】 = '【詩文注音】';
const 版本頁碼 = '版本頁碼';
//const 坐標版本異文、夾注 = '坐標版本異文、夾注';
const 【按語】 = '【按語】';
const 按語 = '按語';

// 後設資料部分
// 〘異:絶〙
// 〘注:夫如何;位:〚3.2〛;序:2 〙

const 來源 = "來源";
const 異夾 = "異夾"; // 異文、夾注
const 詞項 = "異夾"; 
const 位置 = "位置"; 
const 次序 = "次序"; 


// programs
// php h:\github\Dufu-Analysis\analysis_programs\搜索程式\search.php
const 選項指令 = "要搜索甚麼？請輸入選項數字；用 exit 來結束。\n";
const 搜索程式文件夾 = "h:\\github\\Dufu-Analysis\\analysis_programs\\搜索程式\\";
const 默認版本選項指令 = array(
	'默文檔碼→詩題'        => "請輸入默文檔碼：\n",
	'默文檔碼→詩文'        => "請輸入默文檔碼：\n",
	'詩題用字→默文檔碼' => "請輸入詩題用字:\n",
	'詩題用字→詩文' => "請輸入詩題用字:\n",
	'詩文用字→默文檔碼' => "請輸入詩文用字:\n",
	'默文檔碼→詩文片段黑名單' => "請輸入默文檔碼：\n",
	'默詩碼→詩首句'         => "請輸入默詩碼：\n",
	
	//'詩題注音→默文檔碼' => "請輸入\"si1 tai4 zyu3 jam1\":\n",
	//'詩文注音→默文檔碼' => "請輸入\"si1 man4 zyu3 jam1\":\n",

/*
	//'頁碼→詩文'        => "請輸入頁碼:\n",
	//'頁碼→注音'        => "請輸入頁碼:\n", // 粵音注音
	//'頁碼→譯文'        => "請輸入頁碼:\n", // 韓成武、張志民《杜甫詩全譯》
	//'頁碼→〚行碼〛、詩文' => "請輸入頁碼:\n",
*/
	// 搜索頁碼
/**/
	// 搜索注音
	//'單字→注音' => "請輸入詩文單字:\n",
	//'詩句→注音' => "請輸入詩句:\n",
	
	// 搜索詩句、坐標
	//'詩文用字→詩句、〚坐標〛' => "請輸入詩文用字:\n",
	//'詩文用字→〚坐標〛'     => "請輸入詩文用字:\n",
	//'頁碼、詩文單字→〚坐標〛' => "請輸入頁碼、詩文單字:\n",
	
	// 括號
	//'生成行碼'            => "請輸入最後一個行碼:\n",

	// 版本書籍用

	//'頁碼、版本簡稱→版本頁碼' => "請輸入頁碼、版本簡稱:\n",
	// 一頁可以有多首，只顯示第一首頁碼!!!
	//'版本簡稱、版本頁碼→頁碼' => "請輸入版本簡稱、版本頁碼:\n",
	// 全 地 仇 疊 今 名 朱 楊 浦 奭 蕭 默 郭 錢 粵 約 筆 譯 榷
	//'顯示版本簡稱'  => '',
/*	//'顯示簡稱、書名' => '',
	'頁碼、簡稱→版本詩題'      => "請輸入頁碼、版本簡稱:\n",
	'頁碼、簡稱→詩文、夾注'     => "請輸入頁碼、版本簡稱:\n",
	'頁碼、簡稱→詩文、注碼、注釋' => "請輸入頁碼、版本簡稱:\n",
	'頁碼、簡稱→詩文、夾注、譯文'     => "請輸入頁碼、版本簡稱:\n",
	'頁碼、簡稱→詩文、注碼、注釋、譯文' => "請輸入頁碼、版本簡稱:\n",
	'頁碼、簡稱→版本異文、夾注'      => "請輸入頁碼、版本簡稱:\n",	
	'頁碼、簡稱→版本差異'          => "請輸入頁碼、版本簡稱:\n",
*/
	//'頁碼→詩文、《杜臆》評論'     => "請輸入頁碼:\n",

/*
	// 粵音注音用
	'頁碼→〚坐標〛、韻字'    => "請輸入頁碼、韻字:\n",
	'頁碼→〖詩句〗'        => "請輸入頁碼:\n",
*/
	//'頁碼→平仄'           => "請輸入頁碼:\n",
/*
	'字→平水韻韻部'        => "請輸入單字:\n",
	'字→中古聲母'          => "請輸入單字:\n",
	'字→粵音'             => "請輸入單字:\n",
	'頁碼、簡稱→評論'        => "請輸入頁碼、版本簡稱:\n",
*/
	//'頁碼、簡稱、詞組→句注釋' => "請輸入頁碼、版本簡稱、詞組:\n",
/*
*/

	// 從詩題開始（不限字數）
/*	'以詩題用字搜索詩題'    => "請輸入詩題用字:\n", // 包含頁碼
	'以詩題用字搜索詩文'    => "請輸入詩題用字:\n",
	'以詩題用字搜索版本頁碼' => "請輸入詩題用字 版本簡稱:\n",
	'以詩題用字注音搜索詩題' => "請輸入\"si1 tai4 jung6 zi6 zyu3 jam1\":\n",
	'以詩題用字注音搜索版本頁碼' => "請輸入\"si1 tai4 jung6 zi6 zyu3 jam1\" 版本簡稱:\n",

	// 從詩文用字開始（不限字數，一句爲限）
	'以詩文用字搜索頁碼'    => "請輸入詩文用字:\n",
	'以詩文用字搜索詩題'    => "請輸入詩文用字:\n",
	'以詩文用字搜索詩句'    => "請輸入詩文用字:\n",
	'以詩文用字搜索坐標'    => "請輸入詩文用字:\n",
	'以詩文用字注音搜索詩句' => "請輸入\"si1 man4 jung6 zi6 zyu3 jam1\":\n",
	'以詩文用字注音搜索詩句，再搜索版本注釋' => "請輸入\"si1 man4 jung6 zi6 zyu3 jam1\" 版本簡稱:\n",
	// 單字!!
	'以詩文單字提取注音'    => "請輸入詩文單字:\n",
	// 完整詩句->注音
	'以詩句提取注音'       => "請輸入完整詩句:\n",
	// 顯示
	'以夾注形式顯示詩文、注釋' => "請輸入頁碼、版本簡稱:\n",
	'以注碼顯示詩文、注釋'   => "請輸入頁碼、版本簡稱:\n",
*/
	//'以坐標提取詩文' => "請輸入完整坐標:\n",               // 改成 function
	//'以頁碼版本簡稱顯示版本原文' => "請輸入頁碼、版本簡稱:\n", // 改成 function
);

const 搜索坐標選項 = array(
	
);

const 搜索目錄選項 = array(
	'簡稱、版本詩碼→默認版本詩碼' => "請輸入簡稱、詩碼:\n",
	'默認版本詩碼、簡稱→版本詩碼' => "請輸入詩碼、簡稱:\n",
	'默認版本詩碼→各版本書頁碼' => "請輸入詩碼:\n",
	
);


const 程式後綴 = '.php';

// error msg
const 提供默文檔碼 = '必須提供默文檔碼。';
const 提供默文檔碼、詩文 = '必須提供默文檔碼、詩文。';
const 提供詩題 = '必須提供詩題用字。';
const 提供詩文 = '必須提供詩文用字。';

const 提供頁、簡 = '必須提供頁碼、版本簡稱。';
const 提供頁、簡、詞 = '必須提供頁碼、版本簡稱、詞組。';
const 提供題音 = '必須提供詩題用字注音。';
const 提供題、簡 = '必須提供詩題用字、版本簡稱。';
const 提供題音、簡 = '必須提供詩題用字注音、版本簡稱。';
const 提供詩句 = '必須提供詩句。';
const 提供詩題注音 = '必須提供詩題用字注音。';
const 提供詩文注音 = '必須提供詩文用字注音。';
const 提供單字 = '必須提供詩文單字。';
const 提供頁、字 = '必須提供頁碼、詩文單字。';
const 提供音、簡 = '必須提供詩文注音、版本簡稱。';
const 提供完整坐標 = '必須提供完整坐標。';
const 提供簡稱 = '必須提供版本簡稱。';
const 提供簡稱、頁碼 = '必須提供版本簡稱、版本頁碼。';
const 提供行碼     = '必須最後一個行碼。';
const 提供雙字 = '必須提供兩個單字。';
const 提供字詞 = '必須提供一或多個單字。';
const 輸入程式名稱 = '必須提供程式名稱。';
const 提供詩文陣列 = '必須提供詩文陣列（如：酒,髮）。';
// 目錄
const 提供默詩碼、簡稱 = '必須提供默認版本詩碼、書目簡稱。';
const 提供簡稱、版本詩碼 = '必須提供書目簡稱、版本詩碼。';
const 提供默詩碼 = '必須提供默認版本詩碼。';


const 無結果   = '沒有結果。';
const 無文檔碼   = '無此文檔碼。';
const 無簡稱   = '無此簡稱。';
const 無詩碼   = '無此詩碼。';

// 坐標
const 坐標頁碼 = '頁碼';
const 坐標首碼 = '首碼';
const 坐標行碼 = '行碼';
const 坐標句碼 = '句碼';
const 坐標字碼 = '字碼';
const 無首碼   = '無此首碼。';
const 無行碼   = '無此行碼。';
const 無句碼   = '無此句碼。';
const 無字碼   = '無此字碼。';

// 新增： JSON
const 數據結構 = '數據結構';
//const 數據結構文件夾 = 杜甫分析文件夾.'JSON'.DS.數據結構.DS;
const 默認版本 = '默認版本';
const 默認詩文檔碼_空陣列 = '默認詩文檔碼_空陣列';

/*
const  = '';
const  = '';
const  = '';
const  = '';
*/

// 坐標


// exception msg
const 錨値不合法 = '錨値不合法';

//蕭滌非
const 默詩碼_蕭詩碼 = '默詩碼_蕭詩碼';
const 蕭詩碼_默詩碼 = '蕭詩碼_默詩碼';
const 詩題_蕭詩碼 = '詩題_蕭詩碼';
const 蕭詩碼_詩題 = '蕭詩碼_詩題';
?>