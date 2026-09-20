<?php
/*
 * 去掉 $文檔內容 中所有不相關的空位、符號、[注]
 */
function 生成文字塊( string $文檔內容 ) : string
{
	$文檔內容 = preg_replace( '/\d{4}/', '',
				preg_replace( 夾注regex, '',
				$文檔內容 ) );
	$文檔內容 = 規範化( $文檔內容, true, true, true );
	return $文檔內容;
};

function create_char_block( string $文檔內容 ) : string
{
	return 生成文字塊( $文檔內容 );
}
?>