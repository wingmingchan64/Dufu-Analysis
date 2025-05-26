<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\process_杜臆.php
*/
require_once( "常數.php" );
require_once( "函式.php" );

$text    = getFile( 'H:\杜甫資料庫\王嗣奭《杜臆》\奭目錄.txt' );
$lines   = explode( "\n", $text );
$store   = array();
$content = '';

foreach( $lines as $l )
{
	if( $l == '' || mb_strpos( $l, '//' ) === false )
	{
		continue;
	}
	else // only lines with //
	{
		$l = str_replace( '// ', '', $l );
		$l_array = explode( ' ', $l );
		
		if( $l_array[ 1 ] == '6497' )
		{
			$content = $content . "哭長孫侍御 6497 PDF107,PDF1.156" . NL . NL;
			$content = $content . "道爲謀書重。名因賦頌雄。禮闈曾擢桂。憲府舊乘驄。流水生涯盡。浮雲世事空。唯餘舊臺柏。蕭瑟九原中。" . NL . NL;
			
			$content = $content . "「舊乘驄」、「舊臺柏」，不但字重而意亦重，他本作「屢乘驄」，當從之。" . NL . NL;
			
			continue;
		}
		
		$默認頁碼 = $l_array[ 1 ];
		try
		{
			//echo $默認頁碼, NL;
		require_once( 詩集文件夾 . $默認頁碼 . 程式後綴 );
		}
		catch( ErrorException $e )
		{
			//echo '頁碼', $默認頁碼;
			//exit;
		}
		
		$版本詩題 = $l_array[ 0 ];
		$默認詩題 = $内容[ 詩題 ];
		$默認詩文 = $内容[ 詩文 ];
		
		if( $版本詩題 != $默認詩題 )
		{
			$版本詩題 = '*' . $版本詩題;
		}
		
		try {
		$版本詩題 = trim( $版本詩題 ) . ' ' . $默認頁碼 . ' ' .
			$l_array[ 2 ] . NL; }
		catch( Exception $e )
		{
			echo $默認頁碼, NL;
		}

		$content = $content . $版本詩題;
		$content = $content . $默認詩文 . NL . NL;
		
		$版本路徑 = 杜臆 . $默認頁碼 . 程式後綴;
		
		if( file_exists( $版本路徑 ) )
		{
			require_once( $版本路徑 );
			
			if( is_string( $奭内容[ 評論 ] ) )
			{
				$content = $content . $奭内容[ 評論 ] . NL . NL;
			}
			elseif( is_array( $奭内容[ 評論 ] ) )
			{
				$content = $content . 提取陣列値( $奭内容[ 評論 ] ) . NL . NL;
			}
		}
	}
}

$outfile = 杜臆 . "王嗣奭《杜臆》_帶詩文.txt";
file_put_contents( $outfile, $content );
$outfile = "H:\\github\\Dufu-Analysis\\王嗣奭《杜臆》\\" . "王嗣奭《杜臆》_帶詩文.txt";
file_put_contents( $outfile, $content );
?>

