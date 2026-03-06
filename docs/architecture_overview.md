# Architecture Overview

本系統旨在建立一個以 **canonical 杜甫文本** 爲核心的注釋與後設資料架構，用以支援：

- 注釋整理
- 版本對齊
- 原書還原
- 杜甫詞典自動生成
- 注釋統計與詩學研究

---

## 1. Canonical Text

系統以固定的 **canonical 杜甫文本** 爲唯一文本基準。

特性如下：

canonical 文本的字序固定不變。

- 字數不因版本差異而改變。
- 若有修訂，只限於字形標準化（如異體字改爲規範字）。
- 各版本文本均映射至 canonical 文本，而不直接改動 canonical 文本。

---

## 2. Coordinate System

canonical 文本使用四層坐標系：

`詩 : 聯 . 句 . 字`

例如：

`〚0276:3.1.5〛`

表示編號爲 0276 的詩、第 3 聯、第 1 句、句內第 5 字。

此坐標系同時具有層級語義：

- 詩級坐標：整首詩
- 聯級坐標：某聯
- 句級坐標：某句
- 字級坐標：單一字位置

系統內部只使用此坐標系；全詩字序若有需要，可由程式計算，不另作主坐標系。

---

## 3. Annotation Model

每條 annotation 至少包含兩個核心元素：

- `anchor`：落點，必爲單一字坐標
- `scope`：作用範圍，爲 canonical 文本上的連續區間

規則如下：

- `anchor` 必須是單字坐標。
- `scope` 必須存在，不允許爲 null。
- `scope` 必須覆蓋連續字序。
- `anchor` 必須包含於 `scope` 之內。

scope 的粒度可爲：

- 字
- 詞
- 句
- 聯
- 詩

若無法確定更細範圍，scope 可提升至上層單位；必要時可取整首詩。

## 4. Interval Principle

所有 annotation 的 scope 均視爲 canonical 文本上的 interval。

annotation interval 只允許兩種關係：

- 相離（disjoint）
- 包含（nested）

不允許交叉（crossing）。

若兩條 annotation 互相交叉，應合併爲較大的 annotation 單元。

此原則適用於注與評，亦是 canonical 注釋可逆還原與詞典生成的基礎。

## 5. Annotation Types

annotation 類型採 **controlled vocabulary**，不用 open-ended system。

目前核心類型可包括：

- 字注
- 詞注
- 句注、句評
- 聯注、聯評
- 詩評
- 泛論

其中：

- 注：偏解釋性材料
- 評：偏評論性材料
- 泛論：藉某詩而發的詩學或一般議論，其 scope 仍標爲該詩，以表示附著位置

annotation 類型原則上應單一。若一段文字兼具多種性質，應優先考慮分解，而非複標。

## 6. Topics and References

系統不採單一扁平 `tags`，而採分類後的 metadata facets。

至少可分爲：

### References

- books
- people

### Topics

例如：

- 典故
- 詩法
- 氣格
- 政治
- 時事
- 制度
- 地理

`references` 與 `topics` 均宜採 controlled vocabulary。
`topic` 原則上單一；必要時先分解 annotation，再考慮例外。

## 7. Source Layer

每條 annotation 同時保留來源層資訊，以支援版本還原與原文追索。

來源層可包括：

- `work_id`：著述 ID，如 郭
- `edition_id`：版本 ID，如 郭⸨聶⸩
- `unit_id`：著述單元 ID，如 郭0001
- `doc_id`：文件容器 ID，如 0001
- `aid`：來源錨 ID，如 郭0018@P0040L10
- `sid`：來源 annotation 唯一 ID
- `pos`：同一來源行內的次序

其中：

- `unit_id` 指著述中的單元
- `doc_id` 指文件容器
- 二者不可混同

## 8. Storage Model

metadata 以 `doc_id` 爲基本容器組織。

以某著述爲例，其資料結構可分爲：

- `catalog`：目錄文檔
- `metadata/doc_records`：一首詩／組詩一個文檔，存全部 metadata
- `metadata/doc_texts`：一首詩／組詩一個文檔，存 `sid -> 著述原文`
- `metadata/doc_index_*.json`：按 annotation 類型建立索引，如 注、異、評、按語、校記等

這種設計兼顧：

- 主資料集中保存
- 原文獨立管理
- 類型快速檢索
- 以 `doc_id` 爲自然工作單位

## 9. Canonical / Source Reversibility

系統不僅支援由來源版本分解爲 canonical annotation，也支援由 canonical annotation 回復來源版本結構。

其中：

- `anchor + scope` 支援 canonical 層精確附著
- 來源層資訊支援原書版本的聯注、句注、夾注、數字注等還原
- 同一來源著述內部亦可能存在多層 source structure，需在來源層中保留

此可逆性是本系統的重要設計目標。

## 10. Design Philosophy

本系統遵循以下原則：

- 以 canonical 文本爲唯一基準
- 坐標與範圍清楚
- annotation 單元盡量單一、可分解
- metadata 使用 controlled vocabulary
- 主資料、原文、索引分層管理
- 先求結構穩定，再求功能擴展

系統不是 open-ended tagging platform，而是面向數位人文研究的 controlled scholarly annotation system。