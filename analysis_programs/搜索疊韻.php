<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索疊韻.php
*/
require_once( "函式.php" );
require_once( 'H:\杜甫資料庫\二字組合.php' );
require_once( 'H:\杜甫資料庫\平水韻\字_韻部.php' );

$組合s = array_keys( $二字組合 );
$result = array();

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
		$result[ $組合 ] = $同;
	}
}
$contents = "<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索疊韻.php
*/
\$疊韻=array(
";
foreach( $result as $組合 => $同陣列 )
{
	$line = "\"$組合\"=>\"" . implode( ',', $同陣列 ) . "\",\r\n";
	$contents .= $line;
}
$contents .= ");
?>";
file_put_contents( 'H:\杜甫資料庫\平水韻\疊韻.php', $contents );
?>