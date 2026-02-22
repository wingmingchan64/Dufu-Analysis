# 杜甫工程術語對照表 Du Fu System – Bilingual Terminology Glossary

## 一、本體層 (Ontology Layer)

### 詩 Poem (root node)

一首完整作品。樹的根節點。
A complete work. The root node of the text tree.

### 行 Line (line node)

詩的第一層結構單位。
First structural level under the poem root.

### 句 Segment (segment node)

詩行內的結構分段單位。
A structural subdivision within a poetic line.
Not equivalent to “sentence”; it is a poetic segment.

### 字 Character (leaf node)

最小文本單位。樹的葉節點。
The smallest textual unit. Leaf node of the tree.

## 二、坐標層（Coordinate Layer）
### 坐標 Coordinate / Path

從詩根到某節點的路徑表示。
A path from the root to a specific node.

例 Example:

```〚0465:3.2.1〛```

= Poem 0465 → Line 3 → Segment 2 → Character 1

### 行碼 Line index

行在詩中的順序標號。
Index of a line within a poem.

### 句碼 Segment index

句在詩行中的順序標號。
Index of a segment within a line.

### 字碼 Character index

字在句中的順序標號。
Index of a character within a segment.

### 範圍坐標 Range coordinate

表示連續區間的坐標。
A coordinate representing a continuous interval.

例 Example:

〚0003:3-5〛

規則 Rule:

Range must be continuous.
範圍必須是連續區間。

## 三、語義識別層（Semantic ID Layer）

### 文檔 Document (container)

可裝載詩、組詩、注、評等資料的容器。
A container that may hold one poem or a grouped set.

### 文檔碼 Document code

版本內唯一的容器識別符號。
Identifier unique within a given edition.

例 Example:

0003
詩碼

Poem code

表示單首詩（或組詩中的一首）的識別符號。
Identifier of a single poem unit.

例 Example:

0013-1
doc_id

Global document identifier

全域唯一識別符號，由書目簡稱 + 文檔碼 (+ 行碼) 組成。
Globally unique identifier combining edition prefix and document code.

例 Example:

蕭0003.1
四、版本層（Edition Layer）
書目簡稱

Edition prefix / Abbreviation

表示某一版本的縮寫。
Abbreviation identifying an edition.

例 Example:

郭
蕭
全
版本坐標

Edition coordinate

帶書目前綴的定位坐標。
Coordinate within a specific edition context.

例 Example:

〚郭0015:1:〛
次版本

Sub-edition / Witness layer

版本內部的底本或校勘層。
Sub-layer within an edition (e.g., base copy).

例 Example:

〚郭⸨聶⸩0015:1:〛
五、後設資料層（Metadata Layer）
後設資料

Metadata / Decoration layer

掛接於樹節點上的說明資料。
Data attached to tree nodes as annotations.

掛點

Anchor point

後設資料所指向的坐標位置。
The coordinate to which metadata attaches.

裝飾品

Annotation object / Decoration

一條具語義的後設資料記錄。
A semantically meaningful metadata record.

六、呈現層（Presentation Layer）
面貌

View / Appearance

樹與後設資料經過特定遍歷算法後的呈現形式。
A presentation form generated from tree + metadata.

深度優先遍歷

Depth-first traversal (DFS)

從第一個字到最後一個字的順序讀取方式。

廣度優先遍歷

Breadth-first traversal (BFS)

分層展開結構以重建詩文。

核心方法論（Core Structural Principles）

文本是有限深度有序樹。
Text is a finite-depth ordered tree.

坐標是從根到節點的路徑。
A coordinate is a path from root to node.

後設資料是可掛接於任意節點的裝飾。
Metadata attaches to any node.

面貌是遍歷策略的結果。
View is the result of traversal strategy.