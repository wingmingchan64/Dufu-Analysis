<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成頁碼_版本頁碼.php
*/
require_once( "函式.php" );
require_once( 書目簡稱 );
$counter = 0;

//$result = array();

foreach( $書目簡稱 as $簡稱 => $書目)
{
	$簡稱 = str_replace( '=', '', $簡稱 );
	$路徑 = 杜甫分析文件夾 . $書目簡稱[ '=' . $簡稱 ] . "\\${簡稱}目錄.txt";
	if( file_exists( $路徑 ) )
	{
		$file = file_get_contents( $路徑 );
		$lines = explode( NL, $file );
		$counter = 0;
$contents = "<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\生成頁碼_版本頁碼.php
*/
\$頁碼_${簡稱}頁碼=array(
";

		foreach( $lines as $line )
		{
			$counter++;
			if( $line == '' || strpos( $line, '//' ) === false )
			{
				continue;
			}
			
			$parts = explode( ' ', $line );
			if( sizeof( $parts ) < 4 )
			{
				echo $counter, NL;
				echo $簡稱, NL;
				continue;
			}
			$默認頁碼 = trim( $parts[ 2 ] );
			$版本頁碼 = trim( $parts[ 3 ] );
			/*
			if( !array_key_exists( $默認頁碼, $result ) )
			{
				$result[ $默認頁碼 ] = array();
			}
			if( !array_key_exists( $簡稱, $result[ $默認頁碼 ] ) )
			{
				$result[ $默認頁碼 ][ $簡稱 ] = $版本頁碼;
			}
			*/
			$contents .= "\"$默認頁碼\"=>\"$版本頁碼\",\r\n";
		}
$contents .= ");
?>";
file_put_contents( 杜甫分析文件夾 . 
	$書目簡稱[ '=' . $簡稱 ] . "\\頁碼_${簡稱}頁碼.php", $contents );
	}
}


?>