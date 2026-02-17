<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\搜索程式\run_program.php 頁碼→詩題

This program runs another program continuously with the same 
programmatic (non-user) parameter(s), like 仇 above. 
The execution of the program can have its own runtime parameters.
*/
require_once( 'H:\github\Dufu-Analysis\analysis_programs\函式.php' );

check_argv( $argv, 2, 輸入程式名稱 );
// store program name
$程式 = trim( $argv[ 1 ] );
$additional = '';

// additional params passed in
if( strpos( $程式, ' ' ) !== false )
{
	$parts = explode( ' ', $程式 );
	$程式 = trim( $parts[ 0 ] );
	$additional = trim( $parts[ 1 ] );
}
$程式 = str_replace( '.php', '', $程式 );
$程式路徑 = "H:\\github\\Dufu-Analysis\\analysis_programs\\搜索程式\\${程式}.php";

if( !file_exists( $程式路徑 ) )
{
	echo "此程式不存在。" . NL;
	exit;
}

while( true )
{
	// execute the program
	// most programs require parameters
	// strings with spaces must be in quotes
	echo "請輸入參數:", NL;
	$參數 = readline(); //  …冊
	
	if( $參數 == 'exit' )
	{
		echo "Bye!", NL;
		exit;
	}
	//echo mb_strlen( $參數 ) . NL;
	
	if( $additional != '' )
	{
		$executable = "php $程式路徑 $additional \"${參數}\"";
	}
	else
	{
		$executable = "php " . $程式路徑 . ' "' . $參數 . '"';
	}
	$output = null;
	$retval = null;
	echo NL;

	exec( $executable, $output, $retval );
	printOutput( $output );
}
?>