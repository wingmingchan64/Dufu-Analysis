<?php
/*
 * 用於測試，確認 $a === $b。
 */
function 確認爲眞( bool $cond, string $msg = '' ) : bool
{
	if( $cond )
    {
        return true;
    }

    throw new ConfirmationFailureException( $msg );
}
?>