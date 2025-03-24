<?php
/*
php H:\github\Dufu-Analysis\test\testMergeArray.php
*/
require_once( "H:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
require_once( 杜甫詩陣列 );

$詩陣列 = $杜甫詩陣列[ '0013' ];
$仇兆鰲《杜詩詳註》注釋=array(
"〚0013:1:5.1.1-2〛"=>"春山：庾信詩：春山百鳥啼。",
"〚0013:1:5.1.3-4〛"=>"無伴：劉琨詩：獨生無伴。",
"〚0013:1:5.1.6-7〛"=>"相求：《易》：同氣相求。",
"〚0013:1:5.2.5-7〛"=>"山更幽：王籍詩：鳥鳴山更幽。",
);
foreach( $仇兆鰲《杜詩詳註》注釋 as $坐標 => $注釋 )
{
	insertText( $詩陣列, $坐標, $注釋 );
}
echo getMergedText( $詩陣列 ), NL;
?>