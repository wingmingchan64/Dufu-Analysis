<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_杜臆.php
*/
require_once( "常數.php" );
require_once( "函式.php" );

$text    = getFile( 'H:\杜甫資料庫\王嗣奭《杜臆》\text.txt' );
$lines   = explode( "\n", $text );
$store   = array();
$content = '';

foreach( $lines as $l )
{
	if( $l == '' )
	{
		continue;
	}
	elseif( mb_strpos( $l, '//' ) === false )
	{
		$content = $content . $l . NL;
	}
	else
	{
		$l = str_replace( '// ', '', $l );
		$l_array = explode( ' ', $l );
		
		if( $l_array[ 1 ] == '6497' )
		{
			continue;
		}
		
		$默認頁碼 = $l_array[ 1 ];
		//try
		//{
			//echo $默認頁碼, NL;
		require_once( 詩集文件夾 . $默認頁碼 . 程式後綴 );
		//}
		//catch( ErrorException $e )
		//{
			//echo '頁碼', $默認頁碼;
			//exit;
		//}
		
		$版本詩題 = $l_array[ 0 ];
		$默認詩題 = $内容[ 詩題 ];
		$默認詩文 = $内容[ 詩文 ];
		
		if( $版本詩題 != $默認詩題 )
		{
			$版本詩題 = '*' . $版本詩題;
		}
		
		$版本詩題 = trim( $版本詩題 ) . ' ' . $默認頁碼 . ' ' .
			$l_array[ 2 ] . NL . NL;

		$content = $content . $版本詩題;
		$content = $content . $默認詩文 . NL . NL;
	}
}

$outfile = 杜臆 . "王嗣奭《杜臆》_帶詩文.txt";
file_put_contents( $outfile, $content );

?>

