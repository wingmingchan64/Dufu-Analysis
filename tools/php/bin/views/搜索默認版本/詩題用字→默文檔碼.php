<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\詩題用字→默文檔碼.php 故高蜀州人日
=>

*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供詩題 );
$題 = fix_text( trim( $argv[ 1 ] ) );
$詩題_默認詩文檔碼 = 提取數據結構( 詩題_默認詩文檔碼 );
$result = array();

foreach( $詩題_默認詩文檔碼 as $詩題 => $默文檔碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$result[ $默文檔碼 ] = $詩題;
	}
}
if( count( $result ) == 0 )
{
	echo "杜甫詩中無此詩題：「${題}」。", NL;
}
else
{
	print_r( $result );
}
?>