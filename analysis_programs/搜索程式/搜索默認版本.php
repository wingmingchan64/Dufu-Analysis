<?php
/*
php h:\github\Dufu-Analysis\analysis_programs\搜索程式\搜索默認版本.php 
*/
require_once(
	"H:" . DIRECTORY_SEPARATOR .
	"github" . DIRECTORY_SEPARATOR .
	"Dufu-Analysis" . DIRECTORY_SEPARATOR .
	"JSON" . DIRECTORY_SEPARATOR .
	"程式" . DIRECTORY_SEPARATOR .
	"to_be_included_for_json.php" );

while( true )
{
	echo 選項指令;
	$程式名 = array_keys( 默認版本選項指令 );
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
			
			if( 默認版本選項指令[ $程式 ] != '' )
			{
				echo 默認版本選項指令[ $程式 ];
				$參數 = readline();
			}
			else
			{
				$參數 = '';
			}
			
			$executable = "php " . 搜索程式文件夾 . $程式 . 程式後綴 . ' ' . $參數;
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