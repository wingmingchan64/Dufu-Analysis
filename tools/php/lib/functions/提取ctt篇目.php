<?php
function get_ctt_title( string $work_id ) : string
{
	global $ctt_registry;
	return $ctt_registry[ $work_id ][ TITLE ];
}

function 提取ctt篇目( string $work_id ) : string
{
	return get_title( $work_id );
}
?>