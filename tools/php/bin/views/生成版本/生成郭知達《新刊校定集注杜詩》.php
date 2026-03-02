<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\生成版本\生成郭知達《新刊校定集注杜詩》.php
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

$簡稱 = '郭';
$書名 = '郭知達《新刊校定集注杜詩》';
	
$資料來源文件夾 = dirname( __DIR__, 6 ) . DS . 'DuFu' . DS .
	PACKAGES_DIR . $書名 . DS;
$後設資料文件夾 = dirname( __DIR__, 5 ) . DS . PACKAGES_DIR .
	$書名 . DS . METADATA_DIR . 'by_doc_id' . DS;
	
$多個文檔 = false;
$生成md = true;

// 生成一個文檔，文檔碼爲：版本文檔碼
if( !$多個文檔 )
{
	$版文檔碼s = array( '0001' );
}
// 生成多個文檔
else
{
	$版文檔碼s = array();
	
	if( !is_dir( $後設資料文件夾 ) )
	{
		throw new RuntimeException( '後設資料文件夾不存在: ' . 後設資料文件夾 );
	}
	
	// scan the source folder and get the filenames
	$files = scandir( $資料來源文件夾 );
	sort( $files, SORT_STRING );

	foreach( $files as $file )
	{
		$path = $資料來源文件夾 . $file;

		if(
			is_file( $path )
			&& preg_match( '/\.txt$/i', $file )
		)
		{
			$版文檔碼s[] = substr( $file, 0, 4 );
		}
	}
}

foreach( $版文檔碼s as $版文檔碼 )
{
	// 處理 DuFu 中 .txt 文檔的〘〙標記，生成後設標記 JSON 文檔
	處理後設標記( $簡稱, $版文檔碼, '', true, true );
	處理後設資料( $簡稱, $版文檔碼 );

	if( $生成md )
	{
		$版本文檔 = 提取版本文檔( $簡稱, $版文檔碼, true, true );
		//print_r( $版本文檔 );
		
		$詩陣列詩文 = 提取詩陣列詩文( $版本文檔, true, true );
		$詩題 = "# " . 加sub標簽( $詩陣列詩文[ 0 ] );
		unset( $詩陣列詩文[ 0 ] );

		$詩題 = $詩題 . NL . NL;
		$詩文 = implode( NL, $詩陣列詩文 );
		$詩文 = str_replace( '。]。', ']。', $詩文 );
		$詩文 = 	加sub標簽( $詩文 );
		$contents = $詩題 . $詩文;

		file_put_contents(
			dirname( __DIR__, 5 ) . DS . PACKAGES_DIR . 
			$書名 . DS . 'samples' . DS . "${版文檔碼}.md",
			$contents . PHP_EOL );


	}
}
?>