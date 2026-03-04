<?php
/*
 * 以測試結構名稱，提取該結構
 */
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\JsonReadException;
use Dufu\Exceptions\JsonDecodeException;

function 提取測試結構( string $結構, bool $debug=false ) : array
{
	static $TESTS = null;
	
	if( $TESTS === null )
	{
		$TESTS = new Dufu\Tools\JsonDataLoader( TESTS_BASE_DIR );
	}
	
	return $TESTS->get( $結構 );
}

function get_tests_structure( string $結構, bool $debug=false ) : array
{
	return 提取測試結構( $結構, $debug );
}
?>