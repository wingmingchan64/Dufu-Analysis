<?php
/*

php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→平仄.php 0034
=>
〚0034:3〛平仄仄◯平，平平仄仄平
〚0034:4〛仄◯平仄仄，平仄仄平平
〚0034:5〛仄仄平◯仄，平平仄仄平
〚0034:6〛平平仄◯仄，仄仄仄◯平

// ◯代表該字可平可仄
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 字_韻部 );
require_once( 平水韻文件夾 . '韻部_平仄' . 程式後綴 );

checkARGV( $argv, 2, 提供頁碼 );
$頁碼 = trim( $argv[ 1 ] );
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

	foreach( $内容[ 坐標_句 ] as $坐 => $句 )
	{
		$首句 = true;
		$字數 = mb_strlen( $句 );
		
		if( mb_strpos( $坐, '.1' ) )
		{
			$平仄内容 = str_replace( '.1', '', $坐 );
		}
		else
		{
			$首句 = false;
		}
		
		for( $i = 0; $i < $字數; $i++ )
		{
			$韻部 = $字_韻部[ mb_substr( $句, $i, 1 ) ];
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
				if( !$首句 && $i == $字數 - 1 && // 對句末字
					in_array( $粵内容[ 體裁 ], $近體詩 ) )
				{
					$平仄内容 .= '平';
				}
				else
				{
					$平仄内容 .= '◯';
				}
			}
		}
		if( !$首句 )
		{
			echo $平仄内容, NL;
		}
		else
		{
			$平仄内容 .= '，';
		}
	}
}
else
{
	echo 無結果, NL;
}
?>