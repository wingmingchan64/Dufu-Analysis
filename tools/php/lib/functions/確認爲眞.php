<?php
/*
 * 用於測試，確認 $a === $b。
 * usage: 確認爲眞( 是合法詩文( '鬼神' ), 'case#: 1' );
 */
function 確認爲眞( bool $cond, string $msg = '' ) : bool
{
	if( $cond )
    {
        return true;
    }

    throw new ConfirmationFailureException( $msg );
}

function confirm_true( bool $cond, string $msg = '' ) : bool
{
	return 確認爲眞( $cond, $msg );
}
?>