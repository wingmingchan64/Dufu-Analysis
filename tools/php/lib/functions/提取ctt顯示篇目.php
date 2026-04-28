<?php
function get_ctt_display_title( string $work_id ) : string
{
	global $ctt_registry;
	return $ctt_registry[ $work_id ][ DISPLAY_TITLE ];
}

function 提取ctt顯示篇目( string $work_id ) : string
{
	return get_display_title( $work_id );
}
?>