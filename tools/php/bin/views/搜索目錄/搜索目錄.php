<?php
/*
php H:\github\Dufu-Analysis\tools\php\bin\views\搜索目錄\搜索目錄.php
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR . '函式.php' );

while( true )
{
	echo 選項指令;
	$程式名 = array_keys( 搜索目錄選項 );
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
			
			if( 搜索目錄選項[ $程式 ] != '' )
			{
				echo 搜索目錄選項[ $程式 ];
				$參數 = readline();
			}
			else
			{
				$參數 = '';
			}
			
			$executable = "php " . __DIR__ . DS . $程式 . 程式後綴 . ' ' . $參數;
			$output = null;
			$retval = null;
			echo NL;

			exec( $executable, $output, $retval );
			
			printOutput( $output );
		}
		else
		{
			echo "Not a valid option. Try again.\n";
		}
	}
}
?>