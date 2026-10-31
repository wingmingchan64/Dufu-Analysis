<?php
/*
 * 
 */
function 顯示文賦段落(
	array $段,
	bool $空行 = true,
	bool $debug = false ) : void
{
	添加標點符號( $段 );
	echo 攤平樹文字_略過鍵( $段 );
	echo $空行 ? NL . NL : '';
}

function 提取文賦段落(
	array $段,
	bool $空行 = true,
	bool $debug = false ) : string
{
	//添加標點符號( $段 );
	
	return 攤平樹文字_略過鍵( $段 );
}
?>