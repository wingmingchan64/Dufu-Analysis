# Processing Pipeline 處理流程 （By ChatGPT）

## 1. 槪述

本系統以 `canonical .txt`爲唯一人工編輯來源，透過一系列可重複執行的程序，生成基準正文樹、套用後設資料，並最終生成不同版本的文本面貌。

處理流程如下：

canonical `.txt`
      ↓
canonical text tree
      ↓
metadata （cat + op + scope + payload）
      ↓
controller（順序執行操作）
      ↓
derived / edition tree
      ↓
rendered text（版本面貌）

---

## 2. 輸入資料

### 2.1 基準正文 Canonical Text 

- 格式： `.txt`
- 人工編輯
- 爲唯一來源文本
- 不包含後設資料

## 2.2 後設資料 Metadata

- 格式：嵌入於文本或獨立 `.txt`
- 結構（簡化）：

	{
	  "cat": "...",
	  "op": "...",
	  "scope_start": "...",
	  "scope_end": "...",
	  "...": "..."
	}
	
- cat：語義分類（用於統計、索引）
- op：操作種類（用於執行）

### 2.3 注文樹 Annotation Trees（可選）

- 由外部文本（如注文）生成
- 可作爲 subtree payload 使用
- 可擁有自身坐標與後設資料

---

## 3. 基準正文樹生成

canonical `.txt` 經程序轉換爲：

canonical text tree

特點：

- 層級：行 → 句 → 字
- 字爲最小單位（terminal node）
- 不包含任何版本資訊或後設資料

---

## 4. Metadata 執行模型

### 4.1 基本原則

- metadata 按其在文件中的出現順序依次執行
- 每一條 metadata 視爲一個操作指令
- 每一步操作作用於當前樹（可爲已修改的樹）

卽：
<pre>
	tree<sub>0</sub> (canonical)
		↓ op<sub>1</sub>
	tree<sub>1</sub>
		↓ op<sub>2</sub>
	tree<sub>2</sub>
		↓ ...
	tree<sub>n</sub> (final)
</pre>

### 4.2 操作種類（op）

目前爲封閉集合：

#### Text-level

- `replace_text`
- `insert_text`

#### Tree-level
- insert_subtree
	- 替換 non-terminal node
	- 插入於 terminal node（右子節點）
	
### 4.3 執行順序

metadata 的執行順序爲：

按 metadata 文檔中的排列順序

此順序具有語義意義：

- 不同順序可能產生不同結果
- metadata 可形成操作序列（transformation sequence）

---

## 5. 操作層次

### 5.1 Text-level operations

作用於：

- terminal nodes（字）
- 或其連續範圍

例如：

- 替換字
- 插入注釋文字

### 5.2 Subtree-level operations

作用於：

- non-terminal nodes（句、行等）
- 或將 terminal node 升格

#### 情況 A：non-terminal replacement

- 刪除原子樹
- 植入新子樹

#### 情況 B：terminal insertion

- terminal node → non-terminal node
- 原文字 → 左子節點
- 新子樹 → 右子節點

---

## 6. 中間狀態（Intermediate Trees）

在 pipeline 中，樹會經歷多個中間狀態：

canonical tree
→ text-modified tree
→ subtree-modified tree
→ final tree

這些中間狀態：

- 不必持久化
- 但在邏輯上存在
- 可用於 debug 或分析

---

## 7. 坐標系統

### 7.1 Canonical Coordinates

- 定義於基準正文樹
- 全域唯一
- 用於 metadata 定位

### 7.2 Derived Nodes

- 由 subtree 操作生成
- 可具有自身結構
- 可進一步附著 metadata（未來擴展）

---

## 8. Controller 的角色

Controller 負責：

解析 metadata
→ 根據 op 選擇操作
→ 修改當前樹

特點：

- 不依賴 cat
- 僅依賴 op
- 對樹進行逐步轉換

---

## 9. 輸出

最終生成：

edition tree

可進一步轉換爲：

- 純文本
- 帶注文本
- 不同版本面貌
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/tests/php/bin/pipeline">例子</a>

---

## 10. 設計原則

### 10.1 分層

cat → 語義
op  → 操作
tree → 結構

三者分離。

### 10.2 可組合（Composable）

- metadata 可串接
- 操作可疊加
- 支持多步轉換

### 10.3 可重建（Reproducible）

- pipeline 可重複執行
- 不依賴人工干預
- 任意版本可由 canonical + metadata 生成

---

## 11. 備註（待進一步研究）

- metadata 執行順序是否需分階段（phase）
- subtree 的來源與表示方式
- derived coordinates 的正式定義
- metadata 作用於 metadata（commentary-on-commentary）

模型已證明可遞歸（recursive）；實作暫停於第一層衍生，以避免過早擴張系統複雜度。