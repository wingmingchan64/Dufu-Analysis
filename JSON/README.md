<h1>JSON</h1>
<h2>杜甫資料庫的重建</h2>
<p>基於 ChatGPT 的建議，我決定重建整個杜甫資料庫。以下，是幾個重要的改變：</p>
<ul>
<li>原始資料，像趙次公、仇兆鰲的注本，分別置於各自的文件夾內，不再混雜在一起</li>
<li>在原始資料中加入大量的後設資料</li>
<li>處理過的、生成的資料，以 JSON 的格式儲存，以維持其語言的獨立性</li>
<li>生成 view 文檔的程式，仍以 PHP 爲主，但我也會嘗試用 Python 來生成 view 的文檔</li>
<li>view 文檔的格式，仍以 .txt 爲主（往後可以輕易地改成 html 的格式）；我也會考慮生成 .md 文檔</p>
</ul>
<h2>必要的步驟</h2>
<ul>
<li>原有的 PHP 數據結構，如果是手編的，就用一個簡單的程式，把它轉換成 JSON 數據結構</li>
<li>如果數據結構是用 PHP 生成的，則改寫程式，把輸出的數據結構改爲 JSON 格式</li>
<li>要利用這些數據結構，則先把 JSON 文檔內容轉換成合用的 PHP 或者 Python 的數據結構</li>
</ul>
<h2>JSON 數據結構的生成</h2>
<ul>
<li>以 <code>程式\array_to_json.php</code> 生成：
<ul>
<li><code>數據結構\詩頁碼.json</code></li>
<li><code>數據結構\詩組_詩題.json</code></li>
<li><code>數據結構\帶序文之詩歌.json</code></li>
<li><code>數據結構\書目簡稱.json</code></li>
<li><code>數據結構\詩題_詩頁碼.json</code></li>
<li><code>數據結構\詩頁碼_題注.json</code></li>
<li><code></code></li>
<li><code></code></li>
<li><code></code></li>
<li><code></code></li>
</ul>
</li>
<li>執行以下程式：
<ul>
<li><code>程式\生成默認版本詩碼.php</code></li>
<li><code>程式\生成杜甫全集.php</code></li>
<li><code>程式\生成詩頁碼_詩題.php</code></li>
<li><code>程式\生成坐標_詩文.php</code></li>
<li><code></code></li>
<li><code></code></li>
<li><code></code></li>
<li><code></code></li>

</ul>
</li>
<li></li>
<li></li>
<li></li>
<li></li>
</ul>