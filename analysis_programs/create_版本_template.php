<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\create_版本_template.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 書目簡稱 );

$簡字 = "郭";
//$簡字 = "楊";
//$簡字 = "黃";
//$簡字 = "浦";
//$簡字 = "錢";
//echo $簡字, NL;

$簡稱 = "=${簡字}";
$書名 = $書目簡稱[ $簡稱 ];
$目錄文檔 = 杜甫分析文件夾 . $書名 . "\\" . "${簡字}目錄.txt";

$text    = getFile( $目錄文檔 );
$lines   = explode( "\n", $text );
$store   = array();
$content = '本文檔以 h:\github\Dufu-Analysis\analysis_programs\create_版本_template.php 生成。' . NL . NL;

foreach( $lines as $l )
{
	if( mb_strpos( $l, '===' ) !== false )
	{
		break;
	}
	elseif( $l == '' || mb_strpos( $l, '//' ) === false )
	{
		continue;
	}
	else // only lines with //
	{
		// remove //
		$l = str_replace( '// ', '', $l );
		// space-separated page info
		$l_array = explode( ' ', $l );
		// 詩題
		$題 = $l_array[ 0 ];
		// 默認頁碼
		//echo $題, NL;
		$頁 = trim( $l_array[ 1 ] );
		// 版本頁碼
		$版本頁 = trim( $l_array[ 2 ] );
		
		if( $頁 == '' )
			continue;

		$〖詩句〗 = '';
		$路徑 = 詩集文件夾 . $頁 . 程式後綴;

		if( file_exists( $路徑 ) )
		{
			require_once( $路徑 );
			
			if( $簡字 == "郭" )
			{
				$content .= NL .
"=典====================================================
《引典出處》

【注釋】
";
/*
				if( $内容[ 詩題 ] != $題 )
				{
					$content .= '〖1〗' . $題 . NL;
				}
				else
				{
					$content .= '〖1〗' . NL;
				}
*/
				foreach( $内容[ 詩句 ] as $句 )
				{
					$content .= "〖${句}〗" . NL;
				}
			}
			
			$content .= NL . $頁 . ' ' . $内容[ 詩題 ] . NL .
				"${簡稱}===================================================" . 
				NL;
			$content .= $書名 . $版本頁 . NL . NL;
			$content .= 【異文、夾注】 . NL;
			
			if( $内容[ 詩題 ] != $題 )
			{
				$content .= '〖1〗' . $題 . NL;
			}
			else
			{
				$content .= '〖1〗' . NL;
			}

			foreach( $内容[ 詩句 ] as $句 )
			{
				$〖詩句〗 .= "〖${句}〗" . NL;
			}
			$content .= $〖詩句〗 . NL;
			$content .= 【大意】 . NL . '〚〛' . NL . NL . 
				【注釋】 . NL . '〖1〗' . NL . $〖詩句〗 . NL . 
				【評論】 . NL . '〚〛' . NL . NL . 
				【按語】 . NL ;
		}
		elseif( $頁 == '6497' )
		{
			continue;
		}
		else
		{
			echo $頁, NL;
			exit;
		}
	}
}

$outfile = 杜甫資料庫 . $書名 . "\\" . "${簡字}template.txt";
file_put_contents( $outfile, $content );
$outfile = 杜甫分析文件夾 . $書名 . "\\" . "${簡字}template.txt";
file_put_contents( $outfile, $content );
?>

