<?php
$code_file_vars = array(
	"詩頁碼",
	"頁碼_路徑",
);

foreach( $code_file_vars as $var )
{
	$var_name = "${var}_path";
	$$var_name = "H:\\github\\Dufu-Analysis\\JSON\\杜甫全集\\${var}.json";
	$v_name = $var;
	$$v_name = json_decode(
		file_get_contents( $$var_name ) );
}
?>

