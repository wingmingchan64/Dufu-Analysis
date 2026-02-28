<?php
/*
 * 以數據結構名稱，提取該結構
 */
function 提取目錄( string $目錄, bool $debug=false ) : array
{
	static $CATALOG = null;
	
	if( $CATALOG === null )
	{
		$CATALOG = new JsonDataLoader( PACKAGES_JSON_DIR );
	}
	
	return $CATALOG->get( $目錄 );
}

function get_catalog( string $路徑, bool $debug=false ) : array
{
	return 提取目錄( $路徑 );
}

?>