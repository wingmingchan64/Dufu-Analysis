# 基準正文樹、XML參照比較

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

## XML

基準正文樹可以轉換成 XML：

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