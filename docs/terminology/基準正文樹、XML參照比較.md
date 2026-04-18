# 基準正文樹、XML 參照比較

這個比照只是爲了給基準正文樹作一個比較直觀的說明。基準正文樹不用 XML，跟 XML
沒有任何結構或語義的關係。

## 基準正文樹

基準正文樹以 JSON 格式，儲存一基準正文之文字內容：

<pre>
{"3572": {
  "詩題":"八陣圖",
  "3":{
    "1":{
	  "1":"功","2":"蓋","3":"三","4":"分","5":"國"},
    "2":{
	  "1":"名","2":"成","3":"八","4":"陣","5":"圖"}},
  "4":{
    "1":{
	  "1":"江","2":"流","3":"石","4":"不","5":"轉"},
    "2":{
	  "1":"遺","2":"恨","3":"失","4":"吞","5":"吳"}}}}
</pre>

圖像顯示：

<pre>
3572
├── 詩題 → 八陣圖
├── 3（行）
│   ├── 1（句）
│   │   ├── 1 → 功
│   │   ├── 2 → 蓋
│   │   ├── 3 → 三
│   │   ├── 4 → 分
│   │   └── 5 → 國
│   └── 2（句）
│       ├── 1 → 名
│       ├── 2 → 成
│       ├── 3 → 八
│       ├── 4 → 陣
│       └── 5 → 圖
└── 4（行）
    ├── 1（句）
    │   ├── 1 → 江
    │   ├── 2 → 流
    │   ├── 3 → 石
    │   ├── 4 → 不
    │   └── 5 → 轉
    └── 2（句）
        ├── 1 → 遺
        ├── 2 → 恨
        ├── 3 → 失
        ├── 4 → 吞
        └── 5 → 吳
</pre>

## XML

基準正文樹可以轉換成 XML，兩者內容、結構大體相等：

<pre>
&lt;doc id="3572"&gt;
  &lt;title&gt;八陣圖&lt;/title&gt;
  &lt;line id="3"&gt;
    &lt;segment id="3.1"&gt;
	  &lt;char id="3.1.1"&gt;功&lt;/char&gt;
	  &lt;char id="3.1.2"&gt;蓋&lt;/char&gt;
	  &lt;char id="3.1.3"&gt;三&lt;/char&gt;
	  &lt;char id="3.1.4"&gt;分&lt;/char&gt;
	  &lt;char id="3.1.5"&gt;國&lt;/char&gt;
	&lt;/segment&gt;
	&lt;segment id="3.2"&gt;
	  &lt;char id="3.2.1"&gt;名&lt;/char&gt;
	  &lt;char id="3.2.2"&gt;成&lt;/char&gt;
	  &lt;char id="3.2.3"&gt;八&lt;/char&gt;
	  &lt;char id="3.2.4"&gt;陣&lt;/char&gt;
	  &lt;char id="3.2.5"&gt;圖&lt;/char&gt;
	&lt;/segment&gt;
  &lt;/line&gt;
  &lt;line id="4"&gt;
    &lt;segment id="4.1"&gt;
	  &lt;char id="4.1.1"&gt;江&lt;/char&gt;
	  &lt;char id="4.1.2"&gt;流&lt;/char&gt;
	  &lt;char id="4.1.3"&gt;石&lt;/char&gt;
	  &lt;char id="4.1.4"&gt;不&lt;/char&gt;
	  &lt;char id="4.1.5"&gt;轉&lt;/char&gt;
	&lt;/segment&gt;
	&lt;segment id="4.2"&gt;
	  &lt;char id="4.2.1"&gt;遺&lt;/char&gt;
	  &lt;char id="4.2.2"&gt;恨&lt;/char&gt;
	  &lt;char id="4.2.3"&gt;失&lt;/char&gt;
	  &lt;char id="4.2.4"&gt;吞&lt;/char&gt;
	  &lt;char id="4.2.5"&gt;吳&lt;/char&gt;
	&lt;/segment&gt;
  &lt;/line&gt;
&lt;/doc&gt;
</pre>

## 基準正文樹、XML 術語對照

- 文檔 ： doc
- 詩題 : title
- 行 ： line
- 句 ： segment
- 字 ： char
- 基準正文樹中非終端節點之身份標記（3、4 之類），對應 XML 中的 unique ids
- XML 中 char 的 unique ids，大體相當於基準正文樹中的坐標/路徑，如 `3.1.1` 對應 `〚3572:3.1.1〛`

## 基準正文樹與 XML 的區別

- 基準正文樹是 JSON 數據結構，可以在程式中直接發揮功能； XML 需要 parser 的處理
- 遍歷基準正文樹只利用遞歸（recursive）遍歷程序，不必理會節點的身份標記（node identifiers）
- 路徑/坐標跟 XML 無關，但與 XPath 的概念接近
- 基準正文樹 + 路徑/坐標的核心是正文定位；基準正文樹不是簡單的資料容器
- 基準正文樹可以外挂後設資料