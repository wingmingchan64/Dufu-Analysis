# Scope of Operations（操作範圍，暫定稿） （By ChatGPT）

## 1. 操作域（Operation Domain）

目前系統區分兩個範疇：

### 1.1 Canonical Domain

- 對象：基準正文樹
- 工具：metadata + 坐標
- 所有 op 均在此域執行

### 1.2 Subtree Domain

- 對象：待植入子樹
- 不屬於 canonical metadata 系統
- 可在植入前完成自身處理

---

## 2. Metadata 的作用範圍

metadata：

- 僅作用於 canonical tree
- 不直接作用於已植入子樹內部

---

## 3. 子樹的處理原則

子樹：

- 作爲 payload 植入 canonical tree
- 植入前可進行任意內部處理
- 植入後視爲黑箱（opaque structure）

---

## 4. 爲何限制操作範圍

此限制的目的：

- 保持坐標系統簡潔
- 保持 controller 邏輯清晰
- 避免跨層級操作導致複雜度爆炸

---

## 5. 遞歸操作（暫不實作）

理論上：

- 子樹內部亦可進行 metadata 操作
- 甚至可再次植入子樹

但此將導致：

- 坐標系統需擴展
- 操作域混合

因此目前策略爲：

> 僅在子樹植入前完成其內部操作

---

## 6. 操作類型

目前 op 爲封閉集合：

`Text-level`
- replace_text
- insert_text

`Tree-level`
- insert_subtree
	- 替換 non-terminal node
	- 插入於 terminal node

---

## 7. 執行模型

<pre>
canonical tree
    ↓
apply metadata (in order)
    ↓
derived tree
</pre>

---

## 8. 小結

- metadata 操作僅限於 canonical domain，
- subtree 作爲外部結構接入，而非操作對象。