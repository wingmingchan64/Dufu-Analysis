<?php
/**
php H:\github\Dufu-Analysis\docs\workflow\demo_php_program\flatten_tree.php
*/
require_once( 
	dirname( __DIR__, 3 ) . DIRECTORY_SEPARATOR .
	'tools' . DIRECTORY_SEPARATOR .
	'php' . DIRECTORY_SEPARATOR .
	'lib' . DIRECTORY_SEPARATOR .
	 '函式.php' );

$tree = json_decode(
	file_get_contents(
		dirname( __dir__, 4 ) . DIRECTORY_SEPARATOR .
		'CanonicalTextTrees' . DIRECTORY_SEPARATOR .
		'corpus' . DIRECTORY_SEPARATOR .
		'dufu' . DIRECTORY_SEPARATOR .
		'杜工部集' . DIRECTORY_SEPARATOR .
		'views' . DIRECTORY_SEPARATOR .
		'0017.json'
	), true );

$詩題 = '';
$詩文 = '';

foreach( $tree[ '0017' ] as $k => $v )
{
	if( $k == '詩題' || $k == '題注' )
	{
		$詩題 .= $tree[ '0017' ][ $k ];
	}
	
	if( is_array( $v ) ) // 行
	{
		foreach( $v as $句 )
		{
			$詩文 .= implode( $句 ) . '。';
		}
		// add new lines
		//$詩文 .= NL; 
	}
}
// if need to move 。
$詩文 = str_replace( '[', '。[', $詩文 );
$詩文 = str_replace( ']。', ']', $詩文 );

echo $詩題 . NL . NL;
echo $詩文;
?>