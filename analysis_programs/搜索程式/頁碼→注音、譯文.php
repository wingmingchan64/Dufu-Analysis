<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼→注音、譯文.php 0003
=>
0003望嶽

岱宗夫如何。齊魯青未了。
doi6 zung1 fu4 jyu4 ho4, cai4 lou5 cing1 mei6 liu5
泰山的高大究竟如何？走遍齊魯大地都能看到它的青色。

造化鍾神秀。陰陽割昏曉。
zou6 faa3 zung1 san4 sau3, jam1 joeng4 got3 fan1 hiu2
天地把神奇和秀美聚集在它身上，那高大的山峯陰面是黃昏，陽面卻是清曉。

盪胸生曾雲。決眥入歸鳥。
dong6 hung1 sang1 cang4 wan4, kyut3 zi6 jap6 gwai1 niu5
山間雲氣生騰，層層疊疊，令我心胸激蕩；我極盡目力，追羨那飛入山間的歸鳥。

會當凌絕頂。一覽眾山小。
wui6 dong1 ling4 zyut6 ding2, jat1 laam5 zung3 saan1 siu2
啊，定會有一天登上絕頂，俯看腳下羣山的渺小！
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫全集粵音注音文件夾 . "詩句_注音.php" );
require_once( 杜甫詩全譯 . "韓成武、張志民《杜甫詩全譯》譯文.php" );
require_once( 詩組_詩題 );

if( sizeof( $argv ) < 2 )
{
	echo 提供頁碼, NL;
	exit;
}

$頁碼 = fixPageNum( trim( $argv[ 1 ] ) );
$output = '';
$路徑    = 詩集文件夾 . $頁碼 . 程式後綴;

if( file_exists( $路徑 ) )
{
	require_once( $路徑 );
	
	foreach( $内容[ 行碼 ] as $碼 => $行 )
	{
		if( $碼 == '〚1〛' )
		{
			$output .= $行 . NL . NL;
		}
		elseif( $行 == '' )
		{
			continue;
		}
		else
		{
			$output .= $行 . NL;
			// 注音
			$句s = explode( '。', $行 );
			
			foreach( $句s as $句 )
			{
				if( $句 != '' )
				{
					$output .= $詩句_注音[ $句 ] . ', ';
				}
			}
			$output = mb_substr( $output, 0, -2 );
			$output .= NL;
			
			// 譯文
			// 詩組，有首碼
			$坐 = '';
			
			if( array_key_exists( $頁碼, $詩組_詩題 ) )
			{
				foreach( $内容[ 坐標_句 ] as $坐標 => $句 )
				{
					if( mb_strpos( $行, $句 )!== false )
					{
						$坐 = str_replace( '.1', '', $坐標 );
						break;
					}
				}
			}
			else
			{
				$坐 = 生成完整坐標( $碼, $頁碼 );
			}
			$output .= $韓成武、張志民《杜甫詩全譯》譯文[ $坐 ] . NL . NL;
		}
	}
}
else
{
	echo 無結果, NL;
}
echo $output, NL;
?>