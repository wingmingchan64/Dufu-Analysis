<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以頁碼提取詩文注音.php 0003
=> 詩文注音：
望嶽
岱宗夫如何？齊魯青未了。
doi6 zung1 fu4 jyu4 ho4, cai4 lou5 cing1 mei6 liu5
-----------------------------------------------------
造化鍾神秀，陰陽割昏曉。
zou6 faa3 zung1 san4 sau3, jam1 joeng4 got3 fan1 hiu2
-----------------------------------------------------
盪胸生曾雲，決眥入歸鳥。
dong6 hung1 sang1 cang4 wan4, kyut3 zi6 jap6 gwai1 niu5
-----------------------------------------------------
會當凌絕頂，一覽眾山小。
wui6 dong1 ling4 zyut6 ding2, jat1 laam5 zung3 saan1 siu2
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

if( sizeof( $argv ) != 2 )
{
	echo "必須提供頁碼。", "\n";
	exit;
}

$頁碼 = trim( $argv[ 1 ] );

$path = 杜甫全集粵音注音文件夾 . $頁碼 . 程式後綴;

if( file_exists( $path ) )
{
	require_once( $path );
	echo 詩文注音, "：\n", $粵内容[ 詩文注音 ], "\n";
}
else
{
	echo "沒有結果。\n";
}
?>