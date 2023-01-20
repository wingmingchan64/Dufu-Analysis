<?php
require_once( '常數.php' );
require_once( '函式.php' );
require_once( 'h:\github\Dufu-Analysis\頁碼.php' );
require_once( 'h:\github\Dufu-Analysis\書目簡稱.php' );

$簡稱   = '=譯';
$簡稱   = '=今';

$文件夾 = $書目簡稱[ $簡稱 ];
$詞條s = array();

require_once( "h:\\github\\Dufu-Analysis\\" .
	$書目簡稱[ $簡稱 ] . "\\" .
	$書目簡稱[ $簡稱 ] . "注釋.php" );
$out_path = "h:\\github\\Dufu-Analysis\\${文件夾}\\";

$code = "<?php\n\$${書目簡稱[ $簡稱 ]}字典注釋=array(\n";

$var_name = $書目簡稱[ $簡稱 ] . "注釋";
//echo $var_name;

foreach( $$var_name as $坐標 => $詞條 )
{
	$strpos = mb_strpos( $詞條, '：' );
	
	if( $strpos !== false )
	{
		$詞 = mb_substr( $詞條, 0, $strpos );
		$條 = mb_substr( $詞條, $strpos + 1 );
		
		if( !array_key_exists( $詞, $詞條s ) )
		{
			$詞條s[ $詞 ] = array( $條 );
		}
		else
		{
			array_push( $詞條s[ $詞 ], $條 );
		}
	}
}
ksort( $詞條s );
print_r( $詞條s );

$code = $code . ");\n?>";
//file_put_contents( $out_path . "${書目簡稱[ $簡稱 ]}字典注釋.php", $code );


?>