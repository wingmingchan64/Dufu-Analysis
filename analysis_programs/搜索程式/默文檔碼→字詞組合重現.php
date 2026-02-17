<?php
/*
分開七次，生成七個文檔，再合并在一起。
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\默文檔碼→字詞組合重現.php
=> 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

//check_argv( $argv, 2, 提供默文檔碼 );
//$默文檔碼 = fix_doc_id( trim( $argv[ 1 ] ) );
/*
if( !in_array( $默文檔碼, $默認詩文檔碼 ) )
{
	echo 無頁碼, NL;
}
*/
/*
"0003"=>array(
	"字"=>array( $坐標, $坐標 );
);
*/

$temp1 = array();
$temp2 = array();
$temp3 = array();
$file = $list = 7;
switch( $file )
{
	case 1:
		$JSON_文檔 = $詩字_字碼;
		break;
	case 2:
		$JSON_文檔 = $二字組合_坐標;
		break;
	case 3:
		$JSON_文檔 = $三字組合_坐標;
		break;
	case 4:
		$JSON_文檔 = $四字組合_坐標;
		break;
	case 5:
		$JSON_文檔 = $五字組合_坐標;
		break;
	case 6:
		$JSON_文檔 = $六字組合_坐標;
		break;
	case 7:
		$JSON_文檔 = $七字組合_坐標;
		break;
	default:
		$JSON_文檔 = $詩字_字碼;
}
// 1: 1171 items
//foreach( $詩字_字碼 as $詩字 => $字碼s )
// 2: 237 items
//foreach( $二字組合_坐標 as $詩字 => $字碼s )
// 3: 45 items
//foreach( $三字組合_坐標 as $詩字 => $字碼s )
// 4: 20 items
//foreach( $四字組合_坐標 as $詩字 => $字碼s )
// 5: 12 items
//foreach( $五字組合_坐標 as $詩字 => $字碼s )
// 6: 6 items
//foreach( $六字組合_坐標 as $詩字 => $字碼s )
// 7: 3 items
//foreach( $七字組合_坐標 as $詩字 => $字碼s )
// 8: 0 items
//foreach( $八字組合_坐標 as $詩字 => $字碼s )
// 9: 0 items
foreach( $JSON_文檔 as $詩字 => $字碼s )
{
	if( !array_key_exists( $詩字, $temp1 ) )
	{
		$temp1[ $詩字 ] = array();
	}

	foreach( $字碼s as $字碼 )
	{
		$文檔碼 = mb_substr( $字碼, 1, 4 );
		if( !array_key_exists( $文檔碼, $temp1[ $詩字 ] ) )
		{
			$temp1[ $詩字 ][ $文檔碼 ] = 0;
		}
		$temp1[ $詩字 ][ $文檔碼 ]++;		
	}
	//if( $詩字 == "夫" )
		//break;
}

foreach( $temp1 as $詩字 => $文檔碼_頻率 )
{
	foreach( $文檔碼_頻率 as $文檔碼 => $頻率 )
	{
		if( $頻率 > 1 )
		{
			if( !array_key_exists( $詩字, $temp2 ) )
			{
				$temp2[ $詩字 ] = array();
			}
			array_push( $temp2[ $詩字 ], $文檔碼 );
		}
	}
}


foreach(  $temp2 as $詩字 => $文檔碼s )
{
	if( !array_key_exists( $詩字, $temp3 ) )
	{
		$temp3[ $詩字 ] = array();
	}
	foreach( $文檔碼s as $文檔碼 )
	{
		// 1
		//$to_look_list = $詩字_字碼[ $詩字 ];
		// 2
		//$to_look_list = $二字組合_坐標[ $詩字 ];
		// 3
		//$to_look_list = $三字組合_坐標[ $詩字 ];
		// 4
		//$to_look_list = $四字組合_坐標[ $詩字 ];
		// 5
		//$to_look_list = $五字組合_坐標[ $詩字 ];
		// 6
		//$to_look_list = $六字組合_坐標[ $詩字 ];
		// 7
		//$to_look_list = $七字組合_坐標[ $詩字 ];
		// 8
		//$to_look_list = $八字組合_坐標[ $詩字 ];
		// 9
		//$to_look_list = $九字組合_坐標[ $詩字 ];
		
switch( $list )
{
	case 1:
		$to_look_list = $詩字_字碼[ $詩字 ];
		break;
	case 2:
		$to_look_list = $二字組合_坐標[ $詩字 ];
		break;
	case 3:
		$to_look_list = $三字組合_坐標[ $詩字 ];
		break;
	case 4:
		$to_look_list = $四字組合_坐標[ $詩字 ];
		break;
	case 5:
		$to_look_list = $五字組合_坐標[ $詩字 ];
		break;
	case 6:
		$to_look_list = $六字組合_坐標[ $詩字 ];
		break;
	case 7:
		$to_look_list = $七字組合_坐標[ $詩字 ];
		break;
	default:
		$to_look_list = $詩字_字碼[ $詩字 ];
}

		foreach( $to_look_list as $item )
		{
			if( mb_strpos( $item, "〚${文檔碼}:" ) !== false )
			{
				array_push( $temp3[ $詩字 ], $item );
			}
		}
	}
}

//print_r( $temp3 );
//echo sizeof( array_keys( $temp3 ) );
//exit;

$json = json_encode(
	$temp3,
	JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默文檔碼→字詞組合重現.json",
	$json . PHP_EOL );

?>