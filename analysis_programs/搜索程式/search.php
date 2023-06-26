<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\search.php 
*/
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\常數.php" );
require_once( "h:\\github\\Dufu-Analysis\\analysis_programs\\函式.php" );

while( true )
{
	echo 選項指令;
	$程式名 = array_keys( 搜索程式 );
	print_r( $程式名 );
	
	$option = readline();
	
	if( $option == 'exit' )
	{
		exit;
	}
	else
	{
		$num = intval( $option );
		
		if( $num >= 0 && $num < sizeof( $程式名 ) )
		{
			$程式 = $程式名[ $num ];
			echo 搜索程式[ $程式 ];
			$參數 = readline();
			
			$executable = "php " . 搜索程式文件夾 . $程式 . 程式後綴 . ' ' . $參數;
			$output = null;
			$retval = null;
			exec( $executable, $output, $retval );
			
			printOutput( $output );
		}
		else
		{
			echo "Not a valid option. Try again.\n";
		}
	}
}
function printOutput( array $output )
{
	foreach( $output as $i => $l )
	{
		echo $l, "\n";
	}
	echo "\n";
}

?>