<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\生成後設資料樹_test.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidCoordinateException;

//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$默文檔碼 = '0003';
$著述碼   = 'JINGQUAN';
$版文檔碼 = '0002';
$m_tree = 生成後設資料樹( $默文檔碼, $著述碼, $版文檔碼 );
// 著述碼+版文檔碼+類別+範圍+來源+函式
/*
echo json_encode(
    $m_tree,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
*/
//print_r( $m_tree );


$paths = array();
//record_mtree_paths( $m_tree[ $著述碼 ][ $版文檔碼 ][ '注釋' ], '' );
record_mtree_paths( $m_tree, '' );
//print_r( $paths );

$樹 = 挂樹飾( $默文檔碼, $著述碼 . ',' . $版文檔碼, $paths );
//print_r( $樹 );
生成HTML面貌( $樹 );
print_r( $樹 );


function record_mtree_paths( array $m_tree, string $parent )
{
	global $paths;
	
	foreach( $m_tree as $k => $v )
	{
		if( is_string( $v ) )
		{
			$paths[] = $parent . '_' . $k . '_' . $v;
		}
		else
		{
			if( $parent == '' )
			{
				record_mtree_paths( $m_tree[ $k ], $k );
			}
			else{
				record_mtree_paths( $m_tree[ $k ], 
					$parent . '_' . $k );
			}
		}
	}
}

/*
$i = 1;
確認會丟( function(){ 提取首碼( '〚0013:〛' ); }, InvalidCoordinateException::class, "case#: ${i}" );
$i++;
確認相等( 提取首碼( '〚0013:2:〛' ), '2', "case#: ${i}" );
$i++;
確認會丟( function(){ 
	提取首碼( '〚001:〛' ); }, 
	InvalidCoordinateException::class, "case#: ${i}" );
*/
?>