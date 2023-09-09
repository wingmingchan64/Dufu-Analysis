<?php
/*
php  H:\github\Dufu-Analysis\analysis_programs\生成近體詩出對句平仄頻率.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 杜甫資料庫 . '頁碼.php' );

$五言result = array();
$七言result = array();

foreach( $頁碼 as $頁 )
{
	if( file_exists( 杜甫全集粵音注音文件夾 . $頁 . 程式後綴 ) )
	{
		require_once( 杜甫全集粵音注音文件夾 . $頁 . 程式後綴 );
		
		foreach( $粵内容[ 注音 ] as $詩文 => $v )
		{
			if( is_array( $v ) )
			{
				foreach( $v as $音平仄 )
				{
					if( mb_strpos( $音平仄, '平' ) !== false )
					{
						$parts = explode( '（', $音平仄 );
						// 五言
						if( mb_strlen( $parts[ 0 ] ) == 11 )
						{
							if( !array_key_exists( $parts[ 0 ], $五言result ) )
							{
								$五言result[ $parts[ 0 ] ] = 1;
							}
							else
							{
								$五言result[ $parts[ 0 ] ] += 1;
							}
						}
						elseif( mb_strlen( $parts[ 0 ] ) == 15 )
						{
							if( !array_key_exists( $parts[ 0 ], $七言result ) )
							{
								$七言result[ $parts[ 0 ] ] = 1;
							}
							else
							{
								$七言result[ $parts[ 0 ] ] += 1;
							}
						}
					}
				}
			}
		}
	}
}
arsort( $五言result );
arsort( $七言result );
print_r( $五言result );
print_r( $七言result );

?>
