<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成疊韻二字組合.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 字_韻部 );
require_once( 杜甫資料庫 . '二字組合_坐標.php' );
require_once( 杜甫資料庫 . '用字_頻率.php' );

$result = array();
$用字s = array_keys( $用字_頻率 );

//print_r( $用字s );


foreach( $用字s as $字 )
{
	if( !array_key_exists( $字, $字_韻部 ) )
	{
		array_push( $result, $字 );
	}
}
print_r( $result );

/*
foreach( $二字組合_坐標 as $二字組合 => $坐標 )
{
	$一 = mb_substr( $二字組合, 0, 1 );
	$二 = mb_substr( $二字組合, 1, 1 );
	$一韻部 = $字_韻部[ $一 ];
	$二韻部 = $字_韻部[ $二 ];
	$同韻   = array_intersect( $一韻部, $二韻部 );
	
	if( sizeof( $同韻 ) > 0 )
	{
		$result[ $二字組合 ] = $坐標;
	}
}
print_r( $result );
*/
$code = '';
$code = "<?php
/*
生成：本文檔用 PHP 生成。
程式：生成疊韻二字組合.php
說明：疊韻二字組合。
*/
\$疊韻二字組合=array(\n" . $code . ");\n?>";
//file_put_contents( 杜甫資料庫 . '三字組合排序頻率.php', $code );
?>
