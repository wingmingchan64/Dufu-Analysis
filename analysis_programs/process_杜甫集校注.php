<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_杜甫集校注.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 頁碼 );
require_once( 詩組_詩題 );

$text    = getFile( 'H:\杜甫資料庫\謝思煒《杜甫集校注》\謝目錄.txt' );
$lines   = explode( "\n", $text );
$store   = array();
$content = '';
$詩組頁碼 = array_keys( $詩組_詩題 );
$content = '';

foreach( $lines as $l )
{
	if( $l == '' || mb_strpos( $l, '//' ) === false )
	{
		continue;
	}
	else // only lines with //
	{
		// remove //
		$l = str_replace( '// ', '', $l );
		// space-separated page info
		$l_array = explode( ' ', $l );
		$題 = $l_array[ 0 ];
		$頁 = trim( $l_array[ 1 ] );
		$謝頁 = trim( $l_array[ 2 ] );
		
		if( $頁 == '' )
			continue;
		
		$content .= "'${頁}'=>'${謝頁}'," . NL;
		
/*		
		try {
			require_once( 詩集文件夾 . $頁 . 程式後綴 );
		} catch( Exception $e ) { echo $e, NL, $頁, NL; }
		
		if( in_array( $頁, $詩組頁碼 ) )
		{
			$size = sizeof( $詩組_詩題[ $頁 ][ 1 ] );
			foreach( range( 1, $size ) as $j )
			{
				$counter++;
				$found = false;
				
				foreach( $内容[ 坐標_句 ] as $坐標 => $句 )
				{
					//echo $坐標, $句, NL;
					if( $found )
					{
						continue;
					}
					if( strpos( $坐標, "〚$頁:$j:" ) !== false )
					{
						$found = true;
						echo "'〚$頁:$j:〛'=>'" . $句 . "',", NL;
					}
				}
				

				
			}
		}
		else
		{
			$counter++;
			echo "'〚$頁:〛'=>'" . $内容[ 詩句 ][ 0 ] . "',", NL;
		}
*/
	}
}
echo $content;
?>

