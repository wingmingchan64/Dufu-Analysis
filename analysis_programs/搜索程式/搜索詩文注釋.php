<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\搜索詩文注釋.php 能吏逢聯璧 仇,浦,今
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( "h:\\github\\Dufu-Analysis\\書目簡稱.php" );
require_once( "h:\\github\\Dufu-Analysis\\詩句_坐標.php" );


if( sizeof( $argv ) < 3 )
{
	echo "必須提供詩句、簡稱。", "\n";
	exit;
}
$詩句 = trim( $argv[ 1 ] ); // 完整的詩句
$簡稱s = trim( $argv[ 2 ] );
$簡稱s = explode( ',', $簡稱s );
$result = array();

// find 坐標 of $詩句
if( array_key_exists( $詩句, $詩句_坐標 ) )
{
	$坐標 = $詩句_坐標[ $詩句 ];
	echo $坐標, "\n";
}
else
{
	echo "沒找著\"${詩句}\"\n";
	exit;
}
$頁碼 = 提取文檔碼( $坐標 );
$裸坐標 = str_replace( '〛', '', str_replace( '〚', '', $坐標 ) );
//echo $頁碼, "\n";
//echo $裸坐標, "\n";

foreach( $簡稱s as $簡稱 )
{
	if( array_key_exists( "=${簡稱}", $書目簡稱 ) &&
		file_exists( 杜甫資料庫 . $書目簡稱[ "=${簡稱}" ] . "\\" . $頁碼 . ".php" )
	)
	{
		require_once( 杜甫資料庫 . $書目簡稱[ "=${簡稱}" ] . "\\" . $頁碼 . ".php" );
		$陣列名 = "${簡稱}内容";
		$注釋s = $$陣列名[ "注釋" ];
		$result[ $簡稱 ] = array();
		
		foreach( array_keys( $注釋s ) as $注釋坐標 )
		{
			if( mb_strpos( $注釋坐標, $裸坐標 ) !== false )
			{
				array_push( $result[ $簡稱 ], $注釋s[ $注釋坐標 ] );
			}
		}
	}
}
print_r( $result );
?>
