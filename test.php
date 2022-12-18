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
$line = $line_page[ '忍能對面爲盜賊' ];
require_once( $collection_path . "${line}.php" );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $content[ "詩文" ] ) );
fclose( $fp );
*/

/* 
test 4: given a title, retrieve 原注 coming with the title
result:
s:51:"員外季弟執金吾，見知於代，故有下句";
*/
require_once( 'title_page.php' );
require_once(
$collection_path . "${title_page[ '過宋員外之問舊莊' ]}.php" );
$fp = fopen( $outfile, 'w' );
fwrite( $fp, serialize( $content[ "題注" ] ) );
fclose( $fp );

?>