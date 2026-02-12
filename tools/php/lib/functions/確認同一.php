<?php
/*
 * 用於測試，確認 $a === $b。
 */
function 確認同一( mixed $a, mixed $b, string $msg = '' ) : bool
{
	if( $a === $b )
    {
        return true;
    }

    throw new ConfirmationFailureException( $msg );
}
?>