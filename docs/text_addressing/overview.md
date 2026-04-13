# Text Addressing 文本定位 — Overview （By ChatGPT）

## 1. 定義

在本系統中，**Text Addressing（文本定位）**指的是：

>以坐標（coordinate）爲核心，建立文本與其在基準正文樹中的位置之間的對應關係，並支持定位、取出與查詢文本內容的機制。

簡言之：

>text ↔ coordinate

---

## 2. 核心槪念

Text Addressing 包含以下幾個基本要素：

### 2.1 坐標（Coordinate）

- 坐標是對基準正文樹中節點位置的標記
- 表達的是一條由根至節點的導航路徑
- 例如：

`〚0003:3.2.1〛`

### 2.2 文本實體（Textual Entity）

文本實體可以是：

- 單字（字）
- 句
- 行（聯）
- 詩（或章、篇等更高層單位）

在樹結構中，每一個非終端節點均可視爲一個可取出的文本單元。

### 2.3 路徑（Path）

坐標所表示的本質是：

>一條從根節點到目標節點的路徑

此路徑定義了文本在結構中的位置。

---

## 3. 基本操作

Text Addressing 支持三類基本操作：

### 3.1 定位（Addressing）

由坐標定位文本：

`coordinate → text`

例如：

`retrieve_text_from_canonical_tree('LUNYU', ['01','1']);`

### 3.2 反查（Resolution）

由文本（或其特徵）定位坐標：

`text → coordinate(s)`

例如：

- 查找包含「酒」字的所有坐標
- 查找同時包含「酒」、「病」的詩

### 3.3 查詢（Query）

在坐標與文本之間進行條件篩選：

`query(text conditions) → set of coordinates / texts`

例如：

- 羅列所有杜甫詩中，同時含「酒」與「病」的詩
- 查找詩題含「亭」，正文含「轉蓬」的作品

---

## 4. 對應關係（Mapping）

Text Addressing 建立並維護以下對應：

文本實體（詩 / 章 / 句 / 字）
        ↕
坐標（coordinate）

此對應關係具有以下特性：

- 一對多（例如一首詩對應多個坐標）
- 可逆（coordinate → text，text → coordinate）
- 可擴展（支持跨書、跨版本）

---

## 5. 與其他模塊的關係

Text Addressing 在系統中的位置如下：

| 模塊				| 職能				|
| ----------------- | -----------------	|
| data	 			| 定義基準正文樹與結構	|
| metadata			| 定義轉換操作			|
| controller		| 執行操作			|
| text_addressing	| 定位與取出文本		|

---

## 6. 設計原則

### 6.1 坐標爲核心

所有文本定位與檢索均以坐標爲基礎，而非頁碼或排版。

### 6.2 與面貌分離

Text Addressing 僅處理：

- 文本內容
- 結構位置

不涉及：

- 標點符號
- 排版形式
- 版本面貌

### 6.3 基於結構，而非字符串

文本邊界由樹結構決定，而非字串匹配。

---

## 7. 範圍

本模塊關注：

- 坐標系統
- 文本定位
- 文本提取
- 條件查詢

不包括：

- 文本轉換（metadata）
- 輸出格式（views / rendering）

---

## 8. 小結

Text Addressing 是本系統的另一條核心主軸：

- metadata → 改變文本
- text_addressing → 找到文本

二者相互獨立而互補，共同支撐整個系統。