<?php
/*
 * 
 php H:\github\Dufu-Analysis\tools\php\lib\functions\populate_frame.php
 */

populate_frame();

function populate_frame() 
{
	$簡稱 = '郭';
	$版文檔碼 = '0001';
	$頁 = '0003';
	$行 = '03';
	$hash = '753298e';
	$類 = '注';
	$錨 = '〚0276:3.1.2〛';
	$書錨 = '〚0276:3.1.2〛';
	$frame = json_decode( file_get_contents( dirname( __DIR__, 4 ) .
		DIRECTORY_SEPARATOR .
		'schemas' . DIRECTORY_SEPARATOR . 
		'json' . DIRECTORY_SEPARATOR .
		'metadata' . DIRECTORY_SEPARATOR .
		'mm_template.json' ), true );
	$frame[ 'workId' ] = $簡稱 . $版文檔碼;
	print_r( $frame );
}
?>