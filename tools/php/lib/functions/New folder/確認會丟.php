<?php
/*
 * 用於測試，確認 $a === $b。
 * usage: confirm_identical( fix_doc_id( '3' ), '0003', 'case#: 4' );
 */
function 確認會丟( 
	callable $fn, // name of function that can throw exception
	string $exception_class, // name of exception
	string $msg = '' ) 
	: bool
{
	try
    {
        $fn();
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
}

function confirm_throw(
	callable $fn, // name of function that can throw exception
	string $exception_class, // name of exception
	string $msg = '' ) 
	: bool
{
	return 確認會丟( $fn, $exception_class, $msg );
}
?>