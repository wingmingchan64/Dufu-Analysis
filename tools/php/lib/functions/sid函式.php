<?php
/*
 * 生成 SID 的函式，ChatGPT 提供。
 */
function normalize_text_for_sid( string $s ): string
{
    // 統一換行
    $s = str_replace( ["\r\n", "\r"], "\n", $s );

    // 去掉 BOM 等不常見空白
    $s = preg_replace('/\x{FEFF}/u', '', $s);

    // 壓縮所有空白（含全形空格）成單一空格；保留換行的話可先把換行暫時替換
    $s = str_replace( "\n", " ⏎ ", $s );
    $s = preg_replace( '/[ \t\x{3000}]+/u', ' ', $s );
    $s = preg_replace( '/\s+/u', ' ', $s );
    $s = trim( $s );
    $s = str_replace( " ⏎ ", "\n", $s );

    return $s;
}

function short_hash( string $s, int $hexLen = 12 ): string
{
    // sha1 足夠；你也可用 hash('sha256', ...)
    $h = sha1( $s );
    return substr( $h, 0, $hexLen );
}

function canonical_payload(
	string $cat, ?string $span, string $text ): string {
    $span = $span ?? '';
    $norm = normalize_text($text);
    return $cat . "|" . $span . "|" . $norm;
}

function make_ids(
	string $workId, 
	string $anchor, 
	string $cat, 
	?string $span, 
	string $text): array 
{
    $aid = $workId . "@" . $anchor;

    $payload = canonical_payload($cat, $span, $text);

    $h_payload = sha1($payload);
    $h_text = sha1(normalize_text($text));

    // rid 用 payload hash 的前 12 碼即可
    $rid = $aid . "#" . substr($h_payload, 0, 12);

    return [
        "aid" => $aid,
        "rid" => $rid,
        "content_hash" => [
            "text" => $h_text,
            "payload" => $h_payload
        ]
    ];
}

/**
 * 生成 sid
 * @param string $workId 例如 "郭0001"
 * @param string $cat    例如 "注"
 * @param string $text   條目正文
 * @param string|null $anchor 例如 "L0123" 或 "O00012345"
 * @param string|null $span   例如 "0062:1:5-6"
 */
function make_sid(
	string $workId, 
	string $cat, 
	string $text, 
	?string $anchor = null, 
	?string $span = null ): array
{
    $norm = normalize_text_for_sid( $text );

    if ( $anchor !== null && $anchor !== '' )
	{
        $fp = $cat . "|" . $norm;
        $sid = $workId . ":" . $anchor . ":" . 
			short_hash( $fp, 12 );
        return [ "sid" => $sid, "sid_method" => "A" ];
    }

    if ( $span !== null && $span !== '' )
	{
        $fp = $span . "|" . $cat . "|" . $norm;
        $sid = $workId . ":" . $span . ":" . 
			short_hash( $fp, 12 );
        return [ "sid" => $sid, "sid_method" => "B" ];
    }

    $fp = $cat . "|" . $norm;
    $sid = $workId . ":" . short_hash( $fp, 16 );
	
    return [ "sid" => $sid, "sid_method" => "C" ];
}
?>