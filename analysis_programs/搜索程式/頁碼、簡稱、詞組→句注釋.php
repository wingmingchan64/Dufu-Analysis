<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱、詞組→句注釋.php 0668 名 鬱律
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
//require_once(  );

checkARGV( $argv, 4, 提供頁、簡、詞 );
$頁碼 = fixPageNum( trim( $argv[ 1 ] ) );
$簡稱 = fixText( trim( $argv[ 2 ] ) );
$詞組 = fixText( trim( $argv[ 3 ] ) );

if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無結果 . NL;
	exit;
}
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$路徑 = 杜甫資料庫 . $書名 . "\\" . "${書名}注釋" . 程式後綴;
require_once( 詩集文件夾 . $頁碼 . 程式後綴 );
require_once( $路徑 );

$詞組坐標 = 提取〖詩文〗坐標( $詞組, $頁碼 );
$詞組坐標 = str_replace( '〛', '', $詞組坐標 );
$陣列名 = $書名 . 注釋;

$句坐標 = '';

foreach( $内容[ 坐標_句 ] as $詩句坐標 => $詩句 )
{
	if( mb_strpos( $詩句, $詞組 ) !== false ) // first instance
	{
		$句坐標 = str_replace( '〛', '', $詩句坐標 );
		echo $書名, NL;
		echo "語境： $詩句", NL;
		break;
	}
	else	
	{
		continue;
	}
}
$found = false;

foreach( $$陣列名 as $坐 => $注 )
{
	if( !( $詞組坐標 == '' && $句坐標 == '' ) &&
		( mb_strpos( $坐, $詞組坐標 ) !== false || 
		  mb_strpos( $坐, $句坐標 ) !== false ) )
	{
		echo $注, NL;
		$found = true;
	}
	else
	{
		continue;
	}
}

if( !$found )
{
	echo 無結果, NL;
}
?>