<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\生成版本\生成《全唐詩》.php
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );
	
$資料來源文件夾 = dirname( __DIR__, 6 ) . DS . 'DuFu' . DS .
	PACKAGES_DIR . '《全唐詩》' . DS . '中華書局版' . DS;
$後設資料文件夾 = dirname( __DIR__, 5 ) . DS . PACKAGES_DIR .
	'《全唐詩》' . DS . METADATA_DIR . 'by_doc_id' . DS;
	
$多個文檔 = true;

// 生成一個文檔，文檔碼爲：版本文檔碼
if( !$多個文檔 )
{
	$版文檔碼s = array( '0002', '0098' );
}
// 生成多個文檔
else
{
	$版文檔碼s = array();
	
	if( !is_dir( $後設資料文件夾 ) )
	{
		throw new RuntimeException( '後設資料文件夾不存在: ' . 後設資料文件夾 );
	}
	
	// scan the source folder
	$files = scandir( $資料來源文件夾 );
	//print_r( $files );
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

print_r( $版文檔碼s );

foreach( $版文檔碼s as $版文檔碼 )
{
	echo $版文檔碼, NL;
	// 處理 DuFu 中 .txt 文檔的〘〙標記，生成後設標記 JSON 文檔
	處理後設標記( '全', $版文檔碼, '中華書局版', true, true );
	處理後設資料( '全', $版文檔碼 );

	$版本文檔 = 提取版本文檔( '全', $版文檔碼, true, true );
	$詩陣列詩文 = 提取詩陣列詩文( $版本文檔, true, true );
	$詩題 = "# " . 加sub標簽( $詩陣列詩文[ 0 ] );
	unset( $詩陣列詩文[ 0 ] );

	$詩題 = $詩題 . NL . NL;
	$詩文 = 加sub標簽( implode( NL, $詩陣列詩文 ) );
	$contents = $詩題 . $詩文;

	file_put_contents(
		dirname( __DIR__, 5 ) . DS . PACKAGES_DIR . 
		'《全唐詩》' . DS . 'samples' . DS . "${版文檔碼}.md",
		$contents . PHP_EOL );
}
?>