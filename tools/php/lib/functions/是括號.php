<?php
/*
 * 檢查是否括號。
 * 
 */
function 是括號( string $str ) : bool
{
	$brackets = array(
		'<>', '[]', '()', '{}', '‹›', '«»', '⸨⸩',
		'﹙﹚', '﹝﹞', '〚〛', '（）', '【】', '〖〗', '［］',
		'〈〉', '《》', '〔〕', '〘〙', '｛｝', '｟｠', '「」', '『』'
	);
	return in_array( $str, $brackets );
}

function is_brackets( string $str ) : bool
{
	return 是括號( $str );
}
?>