<?php
/**
php H:\github\Dufu-Analysis\docs\workflow\demo_php_program\change_root_name.php
*/

// part 1: create a tree

// read in 基準正文 from a file
// $基準正文 = file_get_contents( $file );
$newline = "\r\n";
$基準正文 = <<<EOD
0003 望嶽

岱宗夫如何。齊魯青未了。
造化鍾神秀。陰陽割昏曉。
盪胸生曾雲。決眥入歸鳥。
會當凌絕頂。一覽眾山小。
EOD;
// split the contents
$lines = explode( $newline, trim( $基準正文 ) );
$line_num = 0;
$基準正文樹 = array();
$文檔碼 = '';

foreach( $lines as $line )
{
	$line_num++;
	
	// first line
	if( $line_num == 1 )
	{
		[ $文檔碼, $詩題 ] = 
			explode( ' ', trim( $line ) );
		 $基準正文樹[ $文檔碼 ] = array();
		 $基準正文樹[ $文檔碼 ][ '詩題' ] = $詩題;
	}
	// skip empty string
	elseif( $line === "" )
	{
		continue;
	}
	else
	{
		$line = rtrim( $line, '。' );
		$segments = explode( '。', $line );
		$segment_num = 0;
		
		foreach( $segments as $segment )
		{
			$segment_num++;
			$基準正文樹[ $文檔碼 ][ $line_num ]
				[ $segment_num ] = array();
			$len_of_segment = mb_strlen( $segment );
			//echo $len_of_segment, $newline;
			for( $i=0; $i<$len_of_segment; $i++ )
			{
				$基準正文樹[ $文檔碼 ][ $line_num ]
					[ $segment_num ][ $i+1 ] = 
						mb_substr( $segment, $i, 1 );
			}
		}
		
	}
}
print_r( $基準正文樹 );

// part 2: change the root name

$old_name = '0003';
$new_name = '0099';
$基準正文樹[ $new_name ] = $基準正文樹[ $old_name ];
unset( $基準正文樹[ $old_name ] );

print_r( $基準正文樹 );
?>