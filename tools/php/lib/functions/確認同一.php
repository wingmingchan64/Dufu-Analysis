<?php
/*
 * 用於測試，確認 $a === $b。 $msg 用於 exception 中。
 * usage: 確認同一( 修復文檔碼( '4' ), '0003', 'case#: 1' );
 */
function 確認同一( 
	mixed $a, 
	mixed $b, 
	string $msg = "" ) : bool
{
	if( $a === $b )
    {
        return true;
    }

    throw new ConfirmationFailureException( $msg );
}

function confirm_identical(
	mixed $a, mixed $b, string $msg = "" ) : bool
{
	return 確認同一( $a, $b, $msg );
}
?>