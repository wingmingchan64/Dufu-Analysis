# 《全唐詩》

還原《全唐詩》的本來面目，這只是杜甫資料庫的一個副產品。在這個資料庫中，面貌（views）是以程式生成的。要生成《全唐詩》其中的一個文檔，像全0098《遣興五首》，我們需要一些文檔。首先是默認版本的基準正文樹：

- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/schemas/json/base_text/1376-1.json">1376-1.json</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/schemas/json/base_text/1376-2.json">1376-2.json</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/schemas/json/base_text/1197-1.json">1197-1.json</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/schemas/json/base_text/1197-2.json">1197-2.json</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/schemas/json/base_text/1197-3.json">1197-3.json</a>

然後，是全0098的後設資料：

- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/packages/%E3%80%8A%E5%85%A8%E5%94%90%E8%A9%A9%E3%80%8B/metadata/by_doc_id/0098.json">0098.json</a>

最後，執行以下程式：

- <a href="https://github.com/wingmingchan64/Dufu-Analysis/blob/main/tools/php/bin/views/%E7%94%9F%E6%88%90%E7%89%88%E6%9C%AC/%E7%94%9F%E6%88%90%E3%80%8A%E5%85%A8%E5%94%90%E8%A9%A9%E3%80%8B.php">生成《全唐詩》.php</a>
