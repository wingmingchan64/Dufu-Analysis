<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\杜甫詩陣列測試.php
*/
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 詩組_詩題 );
require_once( 杜甫詩陣列 );

// 0003, 0013, 0053
/*
$詩陣列 = $杜甫詩陣列[ '0003' ];
$第三行 = $詩陣列[ 3 ];
$第三行第二句 = $第三行[ 2 ];
//echo 杜甫詩陣列句ToString( $第三行第二句 ), NL;
//echo 杜甫詩陣列行ToString( $第三行, true, true, true, 3 );
echo 杜甫詩陣列首ToString( $詩陣列, true, true, true );

$詩陣列 = $杜甫詩陣列[ '0013' ][ 1 ];
echo 杜甫詩陣列首ToString( $詩陣列, true, true, true );
*/
$詩陣列 = $杜甫詩陣列[ '0062' ];
print_r( $詩陣列 );



	


/*
$頁 = '0003';
$替代陣列 = array(
'〚3.1.1〛'=>'【岱',
'〚3.1.2〛'=>'宗[泰山]',
'〚3.1.5〛'=>'何，',
'〚4.1.5〛'=>'秀，',
'〚5.1.5〛'=>'[同層]雲，',
'〚6.1.5〛'=>'頂，',
'〚6.2.5〛'=>"小!】\n\n右一" );
$頁陣列 = $杜甫詩陣列[ $頁 ];
杜甫詩陣列詩文替代( $頁陣列, $替代陣列 );
顯示杜甫詩陣列詩文( $詩組_詩題, $頁, $頁陣列 );

//顯示杜甫詩陣列詩文( $詩組_詩題, $頁, $杜甫詩陣列[ $頁 ] );

try
{
	//顯示坐標值( $杜甫詩陣列, '0003' );
}
catch( ErrorException $e )
{
	echo 無結果, NL;
}
*/

//
?>

