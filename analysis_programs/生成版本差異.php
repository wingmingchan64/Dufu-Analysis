<?php
require_once( '常數.php' );
require_once( '函式.php' );

require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼_詩題.php' );

$簡稱 = '=蕭';
$簡稱 = '=全';
$前綴 = trim( $簡稱, '=' );
$文件夾 = $書目簡稱[ $簡稱 ];
$var_name = $前綴 . "内容";

foreach( $頁碼 as $頁 )
{
	require_once( "h:\\github\\Dufu-Analysis\\詩集\\${頁}坐標_用字.php" );
	$版本文檔 = "h:\\github\\Dufu-Analysis\\${文件夾}\\${頁}.php";
 
	if( file_exists( $版本文檔 ) )
	{
		require_once( $版本文檔 );
		$版本詩文 = "";

		if( is_array( $$var_name["版本"]["詩文"] ) )
		{
			foreach( $$var_name["版本"]["詩文"] as $詩 )
			{
				$版本詩文 = $版本詩文 . $詩;
			}
			$版本詩文 = str_replace( '。', '', $版本詩文 );
		}
		else
		{
			$版本詩文 = str_replace( '。', '', $$var_name["版本"]["詩文"] );
		}
		$版本詩文 = preg_replace( '/\[\X+?]/', '', $版本詩文 );

		$坐標s = array_keys( $坐標_用字 );
		$差異列陣 = array();
		$key = "〚${頁}:1〛";
		
		if( array_key_exists( $key,
			$$var_name["版本"]["坐標版本異文、夾注"] ) )
		{
			$詩題 = $$var_name["版本"]["坐標版本異文、夾注"][$key];
			$詩題 = str_replace ("〖1〗", '', $詩題 );
			$詩題 = preg_replace( '/\[\X+?]/', '', $詩題 );
	
			if( $頁碼_詩題[$頁] != $詩題 )
			{
				$差異列陣[ $key ] = array(
					$頁碼_詩題[$頁],
					$詩題
				);
			}
		}

		for( $i = 0; $i < sizeof( $坐標_用字 ); $i++ )
		{
			if( $坐標_用字[$坐標s[$i]] != mb_substr( $版本詩文, $i, 1 ) )
			{
				$差異列陣[ $坐標s[$i] ] = array(
					$坐標_用字[$坐標s[$i]],
					mb_substr( $版本詩文, $i, 1 )
				);
			}
		}
$code = "<?php
/*
*/
\$默認版本_${前綴}版本差異=array(\n";
		foreach( $差異列陣 as $坐標 => $差異 )
		{
			$code = $code . "\"$坐標\"=>array(\n" .
				"\"" . $差異[ 0 ] . "\",\n" .
				"\"" . $差異[ 1 ] . "\"),\n";
		}
		$code = $code . "\n?>";

		//$content = print_r( $差異列陣, true );
		$outfile =  "h:\\github\\Dufu-Analysis\\${文件夾}\\${頁}版本差異.php";
		file_put_contents( $outfile, $code );
	}
}
?>