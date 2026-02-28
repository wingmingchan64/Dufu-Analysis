<?php
/*
 * 
 */
function 提取文檔碼詩文坐標(
	string $文檔碼, string $詩文, bool $debug=false ) : array
{
	$文檔碼 = 修復文檔碼( $文檔碼 );
	
	if( !是默認文檔碼( $文檔碼 ) )
	{
		throw new InvalidDocumentIDException(
			"文檔碼「${文檔碼}」不存在。"
		);
	}
		
	$坐標s = 提取詩文坐標( $詩文 );
	$result = array();
	
	foreach( $坐標s as $坐標 )
	{
		if( 提取文檔碼( $坐標 ) == $文檔碼 )
		{
			array_push( $result, $坐標 );
		}
	}
	
	return $result;
}

function get_doc_id_poem_fragent_coords(
	string $文檔碼, string $詩文, bool $debug=false ) : array
{
	return 提取文檔碼詩文坐標( $文檔碼, $詩文, $debug );
}
?>