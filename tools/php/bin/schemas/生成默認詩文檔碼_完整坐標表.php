<?php
/*
php H:\github\Dufu-Analysis\JSON\程式\生成默認詩文檔碼_完整坐標表.php
*/
ini_set('memory_limit', '2048M'); 
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );
$默認詩文檔碼_文檔坐標 = array();
$默認詩文檔碼_首碼坐標 = array();
$默認詩文檔碼_行碼坐標 = array();
$默認詩文檔碼_句碼坐標 = array();
$默認詩文檔碼_字碼坐標 = array();
$默認詩文檔碼_完整坐標表 = array();

foreach( $默認詩文檔碼 as $文檔碼 )
{
	// 文檔
	$文檔板塊 = "〚${文檔碼}:〛";
	$默認詩文檔碼_文檔坐標[ $文檔碼 ] = array();
	$默認詩文檔碼_行碼坐標[ $文檔碼 ] = array();

	array_push( $默認詩文檔碼_文檔坐標[ $文檔碼 ], $文檔板塊 );
	
	$是組詩 = array_key_exists( $文檔碼, $行碼_副題 );

	// 首碼
	if( $是組詩 )
	{
		if( !array_key_exists( $文檔碼,$默認詩文檔碼_首碼坐標 ) )
		{
			$默認詩文檔碼_首碼坐標[ $文檔碼 ] = array();
		}
		$首碼s = $組詩_副題[ $文檔碼 ][ 1 ];
		$size = sizeof( $首碼s );
		
		for( $i = 1; $i<= $size; $i++ )
		{
			$首碼板塊 = "〚${文檔碼}:${i}:〛";
			array_push( 
				$默認詩文檔碼_首碼坐標[ $文檔碼 ], $首碼板塊 );
		}
	}

	// 行碼、範圍
	// 詩題
	array_push( $默認詩文檔碼_行碼坐標[ $文檔碼 ], 
		"〚${文檔碼}:1〛" );
		
	// 副題
	if( array_key_exists( $文檔碼, $行碼_副題 ) )
	{
		$默認詩文檔碼_行碼坐標[ $文檔碼 ] =
			array_merge( 
				array_keys( $行碼_副題[ $文檔碼 ] ),
				$默認詩文檔碼_行碼坐標[ $文檔碼 ] );
	}
	// 序文
	if( array_key_exists( $文檔碼, $默認詩文檔碼_序文 ) )
	{
		array_push( $默認詩文檔碼_行碼坐標[ $文檔碼 ], "〚${文檔碼}:3〛" );
	}
	// 詩文
	$碼_文 = $行碼_詩文[ $文檔碼 ];
	$默認詩文檔碼_行碼坐標[ $文檔碼 ] =
		array_merge( $默認詩文檔碼_行碼坐標[ $文檔碼 ],
		array_keys( $碼_文 ) );
	
	if( $是組詩 )
	{
		$temp = array();
		$prev首碼 = '';
		$curr首碼 = '';
		$prev行碼 = '';
		$curr行碼 = '';
		
		foreach( array_keys( $行碼_詩文[ $文檔碼 ] ) as $碼 )
		{
			$curr首碼 = 提取首碼( $碼 );
			$curr行碼 = 提取行碼( $碼 );
			//echo "", NL;
			//echo "", NL;
			//echo "", NL;
			
			if( !array_key_exists( $curr首碼, $temp ) )
			{
				$temp[ $curr首碼 ] = array( 
					intval( $curr行碼 ) );
				
				if( $prev首碼 == '' )
				{
					$prev首碼 = $curr首碼;
				}
				if( $prev行碼 == '' )
				{
					$prev行碼 = $curr行碼;
				}
			}
			//echo "$prev首碼:$prev行碼; $curr首碼:$curr行碼", NL;
			
			// a change in 首碼
			if( $prev首碼 != $curr首碼 )
			{
				array_push(
					$temp[ $prev首碼 ], $prev行碼 );
				$prev首碼 = $curr首碼;
				$prev行碼 = $curr行碼;
			}
			else
			{
				$prev行碼 = $curr行碼;
			}
		}
		
		array_push(
			$temp[ $curr首碼 ], $curr行碼 );

		foreach( $temp as $首 => $min_max )
		{
			$min = $min_max[ 0 ];
			$max = $min_max[ 1 ];
			$範圍 = range( $min, $max );
			
			for( $i=$min; $i<$max; $i++ )
			{
				for( $j=$i+1; $j<=$max; $j++ )
				{
					$坐標板塊 = 
					"〚${文檔碼}:${首}:${i}-${j}〛";
					;
					array_push(
						$默認詩文檔碼_行碼坐標[ $文檔碼 ],
						$坐標板塊 );
				}
			}
		}
	}
	// 句碼
	if( !array_key_exists(
		$文檔碼, $默認詩文檔碼_句碼坐標 ) )
	{
		$默認詩文檔碼_句碼坐標[ $文檔碼 ] = array();
	}
	$句_詩 = $句碼_詩句[ $文檔碼 ];
	
	foreach( $句_詩 as $碼 => $句 )
	{
		//echo $碼
		array_push(
			$默認詩文檔碼_句碼坐標[ $文檔碼 ], $碼 );
	}
	// 字碼
	$默認詩文檔碼_字碼坐標[ $文檔碼 ] = array();
}

// 一字
foreach( $默認詩文檔碼 as $文檔碼 )
{
	$默認詩文檔碼_字碼坐標[ $文檔碼 ] = 
		array_keys( $文檔碼_碼_字[ $文檔碼 ] );
}
// 二字
foreach( $二字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 三字
foreach( $三字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 四字
foreach( $四字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 五字
foreach( $五字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 六字
foreach( $六字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 七字
foreach( $七字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 八字
foreach( $八字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 九字
foreach( $九字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 十字
foreach( $十字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}
// 十一字
foreach( $十一字組合_坐標 as $字組 => $坐標s )
{
	foreach( $坐標s as $坐標 )
	{
		$文檔碼 = 提取頁碼( $坐標 );
		
		array_push( 
			$默認詩文檔碼_字碼坐標[ $文檔碼 ],
			$坐標 );
	}
}

//print_r( $默認詩文檔碼_字碼坐標 );

foreach( $默認詩文檔碼 as $文檔碼 )
{
	$默認詩文檔碼_完整坐標表[ $文檔碼 ] = array();
}
foreach( $默認詩文檔碼 as $文檔碼 )
{
	$默認詩文檔碼_完整坐標表[ $文檔碼 ] = array_merge(
		$默認詩文檔碼_文檔坐標[ $文檔碼 ],
		$默認詩文檔碼_行碼坐標[ $文檔碼 ],
		$默認詩文檔碼_句碼坐標[ $文檔碼 ],
		$默認詩文檔碼_字碼坐標[ $文檔碼 ]
	);
}

foreach( $默認詩文檔碼_首碼坐標 as $文檔碼 => $首碼s )
{
	$默認詩文檔碼_完整坐標表[ $文檔碼 ] = array_merge(
		$默認詩文檔碼_完整坐標表[ $文檔碼 ],
		$默認詩文檔碼_首碼坐標[ $文檔碼 ] );
}	


$json = json_encode(
    $默認詩文檔碼_字碼坐標,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_字碼坐標.json",
	$json . PHP_EOL );

$json = json_encode(
    $默認詩文檔碼_完整坐標表,
    JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
);

file_put_contents(
	$JSON_BASE . DIRECTORY_SEPARATOR .
	"默認詩文檔碼_完整坐標表.json",
	$json . PHP_EOL );





?>
