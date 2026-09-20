<?php
function 生成JSON文檔(
	array $結構,
	string $path,
	bool $unicode = true,
	bool $pretty = true
) : void
{
	$json = json_encode( $結構, 
		JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
	file_put_contents( $path, $json . PHP_EOL );
}

function create_json_doc(
	array $結構,
	string $path,
	bool $unicode = true,
	bool $pretty = true
)
{
	生成JSON文檔( $結構, $path, $unicode, $pretty );
}
?>