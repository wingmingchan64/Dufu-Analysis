<?php
/*
php H:\github\Dufu-Analysis\analysis_programs\搜索程式\輸入漢字.php
*/
// 兩個字庫
require_once( "四角字典.php" );
require_once( "H:\github\unicode\粵音_常用字.php" );

$out_file = 'h:\php809\code\buffer.txt';
$input    = "";
$buffer   = "";

while( true )
{
	// load: load the content of buffer.txt to memory
	// save: save the content in memory to buffer.txt
	// clr: clear the buffer in memory
	// del: remove the last unicode char from memory
	// show: show the content in memory
	// exit: terminate the program
	// key: a key in the dictionary
	echo "Enter a command (load, save, clr, del, show, exit) or a key\n";
	$input = readline();
	
	// command or key
	if( isAscii( $input ) )
	{
		if( $input == "exit" )
		{
			echo "Bye!\n";
			exit;
		}
		elseif( $input == "save" )
		{
			file_put_contents( $out_file, $buffer );
			printBuffer( $buffer );
		}
		elseif( $input == "del" )
		{
			$buffer = mb_substr( 
				$buffer, 0, mb_strlen( $buffer ) - 1 );
			printBuffer( $buffer );
		}
		elseif( $input == "load" )
		{
			$buffer = file_get_contents( $out_file );
			printBuffer( $buffer );
		}
		elseif( $input == "show" )
		{
			printBuffer( $buffer );
		}
		elseif( $input == "clr" )
		{
			$buffer = "";
			printBuffer( $buffer );
		}
		// read the value of a key
		elseif( array_key_exists( $input, $dict ) )
		{
			// more than one 漢字符 in value
			if( is_string( $dict[ $input ] ) && 
				mb_strlen( $dict[ $input ] ) > 1 )
			{
				// append entire string to buffer
				if( str_starts_with( $dict[ $input ], "*" ) )
				{
					$buffer .= trim( $dict[ $input ], "*" );
					printBuffer( $buffer );
				}
				// provide options
				else
				{
					$option_str = $dict[ $input ];
					$options = array( '' );
				
					// create option array
					for( $i=1; $i<=mb_strlen( $option_str ); $i++ )
					{
						array_push( $options, 
							mb_substr( $option_str, $i-1, 1 ) );		
					}	
					// output options
					print_r( $options );
					// wait for user option choice
					$num = intval( readline() );
				
					if( $num >= 0 && $num < sizeof( $options ) )
					{
						$buffer .= $options[ $num ];
						printBuffer( $buffer );
					}
					else
					{
						echo "Not a valid option. Try again.\n";
					}
				}
			}
			elseif( is_array( $dict[ $input ] ) )
			{
				// output options
				print_r( $dict[ $input ] );
				
				$num = intval( readline() );
				
				if( $num >= 0 && $num < sizeof( $dict[ $input ] ) )
				{
					$buffer .= $dict[ $input ][ $num ];
					printBuffer( $buffer );
				}
				else
				{
					echo "Not a valid option. Try again.\n";
				}
			}
			else
			{
				$buffer .= $dict[ $input ];
				printBuffer( $buffer );
			}
		}
		elseif(array_key_exists( $input, $粵音_常用字 ) )
		{
			print_r( $粵音_常用字[ $input ] );
			$num = intval( readline() );
				
			if( $num >= 0 && $num < sizeof( $粵音_常用字[ $input ] ) )
			{
				$buffer .= $粵音_常用字[ $input ][ $num ];
				printBuffer( $buffer );
			}
			else
			{
				echo "Not a valid option. Try again.\n";
			}
		}
		else
		{
			echo "Not a valid key. Try again.\n";
		}
	}
	else // 漢字符
	{
		$buffer .= $input;
		printBuffer( $buffer );
	}
}

function isAscii( string $str ) : bool
{
	return ( mb_detect_encoding( $str, 'ASCII' ) == 'ASCII' );
    //return mb_check_encoding( $str, 'ASCII' );
}

function printBuffer( string $buffer )
{
	// remove space
	$buffer = str_replace( ' ', '', $buffer );
	// display
	echo "=>", $buffer, "\n";
}
?>