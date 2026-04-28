<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\合幷正文樹後設資料_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidPathException;

//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$樹 = 提取基準正文樹( '0276' );
添加標點符號( $樹 );
添加錨( $樹 );
//print_r( $樹 );

$異文 = file_get_contents(
	'H:\github\DuFu\packages\郭知達《新刊校定集注杜詩》\metadata\異文' . '\0001.txt'
);
if( detect_format( $異文 ) == 'jsonl' ||
	detect_format( $異文 ) == 'json')
{
	$lines = preg_split( '/\r\n|\r|\n/', trim( $異文 ) );
	
	foreach( $lines as $line )
	{
		$params = json_decode( $line, true );
		$cat = $params[ 'cat' ];
		
		$標簽 = 生成XML標簽( 'sub' );
		//$標簽 = 生成括號陣列( '〈〉' );
		$content = 
			$標簽[ 0 ] . 
			trim( $params[ 'content' ] ) .
			$標簽[ 1 ];
		
		$op = $params[ 'op' ];
		$path = explode( ',', $params[ 'scope' ] );
		
		if( $op == 'insert' )
		{
			插入路徑字( $樹, $path, $content );
		}
	}

}

$metadata_tree = json_decode( 
	file_get_contents('H:\github\CanonicalTextTrees\corpus\dufu\新刊校定集注杜詩\trees' . '\0001.json' ), true );

//print_r( $metadata_tree );

$注釋 = 
	file_get_contents(
	'H:\github\DuFu\packages\郭知達《新刊校定集注杜詩》\metadata\注釋' . '\0001.txt' 
);


if( detect_format( $注釋 ) == 'jsonl' ||
	detect_format( $注釋 ) == 'json')
{
	$lines = preg_split( '/\r\n|\r|\n/', trim( $注釋 ) );
	
	foreach( $lines as $line )
	{
		$params = json_decode( $line, true );
		$cat = $params[ 'cat' ];
		$標簽 = 生成XML標簽( 'sub' );
		//$標簽 = 生成括號陣列( '〈〉' );
		$src_path = trim( $params[ 'src_path' ] );
		$path = explode( ',', $src_path );
		$content = 
			$標簽[ 0 ] . 
			提取ctt正文( $src_path ) .
			$標簽[ 1 ];
		$op = $params[ 'op' ];
		$path = explode( ',', $params[ 'scope' ] );
		
		// replace 1-3 with 'a'
		$path[ count( $path ) - 1 ] = 'a';
		
		if( $op == 'insert' )
		{
			插入路徑字( $樹, $path, $content );
		}
	}
}
//print_r( $樹 );

$contents = '## ' . $樹[ '0276' ][ '詩題' ][ '題' ] . NL . NL;
$contents .= $樹[ '0276' ][ '詩題' ][ 'a' ] . NL . NL;

for( $i = 3; $i < 25; $i++ )
{
	$contents .= 攤平樹文字_略過鍵( $樹[ '0276' ][ (string) $i ] ) . NL . NL;
}
file_put_contents(
	'H:\github\CanonicalTextTrees' . 
	'\corpus\dufu\新刊校定集注杜詩\views' . '\0001.md',
	$contents . NL );

$contents = '## ' . $樹[ '0276' ][ '詩題' ][ '題' ] . NL . NL;
$contents .= 攤平樹文字_略過鍵( $樹, [ '詩題', 'a' ] );
//echo $contents;

file_put_contents(
	'H:\github\CanonicalTextTrees' . 
	'\corpus\dufu\新刊校定集注杜詩\views' . '\0001_poem.md',
	$contents . NL );


$comments = array();
$counter = 0;
collect_comments( $樹 );
//print_r( $樹 );
//print_r( $comments );
//echo $counter, NL;

function collect_comments( array &$tree )
{
	global $comments;
	global $counter;
	
	foreach( $tree as $k => $v )
	{
		if( $k == 'a' )
		{
			if( $v != '' )
			{
				$counter++;
				$comments[] = "[${counter}] " . 
				str_replace( '<sub>', '',
					str_replace( '</sub>', '', $v ) );
				$tree[ $k ] = "[${counter}]";
			}
		}
		elseif( is_array( $v ) )
		{
			collect_comments( $tree[ $k ] );
		}
	}
}

$contents = '## ' . 攤平樹文字_略過鍵( $樹[ '0276' ][ '詩題' ] ) . NL . NL;

for( $i = 3; $i < 25; $i++ )
{
	$contents .= 攤平樹文字_略過鍵( $樹[ '0276' ][ (string) $i ] );
}

$contents = preg_replace( '/(。)(\[\d+?\])/u', "$2$1",
	$contents );
$contents .= NL . NL . '【注釋】' . NL .
	implode( "\r\n", $comments );

file_put_contents(
	'H:\github\CanonicalTextTrees' . 
	'\corpus\dufu\新刊校定集注杜詩\views' . '\0001_number.md',
	$contents . NL );





/*
$樹[ '0003' ][ '詩題' ][ '1' ] = 'mong6 ngok6';
//print_r( $樹[ '0003' ][ '詩題' ][ '0' ] );
print_r( $樹 );
echo NL;
*/
/*
$樹 = 提取基準正文樹( '0013' );
添加標點符號( $樹 );
添加錨( $樹 );
print_r( json_encode( $樹, JSON_UNESCAPED_UNICODE ) );
*/
//array &$陣列, array $路徑, int $開始=0, string $字='',
/*
$i = 1;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
//確認爲眞(
	替換路徑字( $樹, 
		array( '0003', '3', '1', '5' ), "Hi" );//, "case#: ${i}" //);
print_r( $樹 );
*/
/*
$i++;
$樹 = 提取數據結構( BASE_TEXT_DIR . '0003' );
// need to figure out why no InvalidPathException thrown
確認會丟( function(){ 
	替換路徑字( 
		$樹,
		array( '0002', '3', '1', '5' ), "Hi" );
	}, TypeError::class, "case#: ${i}" );
*/
?>