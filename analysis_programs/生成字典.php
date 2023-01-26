<?php
/*
//mkdir( $字文件夾 . $部首 );
*/
require_once( '常數.php' );
require_once( 杜甫資料庫 . '部首_用字.php' );
require_once( 杜甫資料庫 . '用字_詩句.php' );
require_once( 杜甫資料庫 . '詩句_坐標.php' );
require_once( 杜甫資料庫 . '陳永明《杜甫全集粵音注音》\陳永明《杜甫全集粵音注音》字音.php' );

$字文件夾 = 杜甫資料庫 . "用字\\";

$部首s = array_keys( $部首_用字 );

foreach( $部首s as $部首 )
{
	mkdir( $字文件夾 . $部首 );
}

foreach( $部首_用字 as $部首 => $用字陣列 )
{
	foreach( $用字陣列 as $用字 )
	{
		$code =
		"<?php
/*
生成：本文檔用 PHP 生成。
程式：生成字典.php
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
		$code = $code . ");\n";
		
		if( array_key_exists( $用字, $字音 ) )
		{
			$code = $code . "\$字音=array(";
			foreach( $字音[ $用字 ] as $音 )
			{
				$code = $code . "\"${音}\",";
			}
			
			$code = substr( $code, 0, -1 );
			$code = $code . ");\n";
		}
		
		$code = $code . "\n?>";
		file_put_contents(
			$字文件夾 . $部首 . "\\" . $用字 . '.php', $code );
	}
}
?>
