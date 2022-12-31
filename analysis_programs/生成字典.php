<?php
/*
//mkdir( $字文件夾 . $部首 );
*/
require_once( "h:\\github\\Dufu-Analysis\\部首_用字.php" );
require_once( "h:\\github\\Dufu-Analysis\\用字_詩句.php" );
require_once( "h:\\github\\Dufu-Analysis\\詩句_坐標.php" );

$字文件夾 = "h:\\github\\Dufu-Analysis\\字\\";

$部首s = array_keys( $部首_用字 );

foreach( $部首s as $部首 )
{
	//mkdir( $字文件夾 . $部首 );
}

foreach( $部首_用字 as $部首 => $用字陣列 )
{
	
	foreach( $用字陣列 as $用字 )
	{
		$code =
		"<?php
/*
生成：本文檔用 PHP 生成。
說明：關於杜詩中「${用字}」字的資料。
*/
";
		$詩句s = $用字_詩句[ $用字 ];
		$code = $code . "\"出現於\"=>array(\n";
		
		foreach( $詩句s as $詩句 )
		{
			$code = $code . "\"$詩句\"=>";
			$len  = mb_strlen( $詩句 );
			$coor = $詩句_坐標[ $詩句 ];
			$instance = mb_substr_count( $詩句, $用字 );
			$count = 0;
			$字坐標s = array();
			
			if( $instance > 1 )
			{
				$code = $code . "array(";
			}
			
			for( $i = 0; $i < $len; $i++ )
			{
				if( mb_substr( $詩句, $i, 1 ) == $用字 )
				{
					$count++;
					$字coor = trim( $coor );
					$字coor = trim( $字coor, '〚〛' );
					$字coor = $字coor . '.' . $i+1 ;
					$code = $code . 
						"\"〚" . $字coor . "〛\",\n";
					array_push( $字坐標s, $字coor );
				}
			}
			if( $instance > 1 )
			{
				$code = $code . "),\n";
			}
		}
		$code = $code . "),\n";
/*
		// process $字坐標s
		$注釋s = array();
		foreach( $字坐標s as $字坐標 )
		{
			$parts = explode( ':', trim( $字坐標 ) );
			$page = $parts[ 0 ];
			$rcoor = "";
			for( $i = 0; $i < sizeof( $parts ); $i++ )
			{
				// 頁碼
				if( $i == 0 )
					$rcoor = '〚';
				// 行碼
				elseif( i== 1 && mb_strlen( $parts[ $i ] ) > 3 )
				{
					$rcoor = $rcoor . $parts[ $i ] . '〛';
				}
				// 首碼
				elseif( i== 1 && 
					mb_strlen( $parts[ $i ] ) == 1 )
				{
					$rcoor = $rcoor . $parts[ $i ] . ':' .
						$parts[ $i+1 ] . '〛';
				}
				
			}
			require_once( "h:\\github\\Dufu-Analysis\\" . "蕭滌非主編《杜甫全集校注》\\${page}.php";
			foreach( $内容[ "注釋" ] as $note )
			{
				if(  
			}
		}
*/
		
		$code = $code . "\n?>";
		file_put_contents(
			$字文件夾 . $部首 . "\\" . $用字 . '.php', $code );
	}
}

?>
