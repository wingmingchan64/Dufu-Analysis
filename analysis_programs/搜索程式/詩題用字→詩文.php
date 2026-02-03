<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\詩題用字→詩文.php 遣興
=> 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

checkARGV( $argv, 2, 提供詩題 );

$題 = fixText( trim( $argv[ 1 ] ) );
$result = array();

foreach( $詩題_默認詩文檔碼 as $詩題 => $文檔碼 )
{
	if( mb_strpos( $詩題, $題 ) !== false )
	{
		$result[ $文檔碼 ] = $題;
	}
}
if( sizeof( $result ) == 0 )
{
	echo 無結果, NL;
}
elseif( sizeof( $result ) == 1 )
{
	echo NL . NL . $默認詩文檔碼_詩文[
		array_keys( $result )[ 0 ]
	] . NL;
}
elseif( sizeof( $result ) > 2 )
{
	ksort( $result );
	echo "此詩題指向多首杜詩。", NL, NL;

	print_r( $result );
	
	echo "下面只顯示其中兩首。", NL;
	
	echo NL . NL . $默認詩文檔碼_詩文[
		array_keys( $result )[ 0 ]
	] . NL;
	echo NL . NL . $默認詩文檔碼_詩文[
		array_keys( $result )[ 1 ]
	] . NL;

}
?>