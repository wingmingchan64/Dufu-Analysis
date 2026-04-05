# Formats of M-Markers 後設標記格式 （By ChatGPT）

## 1. 基本形式

metadata 以 m-marker 表示，形式如下：

文字〘{ JSON }〙

其中：

- 〘〙 用於標記 metadata
- 內容爲 JSON 結構

---

## 2. JSON 結構

最小結構：

<pre>
{
  "cat": "...",
  "op": "...",
  "scope_start": "...",
  "scope_end": "..."
}
</pre>

---

## 3. JSONL 作爲核心格式

系統的核心處理形式爲：

> JSONL（JSON Lines）

卽：

- 每一條 metadata 爲一行 JSON
- 按順序排列
- 對應 transformation sequence

---

## 4. 爲何使用 JSONL

JSONL 的優點：

### 4.1 順序卽語義

metadata 的順序：

<pre>
第1行 → op<sub>1</sub>
第2行 → op<sub>2</sub>
...
</pre>

卽爲執行順序。

### 4.2 易於串接

- 可直接 append
- 可分批生成
- 可合併多來源 metadata

### 4.3 適合 pipeline

<pre>
read line
→ parse JSON
→ apply op
→ update tree
</pre>

---

## 5. Payload 表示

用於文字的操作：

- payload 可爲：
	- 被插入到某終端節點的文字
	- 用以替換某終端節點的文字
	- 空語鏈（empty string），用以刪除某終端節點的文字

用於 subtree 的操作：

- payload 可爲：
	- 子樹引用
	- 或子樹生成參數

例如：

<pre>
{
  "cat": "注",
  "op": "insert_subtree",
  "scope_start": "...",
  "scope_end": "...",
  "payload": "0003注文"
}
</pre>

---

## 6. m-marker 與 JSONL 的關係

- m-marker：人類可讀
- JSONL：系統處理

轉換流程：

<pre>
m-marker text
    ↓ parse
JSONL metadata
    ↓ execute
tree transformation
</pre>

---

## 7. 設計原則

### 7.1 明確性

- 每條 metadata 應對應一個操作

### 7.2 簡潔性

- JSON 結構保持最小必要欄位

### 7.3 可序列化

- metadata 可線性排列
- 可重放（replay）

---

## 8. 小結

- m-marker 是 metadata 的表示形式，
- JSONL 是 metadata 的執行形式。

二者共同構成 transformation pipeline 的核心。