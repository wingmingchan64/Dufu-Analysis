<?php
/*
 * 以數據結構名稱，提取該結構
 */
function 提取數據結構( string $結構 ) : array
{
	static $DATA = null;
	
	if( $DATA === null )
	{
		$DATA = new JsonDataLoader( JSON_BASE_DIR );
	}
	
	return $DATA->get( $結構 );
}
?>