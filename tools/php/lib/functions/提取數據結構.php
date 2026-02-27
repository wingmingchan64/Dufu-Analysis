<?php
/*
 * 以數據結構名稱，提取該結構
 */
function 提取數據結構( string $結構, bool $debug=false ) : array
{
	static $DATA = null;
	
	if( $DATA === null )
	{
		$DATA = new JsonDataLoader( JSON_BASE_DIR );
	}
	
	return $DATA->get( $結構 );
}

function get_data_structure( string $結構, bool $debug=false ) : array
{
	return 提取數據結構( $結構, $debug );
}
?>