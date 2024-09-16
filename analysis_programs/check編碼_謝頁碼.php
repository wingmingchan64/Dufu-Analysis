<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\check編碼_謝頁碼.php
*/


require_once( 'H:\github\Dufu-Analysis\謝思煒《杜甫集校注》\編碼_謝頁碼.php' );

$last = 0;

foreach( $編碼_謝頁碼 as $編碼 => $謝頁碼 )
{
	$current = intval( $謝頁碼 );
	
	if( $current >= $last )
	{
		$last = $current;
	}
	else
	{
		echo $current, "\n";
		exit;
	}
}
?>