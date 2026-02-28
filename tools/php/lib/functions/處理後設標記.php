<?php
/*
 * 處理 .txt 中的〘〙標記，
 */
function 處理後設標記(
	string $簡稱, // 郭, 全
	string $版文檔碼, // 0001, 0098
	string $版本名稱 = '',
	bool $插入文字 = true,
	bool $存檔 = false
 ) : mixed
{
	$書目簡稱 = 提取數據結構( 書目簡稱 );
	
	if( !array_key_exists( $簡稱, $書目簡稱 ) )
	{
		throw new InvalidAnchorValueException( "簡稱「${簡稱}」不存在。" );
	}
	
	$書名 = $書目簡稱[ $簡稱 ];
	//$版文檔碼 = substr( $版本詩碼, 0, 4 );
	
	if( $版本名稱 != '' )
	{
		$版本名稱 .= DS;
	}
	
	$文檔路徑 =  杜甫文件夾 . PACKAGES_DIR .
		$書名 . DS . $版本名稱 . "${版文檔碼}.txt";
		
	if( !file_exists( $文檔路徑 ) )
	{
		throw new InvalidAnchorValueException( "${版文檔碼}.txt 不存在。" );
	}

	$file = trim( file_get_contents( $文檔路徑 ) );
	$lines = explode( NL, $file );
	$文檔碼_後設標記 = array();
	$版本身份 = $簡稱 . $版文檔碼; // 版本文檔ID
	$文檔碼_後設標記[ $版本身份 ] = array();
	$counter = 1;
	
	foreach( $lines as $line )
	{
		$parts = explode( '〘', $line );
		$text = '';
		
		if( $插入文字 )
		{
			$text = $parts[ 0 ];
		}
		
		$tag = rtrim( $parts[ 1 ], '〙' );
		$陣列 = 後設標記轉換成陣列( $簡稱, $版文檔碼, $counter, $tag, $text );
		array_push( $文檔碼_後設標記[ $版本身份 ], $陣列 );
		
		$counter++;
	}
	if( $存檔 )
	{
		$temp = array();
		
		foreach( $文檔碼_後設標記[ $版本身份 ] as $record )
		{
			if( !array_key_exists( $版本身份, $temp ) )
			{
				$temp[ $版本身份 ] = array();
			}
			array_push( $temp[ $版本身份 ], $record );
		}
		
		// write back to file
		$json = json_encode(
			$temp,
			JSON_UNESCAPED_UNICODE
		);
		file_put_contents(
			dirname( __DIR__, 4 ) . DS .
			PACKAGES_DIR .
			$書名 . DS .
			'metadata' . DS .
			'by_doc_id' . DS .
			$版文檔碼 . '.json', $json . PHP_EOL );
		
		return true;
	}
	else
	{
		return $文檔碼_後設標記;
	}
}

function process_metadata_markers(
	string $簡稱, // 郭, 全
	string $版本詩碼, // 0001, 0465-1
	string $版本名稱 = '',
	bool $插入文字 = true,
	bool $存檔 = false
 ) : mixed
{
	return 處理後設標記( $簡稱, $版本詩碼, $版本名稱, $插入文字, $存檔 );
}
?>