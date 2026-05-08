<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\coords\生成詩句路徑.php
*/
require_once(
	dirname( __DIR__, 2 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	'函式.php' );

$杜甫詩陣列 = 提取數據結構( 杜甫詩陣列 );
$路徑_句 = array();
$句_路徑 = array();

foreach( $杜甫詩陣列 as $文檔碼 => $文檔陣列 )
{
	$根 = $杜甫詩陣列[ $文檔碼 ];
	$路徑 = $文檔碼 . ',';
	
	if( 是組詩( $文檔碼 ) )
	{
		foreach( $文檔陣列 as $首碼 => $首陣列 )
		{
			if( intval( $首碼 ) )
			{
				$路徑 = $文檔碼 . ',' . $首碼 . ',';
				
				foreach( $首陣列 as $行碼 => $行陣列 )
				{
					if( intval( $行碼 ) )
					{
						$路徑 = $文檔碼 . ',' . 
							$首碼 . ',' . $行碼 . ',';
						
						foreach( $行陣列 as $句碼 => $句陣列 )
						{
							$路徑 = $文檔碼 . ',' . $首碼 .
								',' . $行碼 . ',' . $句碼;
							$路徑_句[ $路徑 ] =
								implode( $句陣列 );
							
						}
					}
				}
			}
		}
		$路徑 = $文檔碼 . ',';
	}
	else
	{
		
		foreach( $文檔陣列 as $行碼 => $行陣列 )
		{
			if( intval( $行碼 ) )
			{
				$路徑 = $文檔碼 . ',' . 
					$行碼 . ',';
				
				foreach( $行陣列 as $句碼 => $句陣列 )
				{
					$路徑 = $文檔碼 . ',' . $行碼 . ',' . $句碼;
					$路徑_句[ $路徑 ] =
						implode( $句陣列 );
				}
			}
		}
	}
}

foreach( $路徑_句 as $路徑 => $句 )
{
	if( !array_key_exists( $句, $句_路徑 ) )
	{
		$句_路徑[ $句 ] = [ $路徑 ];
	}
	else
	{
		$句_路徑[ $句 ][] = $路徑;
	}
}

$json = json_encode(
	$路徑_句,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR .
	"路徑_句.json",
	$json . PHP_EOL );

$json = json_encode(
	$句_路徑,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	dirname( __DIR__, 4 ) . DS . 
	SCHEMAS_JSON_COORDS_DIR .
	"句_路徑.json",
	$json . PHP_EOL );
?>