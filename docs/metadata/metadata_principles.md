# Metadata Principles 後設資料原則 （By ChatGPT）

## 1. 基本定位

在本系統中，metadata 不只是附註（annotation），而是：

> `可執行的轉換指令（executable transformation instructions）`

metadata 的作用，是對基準正文樹（canonical text tree）進行操作，從而生成不同版本的文本面貌。

---

## 2. Canonical Tree 爲唯一操作對象

- metadata 僅作用於`基準正文樹`
- 坐標系統亦僅定義於基準正文樹
- 所有操作的落點（scope）均在 canonical domain 中確定

子樹（subtree）：

- 可作爲 payload 被植入
- 可在植入前完成內部處理
- 一旦植入，主系統不再以 metadata 直接操作其內部結構

---

## 3. cat 與 op 的分離

在本系統中：

cat → 語義分類（semantic classification）
op  → 操作種類（operation type）

- cat 用於：
	- 語義標記
	- 索引與統計
- op 用於：
	- 定義具體操作行爲

二者：

- 可以相關
- 但不互相決定

---

## 4. 操作序列（Transformation Sequence）

metadata 按其在文件中的順序執行，形成操作序列：

<pre>
tree<sub>0</sub>
  ↓ op<sub>1</sub>
tree<sub>1</sub>
  ↓ op<sub>2</sub>
tree<sub>2</sub>
  ↓ ...
tree<sub>n</sub>
</pre>

卽：

> `metadata operations as a sequence of transformations on a canonical tree`

---

## 5. 可組合性（Composability）

metadata 操作可疊加：

- text-level operations（replace, insert）
- subtree-level operations（insert_subtree）

可在同一局部範圍內串接執行。

---

## 6. 系統設計原則

### 6.1 克制（Minimalism）

- 僅提供必要的操作類型
- 避免將所有複雜性納入 canonical domain

### 6.2 分層（Separation of Concerns）

canonical tree → 結構
metadata       → 操作指令
controller     → 執行邏輯

### 6.3 可重建（Reproducibility）

任一版本應滿足：

canonical tree + metadata → 可重建

---

## 7. 小結

metadata 是：

- 對 canonical tree 的操作語言
- 而非任意層級的通用標註系統