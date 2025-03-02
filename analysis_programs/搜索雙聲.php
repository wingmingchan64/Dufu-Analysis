<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索雙聲.php
*/
require_once( "函式.php" );
require_once( 'H:\杜甫資料庫\二字組合.php' );
require_once( 'h:\杜甫資料庫\二字組合_坐標.php' );
require_once( 'H:\杜甫資料庫\廣韻\字_聲母.php' );

$組合s = array_keys( $二字組合 );
$result = array();
$result2 = array();

foreach( $組合s as $組合 )
{
	$一 = mb_substr( $組合, 0, 1 );
	$二 = mb_substr( $組合, 1, 1 );
	if( $一 == $二 ){ continue; } // skip 疊字
	try
	{
		$一聲 = $字_聲母[ $一 ];
		$二聲 = $字_聲母[ $二 ];
		$同 = array_intersect( $一聲, $二聲 );
	}
	catch( ErrorException $e )
	{
		echo $e, NL;
		continue;
	}
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
\$雙聲_坐標=array(
";
foreach( $result as $組合 => $同坐標陣列 )
{
	$line = "\"$組合\"=>array(\"" . implode( ',', $同坐標陣列[ 0 ] ) . "\", \"" . $同坐標陣列[ 1 ] . "\")," . 
	"\r\n";
	$contents .= $line;
}
$contents .= ");
\$坐標_雙聲=array(";
foreach( $result2 as $坐標 => $組合 )
{
	$line = "\"$坐標\"=>\"$組合\"," . NL;
	$contents .= $line;
}

$contents .= ");
?>";
file_put_contents( 'H:\杜甫資料庫\廣韻\雙聲.php', $contents );


/*
$file = file_get_contents( 'H:\杜甫資料庫\廣韻\廣韻全字表.txt' );
$lines = explode( NL, $file );
$counter = 0;
$result = array();

foreach( $lines as $line )
{
	$counter++;
	$parts = explode( ',', $line );
	try
	{
		$字 = trim( $parts[ 1 ] );
		$聲母 = trim( $parts[ 6 ] );
		if( !array_key_exists( $字, $result ) )
		{
			$result[ $字 ] = array( $聲母 );
		}
		else
		{
			if( !in_array( $聲母, $result[ $字 ] ) )
			{
				array_push( $result[ $字 ], $聲母 );
			}
		}
	}
	catch( ErrorException $e )
	{
		echo $counter, NL;
	}
}
echo sizeof( array_keys( $result ) );

$contents = "<?php
\$字_聲母=array(
";
foreach( $result as $字 => $聲母s )
{
	$line = "\"$字\"=>array(";
	foreach( $聲母s as $聲母 )
	{
		$line .= "\"$聲母\",";
	}
	$line .= "),\r\n";
	$contents .= $line;
}
$contents .= ");
?>";
file_put_contents( 'H:\杜甫資料庫\廣韻\字_聲母.php', $contents );
*/
?>