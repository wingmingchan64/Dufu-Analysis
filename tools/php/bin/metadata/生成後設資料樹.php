<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\metadata\生成後設資料樹.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidCoordinateException;

//設定測試檔( basename( __FILE__ ) );
$debug = false;
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$默文檔碼 = '0943';
//$著述碼   = 'JINGQUAN';
$著述碼   = 'XDF';
$版文檔碼 = '0146';
生成後設資料樹( $默文檔碼, $著述碼, $版文檔碼 );

// 著述碼+版文檔碼+類別+範圍+來源+函式
/*
echo json_encode(
    $m_tree,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);
*/
/*
$m_tree = 提取後設資料樹( $著述碼, $版文檔碼 );
//print_r( $m_tree );
$paths = array();
record_mtree_paths( $m_tree );
//record_mtree_paths( $m_tree[ $著述碼 ][ $版文檔碼 ][ '注釋' ] );

//print_r( $paths );

$樹 = 挂樹飾( $默文檔碼, $著述碼 . ',' . $版文檔碼, $paths );
//print_r( $樹 );
生成HTML面貌( $樹 );
//print_r( $樹 );
*/


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