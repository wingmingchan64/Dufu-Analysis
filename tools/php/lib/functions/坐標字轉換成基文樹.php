<?php
/*
 * 
 */
 
function 坐標字轉換成基文樹(
	array $data, bool $debug=false ) : array
{
	$result = [];

    foreach ( $data as $doc_id => $chars )
    {
        foreach ( $chars as $coord => $char )
        {
            // 去掉 〚 〛
            $coord = trim( $coord, "〚〛" );

            // 447:001:3.1.1
            $parts = explode( ':', $coord );

            // 第三段是 行.句.字
            list( $line, $sentence, $char_pos ) = 
				explode( '.', $parts[2] );

             $result[ $doc_id ][ $line ][ $sentence ][ $char_pos ] = $char;
            
        }
    }

    return $result;
}
?>