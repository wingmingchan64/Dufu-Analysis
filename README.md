<h1>杜甫詩分析、資料庫</h1>

<p>這裏提供的主要是 PHP 程式。這些程式分四大類：</p>
<ul>
<li>關於杜詩的各種統計數字</li>
<li>包含各種原始資料的陣列；這部分其實是個小型的資料庫</li>
<li>生成這個資料庫的程式</li>
<li>展示如何搜索這個資料庫的程式</li>
</ul>
<p>聯係資料庫各個部分的關鍵是一個坐標系統。請從<a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/%E9%97%9C%E6%96%BC%E5%9D%90%E6%A8%99%E7%9A%84%E8%AA%AA%E6%98%8E.txt">關於坐標的說明</a>開始。</p>
<h2>杜甫詩資料庫</h2>
<p>我原來的打算是把生成的所有 PHP 程式都上傳到 github，可是最後把我的戶口擠爆了。現在，這裏只保留了資料庫文檔的一小部分。其實，會編程的朋友可以自己生成這些文檔，不會編程的朋友看了這些程式也是白搭，也只好這樣了。</p>
<p><a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/_%E6%9%9C%E8%A9%A9%E8%B3%87%E6%96%99%E5%BA%AB%E6%96%87%E6%AA%94%E4%B8%80%E8%A6%BD.txt">杜詩資料庫文檔一覽</a></p>
<p><a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/_exec.txt">_exec.txt</a>： 執行這些程式的順序</p>

<h2>生成杜甫詩資料庫的 PHP 程式</h2>
<p><a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/analysis_programs">analysis_programs</a></p>
<h2>搜索程式</h2>
<p><a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/analysis_programs/%E6%90%9C%E7%B4%A2%E7%A8%8B%E5%BC%8F">搜索程式</a>展示了如何利用坐標、資料庫，找到我們想要的東西。</p>
<ul>
<li>版本詩文：利用某注本中【異文、夾注】的資料，復原這個注本的白文，包括異體字、夾注等。</li>
<li>兩字出現於同一首詩：找尋包含某兩個特定的、不一定相關的字的所有詩</li>
<li>搜索與坐標：從一句詩文開始，搜索某注本中的相關注釋</li>
<li>爲注釋生成坐標：用人手來標記詩文的坐標，很容易出錯。最理想的做法是自動生成坐標。這樣生成的坐標是不會錯的。這裏要嘗試的是生成【注釋】部分的坐標。
</li>
</ul>
<h2>不同的版本</h2>
<p>資料庫中所用的詩文是經過統一化、標準化的。各版本與這個標準版本不同的地方，散見於各詩的【異文、夾注】內。我也寫了一個程式，把相應的、包含異文、夾注的詩文，放在各版本的文件夾內。例如，在「蕭滌非主編《杜甫全集校注》」一文件夾中，可以找到這個版本的詩文，這個版本包含所有的異文，如「却」、「盃」等字。</p>
<ul>
<li>默認版本：<br />
<a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86.txt">杜甫全集</a><br />
這個版本是個以蕭滌非主編之《杜甫全集校注》爲底本，去掉夾注、簡體字、錯字、大部分的異體字以後所生成的乾淨版本。所有版本比較，均以此版本爲標準。<br />
按：默認版本包含《杜鵑行》（君不見）。
</li>
<li>蕭滌非主編《杜甫全集校注》（在校對中）：<br />
<a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/%E8%95%AD%E6%BB%8C%E9%9D%9E%E4%B8%BB%E7%B7%A8%E3%80%8A%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86%E6%A0%A1%E6%B3%A8%E3%80%8B/%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86.txt">杜甫全集</a><br />
<a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/%E8%95%AD%E6%BB%8C%E9%9D%9E%E4%B8%BB%E7%B7%A8%E3%80%8A%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86%E6%A0%A1%E6%B3%A8%E3%80%8B/%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86%E7%84%A1%E5%A4%BE%E6%B3%A8.txt">杜甫全集無夾注</a><br />
按：《杜鵑行》（君不見）此版本缺。
</li>
<li>《全唐詩》（在生成中）：<br />
<a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/%E3%80%8A%E5%85%A8%E5%94%90%E8%A9%A9%E3%80%8B/%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86.txt">杜甫全集</a><br />
<a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/%E3%80%8A%E5%85%A8%E5%94%90%E8%A9%A9%E3%80%8B/%E6%9D%9C%E7%94%AB%E5%85%A8%E9%9B%86%E7%84%A1%E5%A4%BE%E6%B3%A8.txt">杜甫全集無夾注</a>
</li>
</ul>


<h2>未來的計劃</h2>
<ul>
<li>完成《杜甫全集粵音注音》</li>
<li>把杜詩用字與各字的讀音（粵音）、注釋聯係起來，把<a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/%E7%94%A8%E5%AD%97">用字</a>變成一本杜詩字典</li>
<li>還要細讀杜詩，并且繼續擴充《杜甫全集校注》、《杜甫詩全譯》、《杜詩全集（今注本）》的部分</li>
<li>繼續看莫礪鋒、徐仁甫等學者的論著</li>
<li>行有餘力的話，加入宋、清的注本（現在正努力輸入浦起龍的《讀杜心解》）</li>
<li>看看杜甫年譜、傳記</li>
</ul>