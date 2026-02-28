<?php
$test_results = [];     // 每個測試檔可 push summary 或 case 記錄
$test_cases   = [];     // (建議) 每個 case 一筆，便於統計
$test_log     = [];     // (可選) 文字 log（你說想加的 log）
$test_context = [
    'current_test_file' => null,
    'mode'              => getenv( 'TEST_MODE' ) ?: 'FAIL_FAST', // FAIL_FAST | FAIL_SLOW
    'log_enabled'       => ( getenv( 'TEST_LOG' ) === '1' ),
];

// 讓測試檔可以設定目前檔名（不用自動猜也行）
function 設定測試檔( string $file_basename ) : void
{
    global $test_context;
    $test_context[ 'current_test_file' ] = $file_basename;
}

function 記錄log( string $msg ) : void
{
    global $test_context, $test_log;
    if( !$test_context[ 'log_enabled' ] ) return;
    $test_log[] = $msg;
}

// 統一記錄一個 case 的結果
function 記錄case(
    string $status,         // PASS | FAIL | ERROR | SKIP
    string $case_id,        // 'case#: 2' 之類
    string $message = '',
    ?Throwable $e = null
) : void
{
    global $test_cases, $test_context;

    $test_cases[] = [
        'time'      => date('c'),
        'file'      => $test_context[ 'current_test_file' ] ?? '(unknown)',
        'case'      => $case_id,
        'status'    => $status,
        'message'   => $message,
        'exception' => $e ? get_class($e) : null,
        'detail'    => $e ? $e->getMessage() : null,
    ];
}

// 核心：確認爲眞
function 確認爲眞( 
	$condition, 
	string $case_id = '', 
	string $message = '' ) : bool
{
    global $test_context;

    try {
        if( $condition )
		{
            記錄case('PASS', $case_id, $message);
            return true;
        }

        $e = new ConfirmationFailureException( $message ?: 'Assertion failed.');
        記錄case( 'FAIL', $case_id, $message, $e );

        // FAIL_FAST：直接丟，runner 會停（或由 runner catch 後決定是否繼續）
        // FAIL_SLOW：仍然丟，交給外層包 catch 再繼續（這樣不改你現有測試檔的寫法也行）
        throw $e;
    }
    catch( ConfirmationFailureException $e )
	{
        // 這裡再丟出去，讓 runner 決策
        throw $e;
    }
}

function confirm_true( 
	$condition, 
	string $case_id = '', 
	string $message = '' ) : bool
{
	return 確認爲眞( $condition, $case_id = '', $message = '' );
}


// 核心：確認相等（如你已有可忽略）
function 確認相等( 
	$expected, 
	$actual, 
	string $case_id = '', 
	string $message = '' ) : bool
{
    $ok = ($expected === $actual);
    $msg = $message;
	
    if( !$ok && $msg === '' ) {
        $msg = 'Not equal. expected=' . var_export($expected, true) . ' actual=' . var_export($actual, true);
    }
	
    return 確認爲眞( $ok, $case_id, $msg );
}

function confirm_identical( 
	$expected, 
	$actual, 
	string $case_id = '', 
	string $message = '' ) : bool
{
	return 確認相等( $expected, $actual, $case_id, $message );
}

// 核心：確認會丟（你現有版本可保留，只要把記錄case 加進去）
function 確認會丟(
    callable $fn,
    string $expected_exception_class,
    string $case_id = '',
    string $message = '',
	bool $debug=false
) : bool
{
    try
	{
        $fn();
    }
    catch( Throwable $e )
	{
        if( $e instanceof $expected_exception_class )
		{
            記錄case( 
				'PASS', 
				$case_id, 
				$message ?: ( 'Caught expected ' . $expected_exception_class ) );
            return true;
		}

		if( $debug )
		{
			debug_echo( __FILE__, __LINE__, $expected_exception_class );
		}

        // 丟了但類型不對
        $msg = $message ?: (
			'Expected ' . 	
			$expected_exception_class . ', got ' . 
			get_class( $e ) );
        $fail = new ConfirmationFailureException( $msg );
        記錄case( 'FAIL', $case_id, $msg, $e );
        throw $fail;
    }

    // 沒丟
    $msg = $message ?: ( 'Expected exception ' . 
		$expected_exception_class . ' but none thrown.' );
    $fail = new ConfirmationFailureException( $msg );
    記錄case( 'FAIL', $case_id, $msg, $fail );
    throw $fail;
}

function confirm_throw(
    callable $fn,
    string $expected_exception_class,
    string $case_id = '',
    string $message = '',
	bool $debug=false
) : bool
{
	return 確認會丟( $fn, $expected_exception_class, $case_id, $message, $debug );
}
?>