<?php
/*
php H:\github\Dufu-Analysis\tests\php\lib\test_all_functions.php
*/
require_once(
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	"php" . DIRECTORY_SEPARATOR .
	"lib" . DIRECTORY_SEPARATOR .
	"函式.php" );

// tests/php/lib/test_all_functions.php
// 用法：
// TEST_MODE=FAIL_FAST php .../test_all_functions.php
// TEST_MODE=FAIL_SLOW php .../test_all_functions.php
// TEST_LOG=1 TEST_MODE=FAIL_SLOW php .../test_all_functions.php

$tests_dir = __DIR__; // tests/php/lib/

require_once $tests_dir . DS . '_test_bootstrap.php';

$skip = require $tests_dir . DS . '_skip_tests.php';
$all  = scandir( $tests_dir );
$test_files = [];

foreach( $all as $f )
{
    if( $f === '.' || $f === '..' ) continue;
    if( !str_ends_with( $f, '_test.php' ) ) continue;
    $test_files[] = $f;
}
sort($test_files);

// 先記錄 SKIP
foreach( $test_files as $f )
{
    if( isset( $skip[ $f ] ) )
	{
        設定測試檔( $f );
        記錄case( 'SKIP', 'case#: *', $skip[ $f ] );
    }
}

$failed = false;
$mode = getenv( 'TEST_MODE' ) ?: 'FAIL_FAST';

foreach($test_files as $f) {
    if(isset($skip[$f])) continue;

    設定測試檔($f);

    try {
        // 每個測試檔自身會 require 函式.php（你現在是這樣）
        // 但如果你已在這裡 require 了 函式.php，那測試檔裡那段可慢慢拿掉（可選）
        require $tests_dir . DIRECTORY_SEPARATOR . $f;
    }
    catch( ConfirmationFailureException $e ) {
        $failed = true;
        記錄log("FAIL in {$f}: " . $e->getMessage());

        if($mode === 'FAIL_FAST') {
            // 直接中止：保持你原先“立刻停”的開發習慣
            break;
        }
        // FAIL_SLOW：繼續跑下一個測試檔
        continue;
    }
    catch( Throwable $e ) {
        $failed = true;
        // 未預期例外（ERROR）
        記錄case('ERROR', 'case#: *', 'Unhandled exception', $e);
        記錄log("ERROR in {$f}: " . get_class($e) . ' ' . $e->getMessage());

        if( $mode === 'FAIL_FAST' ) break;
        continue;
    }
}

// ===== Report =====
global $test_cases, $test_results, $test_log;

$stats = ['PASS'=>0,'FAIL'=>0,'ERROR'=>0,'SKIP'=>0];
foreach($test_cases as $c) {
    $s = $c['status'];
    if(isset($stats[$s])) $stats[$s]++;
}

echo PHP_EOL;
echo "==================== TEST REPORT ====================" . PHP_EOL;
echo "MODE: {$mode}" . PHP_EOL;
echo "PASS: {$stats['PASS']} | FAIL: {$stats['FAIL']} | ERROR: {$stats['ERROR']} | SKIP: {$stats['SKIP']}" . PHP_EOL;

if($stats['FAIL'] > 0 || $stats['ERROR'] > 0) {
    echo PHP_EOL . "---- FAIL/ERROR LIST ----" . PHP_EOL;
    foreach($test_cases as $c) {
        if($c['status'] === 'FAIL' || $c['status'] === 'ERROR') {
            $file = $c['file'];
            $case = $c['case'];
            $msg  = $c['message'];
            $ex   = $c['exception'] ? (' ['.$c['exception'].']') : '';
            echo "{$c['status']} {$file} {$case}{$ex} {$msg}" . PHP_EOL;
            if($c['detail']) {
                echo "  detail: " . $c['detail'] . PHP_EOL;
            }
        }
    }
}

if(getenv('TEST_LOG') === '1') {
    echo PHP_EOL . "---- LOG ----" . PHP_EOL;
    foreach($test_log as $line) echo $line . PHP_EOL;
}

// 可選：輸出 JSON 報告（給 CI 或你想存檔）
if(getenv('TEST_REPORT_JSON') === '1') {
    $out = [
        'mode'  => $mode,
        'stats' => $stats,
        'cases' => $test_cases,
    ];
    $report_path = $tests_dir . DIRECTORY_SEPARATOR . '_last_test_report.json';
    file_put_contents($report_path, json_encode($out, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    echo PHP_EOL . "JSON report written: {$report_path}" . PHP_EOL;
}

echo "=====================================================" . PHP_EOL;

// exit code：讓 CI 能判斷
if($stats['FAIL'] > 0 || $stats['ERROR'] > 0) exit(1);
exit(0);	
	
/*
$func_dir = __DIR__ . DS;
require_once( "skip_tests.php" );

if( ! is_dir( $func_dir ) )
{
    throw new RuntimeException( '函式目錄不存在: ' . $func_dir );
}

$files = scandir( $func_dir );
sort( $files, SORT_STRING );



echo NL, "Test Result:", NL;
echo "============", NL;

foreach( $files as $file )
{
	$path = $func_dir . $file;

	if(
		is_file( $path )
		&& preg_match( '/\_test.php$/i', $file ) 
		//&& !in_array( $file, $skip_list )
	)
	{
		echo $path, NL;
		require( $path );
	}
}
$json = json_encode( $test_results, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
echo 清理JSON括號( $json, true );
//print_r( $test_results );
*/
?>