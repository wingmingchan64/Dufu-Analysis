<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索疊韻.php
*/
require_once( "函式.php" );
require_once( 'H:\杜甫資料庫\二字組合.php' );
require_once( 'h:\杜甫資料庫\二字組合_坐標.php' );
require_once( 'H:\杜甫資料庫\平水韻\字_韻部.php' );

$組合s = array_keys( $二字組合 );
$result = array();
$result2 = array();

foreach( $組合s as $組合 )
{
	$一 = mb_substr( $組合, 0, 1 );
	$二 = mb_substr( $組合, 1, 1 );
	if( $一 == $二 ){ continue; } // skip 疊字
	$一韻 = $字_韻部[ $一 ];
	$二韻 = $字_韻部[ $二 ];
	$同 = array_intersect( $一韻, $二韻 );
	if( sizeof( $同 ) > 0 )
	{
		$坐標s = implode( ',', $二字組合_坐標[ $組合 ] );
		$result[ $組合 ] = array( $同, $坐標s );
		foreach( $二字組合_坐標[ $組合 ] as $坐標 )
		{
			$result2[ $坐標 ] = $組合;
		}
	}
}
$contents = "<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索疊韻.php
*/
\$疊韻_坐標=array(
";
foreach( $result as $組合 => $同坐標陣列 )
{
	$line = "\"$組合\"=>array(\"" . implode( ',', $同坐標陣列[ 0 ] ) . "\", \"" . $同坐標陣列[ 1 ] . "\")," . 
	"\r\n";
	$contents .= $line;
}
$contents .= ");
\$坐標_疊韻=array(";
foreach( $result2 as $坐標 => $組合 )
{
	$line = "\"$坐標\"=>\"$組合\"," . NL;
	$contents .= $line;
}

$contents .= ");
?>";
file_put_contents( 'H:\杜甫資料庫\平水韻\疊韻.php', $contents );
?>