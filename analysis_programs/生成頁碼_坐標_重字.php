<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成頁碼_坐標_重字.php
*/
require_once( "常數.php" );
require_once( "函式.php" );
require_once( 頁碼 );
require_once( 詩組_詩題 );
require_once( 杜甫資料庫 . '疊字_坐標.php' );

$result = array();
$temp   = array();

foreach( $頁碼 as $頁 )
//$頁 = '0013';
{
	//if( intval( $頁 > 100 ) ){ break; }
		
	require_once( 詩集文件夾 . $頁 . '坐標_用字' . 程式後綴 );
	
	foreach( $坐標_用字 as $坐標 => $用字 )
	{
		// ignore 疊字
		if( array_key_exists( $用字 . $用字, $疊字_坐標 ) &&
			in_array( $坐標, $疊字_坐標[ $用字 . $用字 ] ) )
		{
			continue;
		}
		
		$坐標 = str_replace( "${頁}:", '', $坐標 );
		
		if( array_key_exists( $頁, $詩組_詩題 ) )
		{
			$首碼 = 提取首碼( $坐標 );
			
			if( !array_key_exists( $首碼, $temp ) )
			{
				$temp[ $首碼 ] = array();
			}
			
			if( !array_key_exists( $用字, $temp[ $首碼 ] ) )
			{
				$temp[ $首碼 ][ $用字 ] = array( $坐標 );
			}
			else
			{
				array_push( $temp[ $首碼 ][ $用字 ], $坐標 );
			}
		}
		else
		{
			if( !array_key_exists( $用字, $temp ) )
			{
				
				$temp[ $用字 ] = array( $坐標 );
			}
			else
			{
				array_push( $temp[ $用字 ], $坐標 );
			}
		}
	}

	foreach( $temp as $第一 => $第二 )
	{
		if( array_key_exists( $頁, $詩組_詩題 ) )
		{
			foreach( $第二 as $字 => $標s )
			{
				if( sizeof( $標s ) > 1 )
				{
					$result[ $頁 ][ $第一 ][ $字 ] = $標s;
				}
			}
		}
		else
		{
			if( sizeof( $第二 ) > 1 )
			{
				$result[ $頁 ][ $第一 ] = $第二;
			}
		}
	}
	$temp = array();

}

$code = "<?php
/*
程式：生成頁碼_坐標_重字
説明：儲存有重複用字的詩
這裏單單考慮字形，不管某字是否多音、多義字
不包括疊字
*/
\$頁碼_坐標_重字=array(\n";

foreach( $result as $頁 => $首字坐s )
{
	$code .= "\"${頁}\"=>array(\n";
	
	// $result[ $頁 ][ $第一 ][ $字 ] = $標s;
	if( array_key_exists( $頁, $詩組_詩題 ) )
	{
		foreach( $首字坐s as $首 => $字坐s )
		{
			$code .= "\"${首}\"=>array(\n";
			
			foreach( $字坐s as $字 => $坐s )
			{
				$code .= "\"${字}\"=>array(";
				foreach( $坐s as $坐 )
				{
					$code .= "\"${坐}\",";
				}
				$code .= "),\n";
			}
			
			$code .= "),\n";
		}
	}
	else
	{
		foreach( $首字坐s as $字 => $坐s )
		{
			$code .= "\"${字}\"=>array(";
			
			foreach( $坐s as $坐 )
			{
				$code .= "\"${坐}\",";
			}
			$code .= "),\n";
		}
	}
	
	$code .= "),\n";
}


$code .= ");\n?>";

echo sizeof( array_keys( $result ) ), NL;

file_put_contents( 杜甫資料庫 . '頁碼_坐標_重字.php', $code );
file_put_contents( 杜甫分析文件夾 . '頁碼_坐標_重字.php', $code );
?>