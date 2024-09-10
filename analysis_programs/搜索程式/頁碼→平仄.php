<?php
/*
// 決定用字平仄的根據是
// https://sou-yun.cn/
// https://zh.wiktionary.org/wiki/Rhymes:%E6%BC%A2%E8%AA%9E/%E5%B9%B3%E6%B0%B4%E9%9F%BB
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→平仄.php 0034
=>
胡馬大宛名。鋒稜瘦骨成。
平仄仄◯平，平平仄仄平

竹批雙耳峻。風入四蹄輕。
仄◯平仄仄，平仄仄平平

所向無空闊。眞堪託死生。
仄仄平◯仄，平平仄仄平

驍騰有如此。萬里可橫行。
平平仄◯仄，仄仄仄◯平

// ◯代表該字爲多音字，可平可仄
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字_韻部 );
require_once( 平水韻文件夾 . '韻部_平仄' . 程式後綴 );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = fixPageNum( trim( $argv[ 1 ] ) );
$路徑 = 詩集文件夾 . $頁碼 . 程式後綴;
$注音路徑 = 杜甫全集粵音注音文件夾 . $頁碼 . 程式後綴;
$近體詩 = array(
	'五絕','五律','五排',
	'七絕','七律','七排',
);

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	require_once( $注音路徑 );
	
	foreach( $内容[ 行碼 ] as $坐 => $行 )
	{
		if( $坐 == '〚1〛' || $行 ==  '' ) // 
		{
			continue;
		}
		else
		{
			$字數 = mb_strlen( $行 );
			$平仄内容 = $行 . NL;
			
			for( $i = 0; $i < $字數; $i++ )
			{
				if( mb_substr( $行, $i, 1 ) == '。' )
				{
					if( $i == $字數 - 1 )
					{
						continue;
					}
					$平仄内容 .= '，';
					continue;
				}
			
				$韻部 = $字_韻部[ mb_substr( $行, $i, 1 ) ];
				$result = array();
				
				foreach( $韻部 as $韻 )
				{
					if( !in_array( $韻部_平仄[ $韻 ], $result ) )
					{
						array_push( $result, $韻部_平仄[ $韻 ] );
					}
				}
				if( sizeof( $result ) == 1 )
				{
					$平仄内容 .= $result[ 0 ];
				}
				elseif( sizeof( $result ) == 2 )
				{
					if( $i == $字數 - 2 && // 對句末字
						//in_array( $粵内容[ 體裁 ], $近體詩 ) )
						(
							in_array( str_replace( '〚1:〛', '', $粵内容[ 體裁 ] ), $近體詩 ) ||
							in_array( str_replace( '〚2:〛', '', $粵内容[ 體裁 ] ), $近體詩 ) ||
							in_array( str_replace( '〚3:〛', '', $粵内容[ 體裁 ] ), $近體詩 ) 
						) )
					{
						$平仄内容 .= '平';
					}
					else
					{
						$平仄内容 .= '◯';
					}
				}
			}
			$平仄内容 .= NL;
		}
		echo $平仄内容, NL;
	}
}
else
{
	echo 無結果, NL;
}
?>