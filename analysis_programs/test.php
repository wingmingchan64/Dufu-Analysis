<?php
require_once( "h:\\github\\Dufu-Analysis\\用字_頻率.php" );
require_once( "h:\\github\\Dufu-Analysis\\用字_部首.php" );

echo sizeof( array_keys( $用字_頻率 ) ), "\n";
echo sizeof( array_keys( $用字_部首 ) ), "\n";
//var_dump( array_diff( array_keys( $用字_頻率 ), array_keys( $用字_部首 ) ) );

echo strlen( "﻿﻿" );
?>

