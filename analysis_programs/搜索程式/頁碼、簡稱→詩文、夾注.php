<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→詩文、夾注.php 0003 仇
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\頁碼、簡稱→詩文、夾注.php 0824 名
=>
望嶽
[鶴注。公壯遊詩云忤下考功第。放蕩齊趙間。乃在開元二十四年後。當是其時作。元和郡縣志。㤗山一曰岱宗。在兗州乾封縣西北三十里。]



岱宗[虞書。東巡狩。至於岱宗。前漢郊祀志。岱宗。泰山也。鄭昻曰。王者升中告代必於此山。又是山為五嶽之長。故曰岱宗]夫如何。齊魯[史記貨殖傳。泰山之陽則魯。其陰則齊]青未了[子夜歌。寒衣尙未了]。

造化[莊子。造化之所始。陰陽之所變]鍾[左傳。天鍾美於是。鍾。聚也]神秀。陰陽割昏曉[老子。大制不割。割。分也。孫綽天台賦序。天台者。山嶽之神秀。曹輔佐對。大人達觀。任化昏曉。徐增云。山後為陰。日光不到故易昏。山前 為陽。日光先臨故易曉。朱注。封禪記。泰山東隅有日觀峰。雞鳴時見日出。長三丈。即割昏曉之義]。

盪胸生曾雲[張衡南都賦。淯水盪其胸。馬融廣成頌。動盪胸臆。公羊傳。觸石而出。膚寸而合。不崇朝而徧天下者。泰山之雲也。雲氣瀰漫飄蕩。如疊浪層波。對之心胸若揺。庾肩吾詩。層雲霾峻嶺]。決眥[曹植冬獵篇。張目决眥。决。 開也。眥。目眶也]入歸鳥[曹植詩。歸鳥赴喬林]。

會當凌絕頂[周王褒詩。絶頂日猶晴。沈約詩。絶頂復孤圓]。一覽[世說。王珣曰。若使阡陌條暢。則一覽而盡]眾山小[楊子法言。登東嶽者。然後知衆山之峛崺也]。

php h:\github\Dufu-Analysis\analysis_programs\搜索程式\以夾注形式顯示詩文、注釋.php 0003 今
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 書目簡稱 );
require_once( 頁碼 );
require_once( 頁碼_詩題 );

check_argv( $argv, 3, 提供頁、簡 );
$result = array();
$頁 = fix_doc_id( trim( $argv[ 1 ] ) );

if( !in_array( $頁, $頁碼 ) )
{
	echo 無頁碼, NL;
	exit;
}

$簡稱 = fix_text( trim( $argv[ 2 ] ) );
if( !array_key_exists( 等號 . $簡稱, $書目簡稱 ) )
{
	echo 無簡稱, NL;
	exit;
}
// 提取資料
$書名 = $書目簡稱[ 等號 . $簡稱 ];
$默認路徑 = 詩集文件夾 . $頁 . 程式後綴;
$版本路徑 = 杜甫資料庫 . $書名 . "\\" . $頁 . 程式後綴;
$陣列名 = "${簡稱}内容";
require_once( $默認路徑 );
require_once( $版本路徑 );

$詩題 = $内容[ 詩題 ];
$詩文 = str_replace( $頁, '', implode( NL.NL, array_values( $内容[ 行碼 ] ) ) );

foreach( array_values( $$陣列名[ 注釋 ] ) as $注 )
{
	// 題注
	if( mb_strpos( $注, 冒號  ) !== false )
	{
		$note = explode( 冒號, $注 );
		$term = $note[ 0 ];
		// 用〖〗來區分詩文本身與注釋中的詩文
		$詩文 = str_replace( $term, "〖${term}〗", $詩文 );
	}
}

foreach( array_values( $$陣列名[ 注釋 ] ) as $注 )
{
	// 題注
	if( mb_strpos( $注, 冒號  ) === false )
	{
		$詩文 = str_replace( $詩題, $詩題 . NL . "[" . $注 . ']', $詩文 );
	}
	// 詩文注
	else
	{
		$note = explode( 冒號, $注 );
		//print_r( $note );
		$term = $note[ 0 ];
		$exp  = $note[ 1 ];
		
		// 注釋中可能有冒號
		if( sizeof( $note ) > 2 )
		{
			for( $i = 2; $i < sizeof( $note ); $i++ )
			{
				$exp = $exp . 冒號 . $note[ $i ];
			}
		}
		// remove last 。
		if( mb_strpos( $exp, '。', -1 ) !== false )
		{
			$exp = mb_substr( $exp, 0, mb_strlen( $exp ) - 1 );
		}
		//echo $exp, NL;
		$詩文 = str_replace( "〖${term}〗", $term . "[" . $exp . ']', $詩文 );
	}
}
print_r( $詩文 );
/*
0824 名
2552, 2628 */
?>