<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→詩文、《杜臆》評論.php 0003
=> 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );
$路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
$杜臆路徑 = 杜臆 . $頁碼 . 程式後綴;
$content = '';

if( file_exists( $路徑 ) &&  file_exists( $杜臆路徑 ) )
{
	require_once( $路徑 );
	require_once( $杜臆路徑 );
	
	if( array_key_exists( 版本, $奭内容 ) && 
		array_key_exists( 詩題, $奭内容[ 版本 ]  )  )
	{
		$content = '杜臆詩題：' . $奭内容[ 版本 ][ 詩題 ] . NL . '默認詩題：';
	}
	
	foreach( $内容[ 行碼 ] as $碼 => $文 )
	{
		//if( $文 == '' ) continue;
		$content = $content . $文 . NL;
	}
	$content = NL . $content . NL;
	
	if( is_string( $奭内容[ 評論 ] ) )
	{
		$content = $content . $奭内容[ 評論 ] . NL;
	}
	elseif( is_array( $奭内容[ 評論 ] ) )
	{
		foreach( $奭内容[ 評論 ] as $評 )
		{
			$content = $content . $評. NL;
		}
	}
	
	$content = str_replace( "\n\n\n", "\n", $content );
	$content = str_replace( $頁碼, "", $content );
	echo $content;
}
else
{
	echo 無結果, NL;
}

?>