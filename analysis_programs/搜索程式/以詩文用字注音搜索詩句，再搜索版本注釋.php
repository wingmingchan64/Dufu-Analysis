<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以詩文用字注音搜索詩句，再搜索版本注釋.php "nang4 lei6" 今
=>
Array
(
    [能吏逢聯璧] => Array
        (
            [0] => 能吏：有才能的官吏。
            [1] => 聯璧：本指并列的美玉，常比喻兩者可相媲美。
        )
)
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 注音_詩句 );
require_once( 詩句_坐標 );
require_once( 書目簡稱 );

checkARGV( $argv, 3, 提供音、簡 );
$音 = trim( $argv[ 1 ] );
$簡稱 = trim( $argv[ 2 ] );
$result = array();

foreach( $注音_詩句  as $注音 => $詩句 )
{
	if( containsPronunciation( $注音, $音 ) )
	{
		$result[ $詩句 ] = array();
	}
}

if( sizeof( $result ) == 0 )
{
	array_push( 無結果 );
}
else
{
	foreach( array_keys( $result ) as $詩句 )
	{
		$坐標 = $詩句_坐標[ $詩句 ];
		$頁碼 = 提取頁碼( $坐標 );
		$裸坐標 = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );
		
		if( file_exists( 杜甫資料庫 . $書目簡稱[ "=${簡稱}" ] . "\\" . $頁碼 . ".php" ) )
		{
			require_once( 杜甫資料庫 . $書目簡稱[ "=${簡稱}" ] . "\\" . $頁碼 . ".php" );
			$陣列名 = "${簡稱}内容";
			$注釋s = $$陣列名[ 注釋 ];
			
			foreach( array_keys( $注釋s ) as $注釋坐標 )
			{
				if( mb_strpos( $注釋坐標, $裸坐標 ) !== false )
				{
					array_push( $result[ $詩句 ], $注釋s[ $注釋坐標 ] );
				}
			}
		}
	}
}

print_r( $result );
?>