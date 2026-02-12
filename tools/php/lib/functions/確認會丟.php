<?php
/*
 * 用於測試，確認 $a === $b。
 */
function 確認會丟( 
	callable $fn, // name of function that can throw exception
	string $exception_class, // name of exception
	string $msg = '',
	... $args ) 
	: bool
{
	try
    {
        $fn( $args );
    }
    catch( Throwable $e )
    {
        if( $e instanceof $exception_class )
        {
            return true;
        }

        throw new ConfirmationFailureException(
            $msg . ' (got ' . get_class( $e ) . ')'
        );
    }

    throw new ConfirmationFailureException(
		$msg . ' (no exception thrown)' );
}
?>