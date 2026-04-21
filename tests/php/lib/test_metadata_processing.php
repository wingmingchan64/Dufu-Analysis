<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\test_metadata_processing.php
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

$文檔碼 = '0003';
$樹 = 提取基準正文樹( $文檔碼 );
添加標點符號( $樹 );
添加錨( $樹 );
//echo is_array( $樹 ) ? 'true' : 'false' , NL;
$metadata = file_get_contents( 'H:\github\DuFu\packages\陳永明《杜甫全集粵音注音》' . DIRECTORY_SEPARATOR . $文檔碼 . '.txt' );
$lines = explode( '〙', $metadata );

$count = 0;

foreach( $lines as $line )
{
	$line = trim( $line );
	
	if( $line == '' )
	{
		continue;
	}
	$parts = explode( '〘', $line );
	$text = trim( $parts[ 0 ] );
	$tags = json_decode( $parts[ 1 ], true );
	
	$anchor = $tags[ 'anchor' ];
	$op = $tags[ 'op' ];
	
	if( $op == 'assign' )
	{
		assign( $樹, explode( ',', $anchor ), $text );
	}
	
	if( $op == 'insert_tree' )
	{
		$mtree = json_decode( $text, true );
		assign( $樹, explode( ',', $anchor ), $mtree );
	}
}

print_r( $樹 );


function assign( array &$tree, array $path, mixed $value )
{
	//print_r( $tree );
	
	$pointer = &$tree;
	
	foreach( $path as $segment )
	{
		$pointer = &$pointer[ $segment ];
	}
	
	$pointer = $value;
}
?>