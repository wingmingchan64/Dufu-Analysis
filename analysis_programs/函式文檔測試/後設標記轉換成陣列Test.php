<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\函式文檔測試\後設標記轉換成陣列Test.php
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"analysis_programs" . DIRECTORY_SEPARATOR .
	"函式.php" );

$默文檔碼 = '0276';
$文檔碼 = '0001';
$str = "奉贈韋左丞丈二十二韻[韋濟。天寶七載爲河南尹。遷尙書左丞。]〘cat:異;a:1〙
少[一作妙]〘cat:異;a:少〙
卜[一作爲]〘cat:異;a:卜〙
出[一作生。一作特]〘cat:異;a:出〙
食[一作客]〘cat:異;a:食〙
歘〘cat:異;a:欻〙
鱗[天寶中。詔徵天下士有一藝者。皆得詣京師就選。李林甫抑之。奏令考試。遂無一人得第者。]〘cat:異;a:鱗〙
祗〘cat:異;a:祇〙
沒[一作波]〘cat:異;a:沒〙";
$data = explode( NL, $str );
$文檔碼_後設陣列 = array();

if( !array_key_exists( $文檔碼, $文檔碼_後設陣列 ) )
{
	$文檔碼_後設陣列[ $文檔碼 ] = array();
}
//$文檔碼
//print_r( $data );
$counter = 1;
foreach( $data as $line )
{
	$text_tag = explode( '〘', $line );
	//print_r( $text_tag );
	$text = $text_tag[ 0 ];
	$tag = str_replace( '〙', '', $text_tag[ 1 ] );
	$後設陣列 = 後設標記轉換成陣列( $文檔碼, $默文檔碼, $tag, $text );
	if( !array_key_exists( 'id', $後設陣列 ) )
	{
		$後設陣列[ 'id' ] = $文檔碼 . '.' . $counter;
		$counter++;
	}
	array_push( $文檔碼_後設陣列[ $文檔碼 ], $後設陣列 );
}

//print_r( $文檔碼_後設陣列 );

$json = json_encode(
	$文檔碼_後設陣列,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"文檔碼_後設陣列.json",
	$json . PHP_EOL );


?>

