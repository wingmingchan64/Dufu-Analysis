<?php
declare(strict_types=1);

/**
 * JSON Loader for 杜甫資料
 * JSON-first，PHP 作為 view / CLI
 */

class JsonDataLoader
{
    private string $baseDir;
    private array $cache = [];

    public function __construct(string $baseDir)
    {
        if (!is_dir($baseDir)) {
            throw new RuntimeException("JSON 目錄不存在：$baseDir");
        }
        $this->baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR);
    }

    /**
     * 取得一個 JSON（以檔名為 key，不含 .json）
     * 例：get("詩頁碼") → 讀 詩頁碼.json
     */
    public function get(string $name): array
    {
        if (isset($this->cache[$name])) {
            return $this->cache[$name];
        }

        $path = $this->baseDir . DIRECTORY_SEPARATOR . $name . ".json";

        if (!is_file($path)) {
            throw new RuntimeException("JSON 檔不存在：$path");
        }

        $json = file_get_contents($path);
        if ($json === false) {
            throw new RuntimeException("讀取失敗：$path");
        }

        $data = json_decode($json, true);
        if (!is_array($data)) {
            $err = json_last_error_msg();
            throw new RuntimeException("JSON 解析失敗：$path；error=$err");
        }

        // 快取
        $this->cache[$name] = $data;
        return $data;
    }

    /**
     * 一次載入多個
     */
    public function loadMany(array $names): void
    {
        foreach ($names as $name) {
            $this->get($name);
        }
    }

    /**
     * 列出目前已載入的資料 key
     */
    public function loadedKeys(): array
    {
        return array_keys($this->cache);
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