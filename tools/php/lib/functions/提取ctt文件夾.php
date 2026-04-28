<?php
function get_ctt_folder( string $work_id ) : string
{
	global $ctt_registry;
	return $ctt_registry[ $work_id ][ FOLDER ];
}

function 提取ctt文件夾( string $work_id ) : string
{
	return get_ctt_folder( $work_id );
}
?>