<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\生成行碼.php
=>

)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

checkARGV( $argv, 2, 提供行碼 );
$行碼 = trim( $argv[ 1 ] );
$行 = intval( $行碼 );

if( $行 < 1 )
{
	echo 無結果, NL;
}
else
{
	for( $i = 1; $i <= $行; $i++ )
	{
		echo "〚${i}〛", NL;
	}
}
?>