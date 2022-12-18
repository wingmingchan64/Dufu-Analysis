<?php

$outfile = 'h:\github\Dufu-Analysis\display.txt';
$collection_path = "h:\\github\\Dufu-Analysis\\詩集\\";

/* 
test 1: given a page number, retrieve the title of a poem 
result:
s:12:"送李卿曄";

require_once( 'page_title.php' );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $page_title[ '3025' ] ) );
fclose( $fp );
*/

/* 
test 2: given a page number, retrieve the poem on that page
result:
s:144:"王子思歸日。長安已亂兵。霑衣問行在。走馬向承明。暮景巴蜀僻。春風江漢清。晉山雖自棄。魏闕尚含情。";

require_once( $collection_path . '3025.php' );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $content[ "詩文" ] ) );
fclose( $fp );
*/

/* 
test 3: given a line, retrieve the poem containing that line
result:
s:585:"八月秋高風怒號。卷我屋上三重茅。茅飛度江洒江郊。高者挂罥長林梢。下者飄轉沉塘坳。南村羣童欺我老無力。忍能對面爲盜賊。公然抱茅入竹去。脣焦口燥呼不得。歸來倚杖自歎息。俄頃風定雲墨色。秋天漠漠向昏黑。布衾多年冷似鐵。嬌兒惡臥踏裏裂。床床屋漏無乾處。雨腳如麻未斷絕。自經喪亂少睡眠。長夜沾濕何由徹。安得廣廈千萬間。大庇天下寒士俱歡顏。風雨不動安如山。嗚呼。何時眼前突兀見此屋。吾廬獨破受凍死亦足。";

require_once( 'line_page.php' );
$p = $line_page[ '忍能對面爲盜賊' ];
require_once( $collection_path . "${p}.php" );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $content[ "詩文" ] ) );
fclose( $fp );
*/

/* 
test 4: given a title, retrieve 原注 coming with the title
result:
s:51:"員外季弟執金吾，見知於代，故有下句";

require_once( 'title_page.php' );
require_once(
$collection_path . "${title_page[ '過宋員外之問舊莊' ]}.php" );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $content[ "題注" ] ) );
fclose( $fp );
*/

/* 
test 5: given a character, retrieve all poems containing that character
result:
s:1479:"望嶽
岱宗夫如何。齊魯青未了。造化鍾神秀。陰陽割昏曉。盪胸生曾雲。決眥入歸鳥。會當凌絕頂。一覽眾山小。

登兗州城樓
東郡趨庭日。南樓縱目初。浮雲連海岱。平野入青徐。孤嶂秦碑在。荒城魯殿餘。從來多古意。臨眺獨躊躇。

洗兵馬
中興諸將收山東。捷書夕報清晝同。河廣傳聞一葦過。胡危命在破竹中。祇殘鄴城不日得。獨任朔方無限功。京師皆騎汗血馬。迴紇餧肉蒲萄宮。已喜皇威清海岱。常思仙仗過崆峒。三年笛裏關山月。萬國兵前草木風。成王功大心轉小。郭相謀深古來少。司徒清鑒懸明鏡。尚書氣與秋天杳。二三豪俊爲時出。整頓乾坤濟時了。東走無復憶鱸魚。南飛覺有安巢鳥。青春復隨冠冕入。紫禁正耐煙花繞。鶴駕通霄鳳輦備。雞鳴問寢龍樓曉。攀龍附鳳世莫當。天下盡化爲侯王。汝等豈知䝉帝力。時來不得誇身強。關中既留蕭丞相。幕下復用張子房。張公一生江海客。身長九尺鬚眉蒼。徵起適遇風雲會。扶顛始知籌策良。青袍白馬更何有。後漢今周喜再昌。寸地尺天皆入貢。奇祥異瑞爭來送。不知何國致白環。復道諸山得銀甕。隱士休歌紫芝曲。詞人解撰清河頌。田家望望惜雨乾。布穀處處催春種。淇上健兒歸莫懶。城南思婦愁多夢。安得壯士挽天河。淨洗甲兵長不用。

";
*/

require_once( 'char_line.php' );
require_once( 'line_page.php' );

$line = $char_line[ '岱' ]; // three of them
$text = "";

foreach( $line as $l )
{
	// the char can appear multiple times on a page!!!
	// check repeated page numbers
	$p = $line_page[ $l ];
	require_once( $collection_path . "${p}.php" );
	$title = $content[ '詩題' ];
	$poem  = $content[ '詩文' ];
	$text = $text . $title . "\n" . $poem . "\n\n";
}
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $text ) );
fclose( $fp );


?>