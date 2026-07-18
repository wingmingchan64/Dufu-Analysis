<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\metadata\生成後設資料樹.php
*/
use Dufu\Exceptions\ConfirmationFailureException;
use Dufu\Exceptions\InvalidCoordinateException;

require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

$默文檔碼 = '0943';
$著述s = array(
	array( "", "" ),
	array( "", "" ),
	array( "", "" ),
	array( "", "" ),
	array( "", "" ),
);
//$著述碼   = 'DDXJ';
//$版文檔碼 = '0035';
$著述碼   = 'CHOUZHU';
$版文檔碼 = '0145';
//$著述碼   = 'DFQJYYZY';
//$版文檔碼 = '0943';
//$著述碼   = 'DFQSYZ';
//$版文檔碼 = '0188';
//$著述碼   = 'DUYI';
//$版文檔碼 = '0126';
//$著述碼   = 'JINGQUAN';
//$版文檔碼 = '0141';
//$著述碼   = 'QIANZHU';
//$版文檔碼 = '0060';
//$著述碼   = 'OWEN';
//$版文檔碼 = '05.27';
//$著述碼   = 'TSJSCD';
//$版文檔碼 = '0943';
//$著述碼   = 'XDF';
//$版文檔碼 = '0146';
//$著述碼   = 'ZDZSQTS';
//$版文檔碼 = '206.13';
//$著述碼   = 'ZHANGNIANPU';
//$版文檔碼 = '0943';
//$著述碼   = 'ZHAOZHU';
//$版文檔碼 = '0141';

生成後設資料樹( $默文檔碼, $著述碼, $版文檔碼 );
?>