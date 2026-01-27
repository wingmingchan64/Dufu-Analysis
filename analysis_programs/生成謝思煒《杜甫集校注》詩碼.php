<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\生成謝思煒《杜甫集校注》詩碼.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

$詩碼_頁碼 = array();
$頁碼_詩碼 = array();
$蕭頁碼_謝頁碼 = array();

$目錄 = file_get_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"謝思煒《杜甫集校注》" . DIRECTORY_SEPARATOR .
	"謝目錄.txt" );

$lines = explode( NL, $目錄 );
//print_r( $lines );

foreach( $lines as $l )
{
	$l = trim( $l );
	
	if( mb_strpos( $l, '//' ) !== false )
	{
		$parts = explode( '//', $l );
		$碼s = trim( $parts[ 1 ] );
		$蕭頁碼 = substr( $碼s, 0, 4 );
		$謝碼 = substr( $碼s, 5 );
		//echo $蕭頁碼, NL;
		$碼s = explode( ',', $謝碼 );
		$謝頁碼 = $碼s[ 0 ];
		$碼s = array_splice( $碼s, 1 );
		//print_r( $碼s );
		
		foreach( $碼s as $碼 )
		{
			$詩碼_頁碼[ $碼 ] = $謝頁碼;
		}
		$頁碼_詩碼[ $謝頁碼 ] = $碼s;
		$蕭頁碼_謝頁碼[ $蕭頁碼 ] = $謝頁碼;

	}
}
ksort( $蕭頁碼_謝頁碼 );
//print_r( $蕭頁碼_謝頁碼 );
//print_r( $詩碼_詩頁碼 );
//print_r( $詩頁碼_詩碼 );

$json = json_encode(
    $蕭頁碼_謝頁碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"謝思煒《杜甫集校注》" . DIRECTORY_SEPARATOR .
	"蕭頁碼_謝頁碼.json",
	$json . PHP_EOL );


$json = json_encode(
    $詩碼_頁碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"謝思煒《杜甫集校注》" . DIRECTORY_SEPARATOR .
	"詩碼_頁碼.json",
	$json . PHP_EOL );

$json = json_encode(
    $頁碼_詩碼,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"謝思煒《杜甫集校注》" . DIRECTORY_SEPARATOR .
	"頁碼_詩碼.json",
	$json . PHP_EOL );

?>
