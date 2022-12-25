<?php

$outfile = 'h:\github\Dufu-Analysis\display.txt';
$collection_path = "h:\\github\\Dufu-Analysis\\詩集\\";

/*
test 1: given a page number, retrieve the title of a poem 
result:
s:12:"送李卿曄";
*/
/*
require_once( '頁碼_詩題.php' );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $頁碼_詩題[ '3025' ] ) );
fclose( $fp );
*/

/* 
test 2: given a page number, retrieve the poem on that page
result:
s:144:"王子思歸日。長安已亂兵。霑衣問行在。走馬向承明。暮景巴蜀僻。春風江漢清。晉山雖自棄。魏闕尚含情。";
*/
/*
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

require_once( '詩題_頁碼.php' );
require_once(
$collection_path . "${詩題_頁碼[ '過宋員外之問舊莊' ]}.php" );
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
*/

/* 
test 6: given a two-character phrase, retrieve poems containing the phrase
result:
s:2724:"白沙渡
畏途隨長江。渡口下絕岸。差池上舟楫。杳窕入雲漢。天寒荒野外。日暮中流半。我馬向北嘶。山猿飲相喚。水清石礧礧。沙白灘漫漫。迥然洗愁辛。多病一疏散。高壁抵嶔崟。洪濤越凌亂。臨風獨回首。攬轡復三歎。

梅雨
南京西浦道。四月熟黃梅。湛湛長江去。冥冥細雨來。茅茨疏易濕。雲霧密難開。竟日蛟龍喜。盤渦與岸迴。

越王樓歌
綿州州府何磊落。顯慶年中越王作。孤城西北起高樓。碧瓦朱甍照城郭。樓下長江百丈清。山頭落日半輪明。君王舊跡今人賞。轉見千秋萬古情。

雨二首
青山澹無姿。白露誰能數。片片水上雲。蕭蕭沙中雨。殊俗狀巢居。曾臺俯風渚。佳客適萬里。沉思情延佇。挂帆遠色外。驚浪滿吳楚。久陰蛟螭出。寇盜復幾許。空山中宵陰。微冷先枕席。迴風起清曙。萬象萋已碧。落落出岫雲。渾渾倚天石。日假何道行。雨含長江白。連檣荆州船。有士荷矛戟。南防草鎮慘。霑濕赴遠役。羣盜下辟山。揔戎備強敵。水深雲光廓。鳴櫓各有適。漁艇自悠悠。夷歌負樵客。留滯一老翁。書時記朝夕。

王兵馬使二角鷹
悲臺蕭颯石巃嵸。哀壑杈枒浩呼洶。中有萬里之長江。迴風滔日孤光動。角鷹翻倒壯士臂。將軍玉帳軒翠氣。二鷹猛腦徐侯墜。目如愁胡視天地。杉雞竹兔不自惜。溪虎野羊俱辟易。鞲上鋒稜十二翮。將軍勇銳與之敵。將軍樹勳起安西。崑崙虞泉入馬蹄。白羽曾肉三狻猊。敢決豈不與之齊。荊南芮公得將軍。亦如角鷹下翔雲。惡鳥飛飛啄金屋。安得爾輩開其羣。驅出六合梟鸞分。

登高
風急天高猿嘯哀。渚清沙白鳥飛迴。無邊落木蕭蕭下。不盡長江滾滾來。萬里悲秋常作客。百年多病獨登臺。艱難苦恨繁霜鬢。潦倒新停濁酒杯。

送高司直尋封閬州
丹雀銜書來。暮棲何鄕樹。驊騮事天子。辛苦在道路。司直非冗官。荒山甚無趣。借問泛舟人。胡爲入雲霧。與子姻婭間。既親亦有故。萬里長江邊。邂逅一相遇。長卿消渴再。公幹沉綿屢。清談慰老夫。開卷得佳句。時見文章士。欣然淡情素。伏枕聞別離。疇能忍漂寓。良會苦短促。溪行水奔注。熊羆咆空林。遊子慎馳騖。西謁巴中侯。艱險如跬步。主人不世才。先帝常特顧。拔爲天軍佐。崇大王法度。淮海生清風。南翁尚思慕。公宮造廣廈。木石乃無數。初聞伐松柏。猶卧天一柱。我病書不成。成字讀亦誤。爲我問故人。勞心鍊征戍。

";


$search = '長江';
require_once( 'line.php' );
require_once( 'line_page.php' );
$page = array();

foreach( $line as $l )
{
	if( mb_strpos( $l, $search ) !== false )
	{
		if( !in_array( $line_page[ $l ], $page ) )
		{
			array_push( $page, $line_page[ $l ] );
		}	
	}
}

$text = "";
foreach( $page as $p )
{
	require_once( $collection_path . "${p}.php" );
	$title = $content[ '詩題' ];
	$poem  = $content[ '詩文' ];
	$text = $text . $title . "\n" . $poem . "\n\n";
}
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $text ) );
fclose( $fp );
*/

require_once( 'normalized.php' );
echo mb_strlen( trim ( implode( explode( '。', $text ) ) ) );	

?>