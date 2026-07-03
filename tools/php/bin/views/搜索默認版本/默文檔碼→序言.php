<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索默認版本\默文檔碼→序言.php 3686
=> 序言：旣雨已秋。堂下理小畦。隔種一兩席許萵苣。向二旬矣。而苣不甲坼。獨野莧青青。傷時君子。或晚得微祿。轗軻不進。因作此詩。
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

check_argv( $argv, 2, 提供默文檔碼 );
$默文檔碼 = fix_doc_id( trim( $argv[ 1 ] ) );
$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );

if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無文檔碼, NL;
}

if( array_key_exists( $默文檔碼, $默認詩文檔碼_詩題 ) )
{
	$默認詩文檔碼_序言 = 提取數據結構( 默認詩文檔碼_序言 );
	
	if( array_key_exists( $默文檔碼, $默認詩文檔碼_序言 ) )
	{
		echo 序言, '：', $默認詩文檔碼_序言[ $默文檔碼 ], NL;
	}
	else
	{
		echo "此詩無序言", NL;
	}
}
else
{
	echo 無結果, NL;
}
?>