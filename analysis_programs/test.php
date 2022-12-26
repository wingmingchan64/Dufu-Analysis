<?php
require_once( "h:\\github\\Dufu-Analysis\\用字_頻率.php" );
require_once( "h:\\github\\Dufu-Analysis\\用字_部首.php" );

echo sizeof( array_keys( $用字_頻率 ) ), "\n";
echo sizeof( array_keys( $用字_部首 ) ), "\n";
var_dump( array_diff( array_keys( $用字_頻率 ), array_keys( $用字_部首 ) ) );
?>

array(27) {
  [230]=>
  string(3) "者"
  [366]=>
  string(3) "耆"
  [367]=>
  string(3) "老"
  [535]=>
  string(3) "罷"
  [753]=>
  string(3) "置"
  [1101]=>
  string(3) "羅"
  [1171]=>
  string(3) "羆"
  [1247]=>
  string(3) "罰"
  [1625]=>
  string(3) "羈"
  [1778]=>
  string(3) "䍦"
  [2119]=>
  string(3) "署"
  [2211]=>
  string(3) "罵"
  [2436]=>
  string(3) "罕"
  [2474]=>
  string(3) "慨"
  [2559]=>
  string(3) "罘"
  [2560]=>
  string(3) "罳"
  [2622]=>
  string(3) "罹"
  [2814]=>
  string(3) "罪"
  [3049]=>
  string(3) "罝"
  [3059]=>
  string(3) "罟"
  [3130]=>
  string(3) "﻿"
  [3438]=>
  string(3) "罥"
  [3484]=>
  string(3) "郎"
  [3747]=>
  string(3) "考"
  [3876]=>
  string(3) "羇"
  [3915]=>
  string(3) "罽"
  [4179]=>
  string(3) "罾"
}