<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\catalog\生成版本目錄對照表.php
 */
require_once( 
	dirname( __DIR__, 3) . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$簡稱陣列 = array( '全', '趙', '郭', '奭', '仇', '蕭', '謝', '訳' );
$版本目錄對照表 = array();
$書目簡稱 = 提取數據結構( 書目簡稱 );
$默認版本詩碼 = 提取數據結構( 默認版本詩碼 );
$默認詩文檔碼_詩題 = 提取數據結構( 默認詩文檔碼_詩題 );

foreach( $簡稱陣列 as $簡稱 )
{
	$路徑名 = $簡稱 . 'path';
	$$路徑名 = dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
		$書目簡稱[ $簡稱 ] . DS . 'catalog' . DS .
		"${簡稱}目錄.json";
	$目錄名 =  $簡稱 . '目錄';
	$$目錄名 = json_decode( file_get_contents( $$路徑名 ), true );
	
/*
$path = dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	$書目簡稱[ '全' ] . DS . '全目錄.json';
$全目錄 = json_decode( file_get_contents( $path ), true );

$path = dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	$書目簡稱[ '趙' ] . DS . '趙目錄.json';
$趙目錄 = json_decode( file_get_contents( $path ), true );

$path = dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	$書目簡稱[ '郭' ] . DS . '郭目錄.json';
$郭目錄 = json_decode( file_get_contents( $path ), true );

$path = dirname( __DIR__, 4 ) . DS . PACKAGES_DIR .
	$書目簡稱[ '蕭' ] . DS . '蕭目錄.json';
$蕭目錄 = json_decode( file_get_contents( $path ), true );
*/
}
foreach( $默認版本詩碼 as $默詩碼 )
{
	//echo $默詩碼, NL;
	if( intval( $默詩碼 ) > 6093 )
	{
		break;
	}
	
	$temp = array();
	
	if( $簡稱 != '奭' )
	{
		$temp[ '默詩碼' ] = $默詩碼;
	}

	$默文檔碼 = preg_replace( '/-\d+/u', '', $默詩碼 );
	$temp[ '默認詩題' ] = $默認詩文檔碼_詩題[ $默文檔碼 ];
	$temp[ '版本' ] = array();
	
	foreach( $簡稱陣列 as $簡稱 )
	{
		$目錄名 =  $簡稱 . '目錄';
		
		foreach( $$目錄名 as $詩目 )
		{
			if( $簡稱 != '奭' && $詩目[ "默詩碼" ] == $默詩碼 )
			{
				unset( $詩目[ "默詩碼" ] );
				$temp[ '版本' ][ $簡稱 ] = $詩目;
				break;
			}
			elseif( $簡稱 == '奭' && $詩目[ "默文檔碼" ] == $默文檔碼 )
			{
				$temp[ '版本' ][ $簡稱 ] = $詩目;
				break;
			}
		}
	}
	
	/*
	foreach( $全目錄 as $全詩 )
	{
		if( $全詩[ "默詩碼" ] == $默詩碼 )
		{
			unset( $全詩[ "默詩碼" ] );
			$temp[ '版本' ][ '全' ] = $全詩;
			break;
		}
	}
	
	foreach( $趙目錄 as $趙詩 )
	{
		if( $趙詩[ "默詩碼" ] == $默詩碼 )
		{
			unset( $趙詩[ "默詩碼" ] );
			$temp[ '版本' ][ '趙' ] = $趙詩;
			break;
		}
	}
	
	foreach( $郭目錄 as $郭詩 )
	{
		if( $郭詩[ "默詩碼" ] == $默詩碼 )
		{
			unset( $郭詩[ "默詩碼" ] );
			$temp[ '版本' ][ '郭' ] = $郭詩;
			break;
		}
	}
	
	foreach( $蕭目錄 as $蕭詩 )
	{
		if( $蕭詩[ "默詩碼" ] == $默詩碼 )
		{
			unset( $蕭詩[ "默詩碼" ] );
			$temp[ '版本' ][ '蕭' ] = $蕭詩;
			break;
		}
	}
	*/
	
	$版本目錄對照表[ $默詩碼 ] = $temp;

}
//print_r( $版本目錄對照表 );

$json = json_encode(
    $版本目錄對照表,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4) . DS . PACKAGES_DIR . "版本目錄對照表.json",
	$json . PHP_EOL );

print_r(
	json_decode( 
		file_get_contents( 
			dirname( __DIR__, 4) . DS . PACKAGES_DIR . 
			"版本目錄對照表.json" ), true )[ '0013-1' ] );
?>