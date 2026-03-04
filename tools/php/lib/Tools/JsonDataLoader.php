<?php
declare( strict_types = 1 );
namespace Dufu\Tools;
use Dufu\Exceptions\BaseDirNotFoundException;
use Dufu\Exceptions\JsonFileNotFoundException;
use Dufu\Exceptions\JsonDecodeException;
use Dufu\Exceptions\JsonReadException;
use JsonException;
/**
 * JSON Loader for 杜甫資料
 * JSON-first，PHP 作為 view / CLI
 */
final class JsonDataLoader
{
    private string $baseDir;
	/** @var array<string, array> */
    private array $cache = [];

    public function __construct( string $baseDir )
    {
        if ( !is_dir( $baseDir ) ) 
		{
			//echo $baseDir, NL;
            throw new BaseDirNotFoundException( "JSON 目錄不存在：$baseDir" );
        }
        $this->baseDir = rtrim( $baseDir, DIRECTORY_SEPARATOR );
    }

    /**
     * 取得一個 JSON（以檔名為 key，不含 .json）
     * 例：get("詩頁碼") → 讀 詩頁碼.json
     */
    public function get( string $name ) : array
    {
        if( isset( $this->cache[ $name ] ) )
		{
            return $this->cache[ $name ];
        }

        $path = $this->baseDir . DIRECTORY_SEPARATOR . $name . ".json";

        if( !is_file( $path ) )
		{
            throw new JsonFileNotFoundException( "JSON 檔不存在： $path" );
        }

        $json = file_get_contents( $path );
		
        if( $json === false )
		{
            throw new JsonReadException( "讀取失敗： $path" );
        }

		try
		{
			$data = json_decode( 
				$json, true, 512, JSON_THROW_ON_ERROR );
		}
		catch( JsonException $e )
		{
			throw new JsonDecodeException(
				"JSON 解析失敗：$path；error=" . 
				$e->getMessage(), 0, $e);
        }
		
        if( !is_array( $data ) )
		{
            // 這通常代表 JSON 頂層不是 object/array（例如字串、數字）
            throw new JsonDecodeException( 
				"JSON 格式不符（頂層非 array/object）： $path" );
        }

        // 快取
        $this->cache[ $name ] = $data;
        return $data;
    }

    /**
     * 一次載入多個
	 * @param array<int, string> $names
     */
    public function loadMany( array $names ): void
    {
        foreach ( $names as $name )
		{
            $this->get( $name );
        }
    }

    /**
     * 列出目前已載入的資料 key
	 * @return array<int, string>
     */
    public function loadedKeys(): array
    {
        return array_keys( $this->cache );
    }

    /**
     * 清空快取（通常 CLI 不需要）
     */
    public function reset(): void
    {
        $this->cache = [];
    }
}
?>