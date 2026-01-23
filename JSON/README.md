<h1>JSON</h1>
<p>基於 OpenAI 的建議，我決定重建整個杜甫資料庫。以下，是幾個重要的改變：</p>
<ul>
<li>原始資料，像趙次公、仇兆鰲的注本，分別置於各自的文件夾內，不再混雜在一起</li>
<li>在原始資料中加入大量的後設資料</li>
<li>處理過的、生成的資料，以 JSON 的格式儲存，以維持其語言的獨立性</li>
<li>生成 view 文檔的程式，仍以 PHP 爲主，但我也會嘗試用 Python 來生成 view 的文檔</li>
<li>view 文檔的格式，仍以 .txt 爲主（往後可以輕易地改成 html 的格式）；我也會考慮生成 .md 文檔</p>

</ul>
<p>兩個步驟：</p>
<ul>
<li>改寫生成 data structures 的程式，把資料儲存在 JSON 文檔裏</li>
<li>如果要利用這些 data structures，則先把 JSON 文檔內容轉換成合用的 PHP 或者 Python data structures</li>
</ul>