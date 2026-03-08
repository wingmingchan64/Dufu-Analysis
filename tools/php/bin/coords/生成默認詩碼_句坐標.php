<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成默認詩碼_句坐標.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$默認詩文檔碼 = 提取數據結構( 默認詩文檔碼 );
$默認文檔碼_默認詩碼 = 提取數據結構( 默認文檔碼_默認詩碼 );
$句碼_詩句 = 提取數據結構( 句碼_詩句 );
$默認詩碼_句坐標 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	if( intval( $文檔碼 ) > 6093 )
		break;
	
	$詩碼 = $默認文檔碼_默認詩碼[ $文檔碼 ];
	
	if( is_string( $詩碼 ) )
	{
		//print_r( array_keys( $句碼_詩句[ $文檔碼 ] ) );
		$默認詩碼_句坐標[ $詩碼 ] = array_keys( $句碼_詩句[ $文檔碼 ] );
	}
	else
	{
		foreach( $詩碼 as $碼 )
		{
			$默認詩碼_句坐標[ $碼 ] = array();
			
			foreach( $句碼_詩句[ $文檔碼 ] as $坐標 => $詩 )
			{
				$標 = str_replace( '-', ':', $碼 );
				
				if( strpos( $坐標, $標 ) !== false )
				{
					$默認詩碼_句坐標[ $碼 ][] = $坐標;
				}
			}
		}
	}
		
}

$json = json_encode(
	$默認詩碼_句坐標,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	
file_put_contents(
	dirname( __DIR__, 4 ) . DS . SCHEMAS_JSON_COORDS_DIR .
	"默認詩碼_句坐標.json",
	$json . PHP_EOL );

?>