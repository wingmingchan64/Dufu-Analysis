# Subtree-level Metadata（子樹層級後設資料）

## 1. 背景

現有後設資料模型主要作用於文字層面（text-level），即對基準正文樹中的終節點（字）或其連續範圍進行操作，包括：

- 替換（replace）
- 插入（insert）
- 刪除（delete）

這一模型在處理杜詩異文、夾注等情況時運作良好。

然而，在處理如《紅樓夢》這類文本時，出現了超出文字層面的結構性問題：

- 評注的對象不僅是正文，亦包括其他評注（commentary-on-commentary）
- 不同版本之間的差異不僅是文字差異，亦包括段落、篇章的增刪與重組
- 新增內容本身可能攜帶後設資料，形成嵌套結構

這些情況無法以單純的文字替換或插入來充分表達。

---

## 2. 問題

文字的線性排列掩蓋了其背後的層次結構。

現有模型的限制在於：

- metadata 僅附著於文字鏈（terminal nodes）
- 無法直接操作非終節點（non-terminal nodes）
- 無法表示子樹（subtree）級別的替換與插入
- 無法自然表達版本之間的結構性差異

例如：

- 程甲、乙本對原文的大段增補
- 脂批中對其他批語的評論
- 校注層對正文與評注的雙重作用

---

## 3. 基本思路

引入`子樹層級後設資料`（subtree-level metadata），使 metadata 的操作單位從文字擴展至樹結構。

後設資料可分為兩類：

### 3.1 文字層級（text-level）

- 操作對象：terminal nodes（字）
- 操作形式：
	- replace_text
	- insert_text
	- delete_text

### 3.2 子樹層級（tree-level）

- 操作對象：non-terminal nodes（句、行、段、篇）或其子樹
- 操作形式：
	- replace_subtree
	- insert_subtree
	
---

## 4. 子樹操作類型

### 4.1 子樹替換（subtree replacement）

條件：

- `scope_end` 指向 non-terminal node

行為：

- 移除該節點所對應的整個子樹
- 植入新的子樹

用途：

- 表示版本中整段文字的替換
- 表示大規模修訂（如程本改寫）

---

### 4.2 子樹插入（subtree insertion）

條件：

- `scope_end` 指向 terminal node

行為：

- 將該 terminal node 提升為 non-terminal node
- 原文字成為左子節點
- 新子樹作為右子節點插入

結果：

- 原文保留
- 新內容附著於該節點
- 新子樹可擁有自身的坐標與後設資料

用途：

- 插入批語、評注
- 插入版本增補內容
- 表示多層評注結構

---

## 5. 坐標問題（Coordinates）

在引入子樹操作後，坐標的語義需擴展。

### 5.1 基準坐標（canonical coordinates）

- 定義於基準正文樹
- 為全域唯一標識
- 用於定位原始文本節點

### 5.2 衍生坐標（derived coordinates）

- 定義於版本生成過程中引入的子樹
- 僅在特定版本或子樹上下文中有效
- 可用於標識新插入的內容及其內部結構

---

## 6. 架構意義

引入子樹層級後設資料後，系統能力由：

文字變體（text variants）

擴展為：

結構變體（structural variants）

這使得系統能夠：

- 表示版本之間的結構性差異
- 支持多層評注（annotation layers）
- 支持「評注的評注」
- 更準確地還原不同版本的文本面貌

---

## 7. 小結

子樹層級後設資料並非對現有模型的替代，而是其自然擴展。

- 原有 text-level metadata 保持不變
- tree-level metadata 作為補充
- 二者共同構成完整的文本操作系統

此擴展標誌著系統從處理文字層面的差異，進一步發展為處理文本結構本身的差異。