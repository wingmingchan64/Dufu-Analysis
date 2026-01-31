<?php
/*
 * Script: 生成詩題_默認詩文檔碼_題注.php，生成三個文檔
 * Usage:  php h:\github\Dufu-Analysis\JSON\程式\生成詩題_默認詩文檔碼_題注.php
 * Author: Wing Ming Chan
 * Updated: 2026-01-25
 */
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
$詩_BASE = 
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"DuFu" . DIRECTORY_SEPARATOR .
	"默認版本" . DIRECTORY_SEPARATOR .
	"詩" . DIRECTORY_SEPARATOR;

foreach( $默認詩文檔碼_詩題 as $文檔 => $詩題 )
{
	$默認詩文檔碼_詩題[ $文檔 ] = 
		normalize( $詩題, true, true, true );
}
$詩題_默認詩文檔碼 = array_flip( $默認詩文檔碼_詩題 );
//print_r( $詩題_默認詩文檔碼 );
$默認詩文檔碼_題注 = array();

foreach( $默認詩文檔碼 as $文檔 )
{
	$詩文檔 = $詩_BASE . $文檔 . ".txt";
	$handle = @fopen( $詩文檔, "r" );
	
	if( !$handle )
	{
		error_log( "⚠️ Cannot open file: $from_file" );
		continue;
	}

	// read first line
	if( ( $line = fgets( $handle ) ) !== false )
	{
		$題注 = array();
		$result = preg_match( 夾注regex, $line, $題注 );
		
		if( $result && count( $題注 ) > 0 )
		{
			$默認詩文檔碼_題注[ $文檔 ] = $題注[ 0 ];
		}
		
		$line = 
			trim( mb_substr( 
				preg_replace( 夾注regex, '', $line ),
				5 ) );
	}

	fclose( $handle );
}

$json = json_encode(
    $默認詩文檔碼_詩題,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_詩題.json",
	$json . PHP_EOL );
	
$json = json_encode(
    $詩題_默認詩文檔碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"詩題_默認詩文檔碼.json",
	$json . PHP_EOL );

$json = json_encode(
    $默認詩文檔碼_題注,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_題注.json",
	$json . PHP_EOL );

?>