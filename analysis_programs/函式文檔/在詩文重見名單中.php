<?php
function 在詩文重見名單中
	( string $文檔碼, string $詩文 ) : bool
{
	$詩文重見名單 = 提取數據結構( 默認詩文檔碼_詩文重見名單 );
	return in_array( $詩文, $詩文重見名單[ $文檔碼 ] );
}
?>