<?php
/*
 * 以數據結構名稱，提取該結構
 */
function 提取後設資料( string $結構, bool $debug=false ) : array
{
	static $METADATA = null;
	
	if( $METADATA === null )
	{
		$METADATA = new JsonDataLoader( PACKAGES_JSON_DIR );
	}
	
	return $METADATA->get( $結構 );
}
?>