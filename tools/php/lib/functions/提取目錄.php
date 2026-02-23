<?php
/*
 * 以數據結構名稱，提取該結構
 */
function 提取目錄( string $目錄 ) : array
{
	static $CATALOG = null;
	
	if( $CATALOG === null )
	{
		$CATALOG = new JsonDataLoader( PACKAGES_JSON_DIR );
	}
	
	return $CATALOG->get( $目錄 );
}

/*
function 提取後設資料( string $路徑 ) : array
{
	return 提取目錄( $路徑 );
}
*/
?>