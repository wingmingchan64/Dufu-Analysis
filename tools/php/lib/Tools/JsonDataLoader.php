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
		// 防呆：避免有人傳入 "../" 之類穿越路徑（你做工具鏈時很容易踩到）
		/*
        if ( $name === '' || 
			str_contains( $name, "\0" ) || 
			str_contains( $name, '..' ) 
			//|| 
			//str_contains( $name, '/' ) || 
			//str_contains( $name, '\\' )
			)
		{
            throw new JsonFileNotFoundException( "非法 JSON 名稱：$name" );
        }
		*/
		$this->validateName( $name );
		$relativePath = str_replace(
			'/', DIRECTORY_SEPARATOR, $name);
			
//$path = $this->baseDir . DIRECTORY_SEPARATOR . $relativePath . '.json';
		
        if( isset( $this->cache[ $relativePath ] ) )
		{
            return $this->cache[ $relativePath ];
        }

        $path = $this->pathOf( $relativePath );

        if( !is_file( $path ) )
		{
            throw new JsonFileNotFoundException( "JSON 檔不存在： $path" );
        }

        $json = file_get_contents( $path );
		
        if( $json === false )
		{
            throw new JsonReadException( "讀取失敗： ${path}" );
        }
		
		// 這行不是必需，但能更快抓出空檔/不小心寫壞的情況
        // （你做大量 house-cleaning 時很實用）
        if ( $json === '' || trim( $json ) === '' )
		{
            throw new JsonDecodeException( "JSON 內容為空：${path}" );
        }

		try
		{
			/** @var mixed $data */
			$data = json_decode(
				$json, true, 512, JSON_THROW_ON_ERROR );
		}
		catch( JsonException $e )
		{
			// 把底層 JsonException 保留下來當 previous，debug 時很好用
			throw new JsonDecodeException(
				"JSON 解析失敗： ${path}；error=" . 
				$e->getMessage(), 0, $e );
        }
		
		// 你的 loader 定義「回傳 array」，所以這裏把非 array 的 JSON（例如單一字串/數字）視為格式錯誤
        if( !is_array( $data ) )
		{
            // 這通常代表 JSON 頂層不是 object/array（例如字串、數字）
            throw new JsonDecodeException( 
				"JSON 格式不符（頂層非 array/object）： $path" );
        }

        // 快取
        $this->cache[ $relativePath ] = $data;
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
     * 預先判斷某個 JSON 是否存在（不觸發讀取）
     * CLI 可用來做「有就讀，沒有就 skip」
     */
    public function exists( string $name ) : bool
    {
        if ( $name === '' || str_contains( $name, "\0" ) || str_contains( $name, '..' ) || str_contains( $name, '/' ) || str_contains( $name, '\\' ) )
		{
            return false;
        }
        return is_file( $this->pathOf( $name ) );
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
     * 取回 cache（給調試/測試用，不建議業務邏輯依賴）
     * @return array<string, array>
     */
    public function cache(): array
    {
        return $this->cache;
    }
	
    /**
     * 清空快取（通常 CLI 不需要）
     */
    public function reset(): void
    {
        $this->cache = [];
    }
	
	/**
     * 取得 baseDir（debug / log 有用）
     */
    public function baseDir(): string
    {
        return $this->baseDir;
    }

    private function pathOf( string $name ): string
    {
        return $this->baseDir . DIRECTORY_SEPARATOR . $name . '.json';
    }
	
	private function validateName(string $name): void
	{
		if ($name === '') {
			throw new \InvalidArgumentException("JSON name 不能為空");
		}

		// 禁止 .. 防止跳出 baseDir
		if (str_contains($name, '..')) {
			throw new \InvalidArgumentException("JSON name 不允許 '..'");
		}

		// 只允許 a-z A-Z 0-9 _ - / 和中文
		// 只允許 a-z A-Z 0-9 _ - / 和中文
		if( !preg_match('/^[\p{Han}A-Za-z0-9_\-\/《》]+$/u', $name))
		{
			throw new \InvalidArgumentException("JSON name 含非法字符: $name");
		}
	}
}
?>