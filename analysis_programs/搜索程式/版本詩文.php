<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\版本詩文.php
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );
//require_once( "h:\\github\\Dufu-Analysis\\書目簡稱.php" );
//require_once( "h:\\github\\Dufu-Analysis\\坐標_詩句.php" );

// 想要的版本
$版本 = '=蕭';
// 頁碼
$頁  = '0079';

/*
// 讀取默認版本
$詩文路徑 = 詩集文件夾 . "\\" . $頁 . '.php';
require_once( $詩文路徑 );
$版本詩文 = $内容[ "詩文" ];

// 讀取默認版本的坐標_用字
$坐標_用字路徑 = 詩集文件夾 . "\\" . $頁 . '坐標_用字.php';
require_once( $坐標_用字路徑 );

// 讀取想要版本的異文、夾注
$版本路徑 = 杜甫分析文件夾 . $書目簡稱[ $版本 ] . "\\" . $頁 . '.php';
require_once( $版本路徑 );
$版本異文、夾注 = $内容[ "異文、夾注" ];

// 以想要版本的異文、夾注，代替默認版本相對應的用字
foreach( $版本異文、夾注 as $異文、夾注坐標 => $異文、夾注 )
{
	if( $異文、夾注坐標 == "〚${頁}:1〛" )
	{
		echo $異文、夾注, "\n\n";
		continue; // skip title
	}
	
	// 換句
	$句坐標 = 
		substr( 
		$異文、夾注坐標, 0, strrpos( $異文、夾注坐標, '.' ) ) .
		'〛';
	$詩句 = $坐標_詩句[ $句坐標 ];

	// no page range
	if( strpos( $異文、夾注坐標, '-' ) === false )
	{
		$版本詩句 = str_replace(
			$坐標_用字[ $異文、夾注坐標 ],
			$異文、夾注,
			$詩句 );
		
		$版本詩文 = str_replace( 
			$詩句,    // 默認的版本
			$版本詩句, // 想要的版本
			$版本詩文 );
	}
	// with page range
	else
	{
		$chunk = '';
		$pages = getExpandedPages( $異文、夾注坐標 );
		
		foreach( $pages as $p )
		{
			$chunk = $chunk . $坐標_用字[ $p ];
		}

		$版本詩句 = str_replace(
			$chunk,
			$異文、夾注,
			$詩句 );

		$版本詩文 = str_replace( 
			$詩句,    // 默認的版本
			$版本詩句, // 想要的版本
			$版本詩文 );
	}
}
echo $版本詩文, 新行;
*/
print_r( 提取版本詩文($版本, $頁) );
?>
