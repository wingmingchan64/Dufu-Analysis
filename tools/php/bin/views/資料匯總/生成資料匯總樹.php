<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\資料匯總\生成資料匯總樹.php

before this, run
php H:\github\CanonicalTextTrees\tools\php\bin\執行路徑程式.php
php H:\github\Dufu-Analysis\tools\php\bin\views\資料匯總\生成後設資料樹.php
*/
//use CTT\Exceptions\IllegalWorkIDException;
//use Dufu\Exceptions\JsonFileNotFoundException;
//use Dufu\Exceptions\InvalidAnchorValueException;

require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	//'Dufu-Analysis' . DIRECTORY_SEPARATOR .
	//'tools' . DIRECTORY_SEPARATOR .
	//"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$默文檔碼 = '0943';
//$默文檔碼 = '3789';
$簡稱_著述碼 = 提取數據結構( 簡稱_著述碼 );
$杜著述s = array(
/*
	array(
		"簡稱"=>"趙",
		"文檔碼"=>"0141",
		"部分"=>array( "題解", "注釋", "異文" )
		),
*/
	array(
		"簡稱"=>"郭",
		"文檔碼"=>"0049",
		"部分"=>array( "題解", "注釋" )
		),

	array(
		"簡稱"=>"王",
		"文檔碼"=>"06.21",
		"部分"=>array( "題解", "注釋" )
		),
	array(
		"簡稱"=>"分",
		"文檔碼"=>"11.01",
		"部分"=>array( "題解", "注釋" )
		),

	array(
		"簡稱"=>"蔡",
		"文檔碼"=>"0142",
		"部分"=>array( "題解","注釋","異文" )
		),
	array(
		"簡稱"=>"奭",
		"文檔碼"=>"0126",
		"部分"=>array( "鑒賞" )
		),
	array(
		"簡稱"=>"錢",
		"文檔碼"=>"0060",
		"部分"=>array( "注釋" )
		),
	array(
		"簡稱"=>"歎",
		"文檔碼"=>"02.01",
		"部分"=>array( "結構" )
		),
	array(
		"簡稱"=>"說",
		"文檔碼"=>"01.12",
		"部分"=>array( "鑒賞" )
		),
	array(
		"簡稱"=>"志",
		"文檔碼"=>"04.05",
		"部分"=>array( "結構" )
		),

	array(
		"簡稱"=>"仇",
		"文檔碼"=>"0145",
		"部分"=>array( "題解","注釋","結構","評論" )
		),
	array(
		"簡稱"=>"浦",
		"文檔碼"=>"0035",
		"部分"=>array( "題解","注釋","評論","結構" )
		),
	array(
		"簡稱"=>"楊",
		"文檔碼"=>"0141",
		"部分"=>array( "題解","注釋","評論" )
		),
/*
	array(
		"簡稱"=>"鑒",
		"文檔碼"=>"0943",
		"部分"=>array( "鑒賞" )
		),
	array(
		"簡稱"=>"焮",
		"文檔碼"=>"206.13",
		"部分"=>array( "題解","注釋","異文","校記" )
		),
		
	array(
		"簡稱"=>"蕭",
		"文檔碼"=>"0146",
		"部分"=>array( "題解","注釋","評論","異文","校記" )
		),
	array(
		"簡稱"=>"謝",
		"文檔碼"=>"0052",
		"部分"=>array( "題解","注釋","評論","校記" )
		),
	array(
		"簡稱"=>"弱",
		"文檔碼"=>"0943",
		"部分"=>array( "題解","注釋","評論","結構" )
		),
*/
	array(
		"簡稱"=>"粵",
		"文檔碼"=>"0943",
		"部分"=>array( "體裁", "粵音","平仄","韻部" )
		),
/*
	array(
		"簡稱"=>"訳",
		"文檔碼"=>"0188",
		"部分"=>array( "翻譯" )
		),
	array(
		"簡稱"=>"歐",
		"文檔碼"=>"05.27",
		"部分"=>array( "翻譯" )
		),
	array(
		"簡稱"=>"張年",
		"文檔碼"=>"0943",
		"部分"=>array( "年譜" )
		),
*/
	array(
		"簡稱"=>"典",
		"文檔碼"=>"0943",
		"部分"=>array( "引典" )
		),
/*
	array(
		"簡稱"=>"詞典",
		"文檔碼"=>"0943",
		"部分"=>array( "釋義" )
		),
*/
);

$樹 = 提取基準正文樹( $默文檔碼 );
$書目簡稱 = 提取數據結構( 書目簡稱 );
$開關 = array();
$參考書目 = array();
添加標點符號( $樹 );
添加錨( $樹 );

foreach( $杜著述s as $杜著述 )
{
	$簡稱 = $杜著述[ "簡稱" ];
	//echo $簡稱, NL;
	$參考書目[ $簡稱 ] = $書目簡稱[ $簡稱 ];
	$開關[ $簡稱 ] = $杜著述[ "部分" ];
	$著述碼 = $簡稱_著述碼[ $簡稱 ];
	$版文檔碼 = $杜著述[ "文檔碼" ];
	$部分 = $杜著述[ "部分" ];
	//echo $簡稱, NL;
	$paths = array();
	$子樹 = 截取子樹( $著述碼, $版文檔碼, $部分 );
	記錄後設資料樹路徑( $子樹 );
	//print_r( $子樹 );
	
	$folder = 提取ctt文件夾( $著述碼 );
	附加著述資料(
		$默文檔碼, "${著述碼},${版文檔碼}", $paths, $樹 );
}

植入路徑子樹( $樹, array( 樹錨名 ),
	array( '開關' => $開關 ) );
植入路徑子樹( $樹, array( 樹錨名 ),
	array( '參考' => $參考書目 ) );

$json = json_encode(
	$樹,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 6 ) . DS . 
	杜甫語料文件夾	. '資料匯總' . DS .
	'views' . DS .
	$默文檔碼 . '.json',
	//'仇兆鰲《北征》.json',
	$json . PHP_EOL );

function 截取子樹(
	string $著述碼, string $版文檔碼, array $節點s ) : array
{
	$m_tree = 提取後設資料樹( $著述碼, $版文檔碼 );
	$subtree = $m_tree[ $著述碼 ][ $版文檔碼 ];
	$子樹 = array();
	$子樹[ $著述碼 ][ $版文檔碼 ] = array();
	
	foreach( $節點s as $節點 )
	{
		if( in_array( $節點, array_keys( $subtree ) ) )
		{
			$子樹[ $著述碼 ][ $版文檔碼 ][ $節點 ] =
				$subtree[ $節點 ];
		}
	}
	
	return $子樹;
}
?>