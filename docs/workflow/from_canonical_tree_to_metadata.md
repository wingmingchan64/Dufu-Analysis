# From Canonical Tree to Metadata

Status: Draft

---

## Introduction

This document shows how the metadata component does the following:

- adds anchors to a canonical tree
- processes the metadata tags
- attaches metadata tags to the tree

The metadata component does not deal with rendering of the tree.

---

## Canonical Tree

We start with a canonical tree. Here is the code to retrieve a tree:

>`$樹 = 提取基準正文樹( '0003' );`

Here is the tree:

<pre>
Array
(
    [0003] => Array
        (
            [詩題] => 望嶽
            [3] => Array
                (
                    [1] => Array
                        (
                            [1] => 岱
                            [2] => 宗
                            [3] => 夫
                            [4] => 如
                            [5] => 何
                        )
                    [2] => Array
                        (
                            [1] => 齊
                            [2] => 魯
                            [3] => 青
                            [4] => 未
                            [5] => 了
                        )
                )
            [4] => Array
                (
                    [1] => Array
                        (
                            [1] => 造
                            [2] => 化
                            [3] => 鍾
                            [4] => 神
                            [5] => 秀
                        )
                    [2] => Array
                        (
                            [1] => 陰
                            [2] => 陽
                            [3] => 割
                            [4] => 昏
                            [5] => 曉
                        )
                )
            [5] => Array
                (
                    [1] => Array
                        (
                            [1] => 盪
                            [2] => 胸
                            [3] => 生
                            [4] => 曾
                            [5] => 雲
                        )
                    [2] => Array
                        (
                            [1] => 決
                            [2] => 眥
                            [3] => 入
                            [4] => 歸
                            [5] => 鳥
                        )
                )
            [6] => Array
                (
                    [1] => Array
                        (
                            [1] => 會
                            [2] => 當
                            [3] => 凌
                            [4] => 絕
                            [5] => 頂
                        )
                    [2] => Array
                        (
                            [1] => 一
                            [2] => 覽
                            [3] => 眾
                            [4] => 山
                            [5] => 小
                        )
                )
        )
)
</pre>

---

## Adding Anchors to the Canonical Tree

The next step is to add default punctuations and anchors to various levels of the tree. Here is the code:

>`添加標點符號( $樹 );`<br />
`添加錨( $樹 );`

Now the tree becomes:

<pre>
Array
(
    [0003] => Array
        (
            [詩題] => Array
                (
                    [0] => 望嶽
                    [1] =>
                )
            [3] => Array
                (
                    [1] => Array
                        (
                            [1] => 岱
                            [2] => 宗
                            [3] => 夫
                            [4] => 如
                            [5] => 何
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 齊
                            [2] => 魯
                            [3] => 青
                            [4] => 未
                            [5] => 了
                            [p] => 。
                            [a] =>
                        )
                    [a] =>
                )
            [4] => Array
                (
                    [1] => Array
                        (
                            [1] => 造
                            [2] => 化
                            [3] => 鍾
                            [4] => 神
                            [5] => 秀
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 陰
                            [2] => 陽
                            [3] => 割
                            [4] => 昏
                            [5] => 曉
                            [p] => 。
                            [a] =>
                        )
                    [a] =>
                )
            [5] => Array
                (
                    [1] => Array
                        (
                            [1] => 盪
                            [2] => 胸
                            [3] => 生
                            [4] => 曾
                            [5] => 雲
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 決
                            [2] => 眥
                            [3] => 入
                            [4] => 歸
                            [5] => 鳥
                            [p] => 。
                            [a] =>
                        )
                    [a] =>
                )
            [6] => Array
                (
                    [1] => Array
                        (
                            [1] => 會
                            [2] => 當
                            [3] => 凌
                            [4] => 絕
                            [5] => 頂
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 一
                            [2] => 覽
                            [3] => 眾
                            [4] => 山
                            [5] => 小
                            [p] => 。
                            [a] =>
                        )
                    [a] =>
                )
            [a] =>
        )
    [a] =>
)
</pre>

---

## Metadata tags

The next steps is to prepare the metadata tags:

<pre>
mong6 ngok6〘{"cat":"粵","anchor":"0003,詩題,1","scope":"0003,1","op":"assign"}〙
doi6 zung1 fu4 jyu4 ho4 cai4 lou5 cing1 mei6 liu5〘{"cat":"粵","anchor":"0003,3,a","scope":"0003,3","op":"assign"}〙
zou6 faa3 zung1 san4 sau3 jam1 joeng4 got3 fan1 hiu2〘{"cat":"粵","anchor":"0003,4,a","scope":"0003,4","op":"assign"}〙
dong6 hung1 sang1 cang4 wan4 kyut3 zi6 jap6 gwai1 niu5〘{"cat":"粵","anchor":"0003,5,a","scope":"0003,5","op":"assign"}〙
wui6 dong1 ling4 zyut6 ding2 jat1 laam5 zung3 saan1 siu2〘{"cat":"粵","anchor":"0003,6,a","scope":"0003,6","op":"assign"}〙
筱韻〘{"cat":"韻","anchor":"0003,3,2,a","scope":"0003,3,2,5","op":"assign"}〙
筱韻〘{"cat":"韻","anchor":"0003,4,2,a","scope":"0003,4,2,5","op":"assign"}〙
筱韻〘{"cat":"韻","anchor":"0003,5,2,a","scope":"0003,5,2,5","op":"assign"}〙
筱韻〘{"cat":"韻","anchor":"0003,6,2,a","scope":"0003,6,2,5","op":"assign"}〙
{"title":"體裁","contents":["五古"]}〘{"cat":"體","anchor":"0003,a","scope":"0003","op":"assign"}〙
{"1":
{"title":"補充說明",
"contents":["下定雅弘、松原朗《杜甫全詩訳注》認爲「神秀」是雙聲詞。《廣韻》「神」屬船母（濁），「秀」屬心母（清），至粵語合流爲清音。日語中，「神」，シン；「秀」，シュウ，確是雙聲。又「昏曉」爲雙聲詞（曉母），但日語「コンギョウ」卻不是（作者原有之振り仮名，キ之濁化源於前面的ン），除非把「曉」標爲「キョウ」（原音訓）。"]},
"2":{"title":"其他","contents":["攄，syu1。","嶒，cang4。","毗，pei4。","峛崺，lei5 ji5。","培塿，pau2 lau5。","扛，gong1。"]}}〘{"cat":"體","anchor":"a","scope":"0003","op":"assign"}〙
</pre>

Each tag consists of some texts (possibly jsonl) and an array of information, including a processing instruction. For example:

<pre>
mong6 ngok6〘{"cat":"粵","anchor":"0003,詩題,1","scope":"0003,1","op":"assign"}〙
</pre>

This tag instructs the system to assign the string '{"cat":"粵","scope":"0003,1"}' to the anchor "0003,詩題,1".

---

## The Resulting Tree

After all metadata tags are processed, the tree becomes:

<pre>
Array
(
    [0003] => Array
        (
            [詩題] => Array
                (
                    [0] => 望嶽
                    [1] => {"book":"粵","cat":"粵","scope":"0003,1","text":"mong6 ngok6"}
                )
            [3] => Array
                (
                    [1] => Array
                        (
                            [1] => 岱
                            [2] => 宗
                            [3] => 夫
                            [4] => 如
                            [5] => 何
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 齊
                            [2] => 魯
                            [3] => 青
                            [4] => 未
                            [5] => 了
                            [p] => 。
                            [a] => {"book":"粵","cat":"韻","scope":"0003,3,2,5","text":"筱韻"}
                        )
                    [a] => {"book":"粵","cat":"粵","scope":"0003,3","text":"doi6 zung1 fu4 jyu4 ho4 cai4 lou5 cing1 mei6 liu5"}
                )
            [4] => Array
                (
                    [1] => Array
                        (
                            [1] => 造
                            [2] => 化
                            [3] => 鍾
                            [4] => 神
                            [5] => 秀
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 陰
                            [2] => 陽
                            [3] => 割
                            [4] => 昏
                            [5] => 曉
                            [p] => 。
                            [a] => {"book":"粵","cat":"韻","scope":"0003,4,2,5","text":"筱韻"}
                        )
                    [a] => {"book":"粵","cat":"粵","scope":"0003,4","text":"zou6 faa3 zung1 san4 sau3 jam1 joeng4 got3 fan1 hiu2"}
                )
            [5] => Array
                (
                    [1] => Array
                        (
                            [1] => 盪
                            [2] => 胸
                            [3] => 生
                            [4] => 曾
                            [5] => 雲
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 決
                            [2] => 眥
                            [3] => 入
                            [4] => 歸
                            [5] => 鳥
                            [p] => 。
                            [a] => {"book":"粵","cat":"韻","scope":"0003,5,2,5","text":"筱韻"}
                        )
                    [a] => {"book":"粵","cat":"粵","scope":"0003,5","text":"dong6 hung1 sang1 cang4 wan4 kyut3 zi6 jap6 gwai1 niu5"}
                )
            [6] => Array
                (
                    [1] => Array
                        (
                            [1] => 會
                            [2] => 當
                            [3] => 凌
                            [4] => 絕
                            [5] => 頂
                            [p] => 。
                            [a] =>
                        )
                    [2] => Array
                        (
                            [1] => 一
                            [2] => 覽
                            [3] => 眾
                            [4] => 山
                            [5] => 小
                            [p] => 。
                            [a] => {"book":"粵","cat":"韻","scope":"0003,6,2,5","text":"筱韻"}
                        )
                    [a] => {"book":"粵","cat":"粵","scope":"0003,6","text":"wui6 dong1 ling4 zyut6 ding2 jat1 laam5 zung3 saan1 siu2"}
                )
            [a] => {"book":"粵","cat":"體","scope":"0003"}
{"title":"體裁","contents":["五古"]}
        )
    [a] => {"book":"粵","cat":"體","scope":"0003"}
{"1":
{"title":"補充說明",
"contents":["下定雅弘、松原朗《杜甫全詩訳注》認爲「神秀」是雙聲詞。《廣韻》「神」屬船母（濁），「秀」屬心母（清），至粵語合流爲清音。日語中，「神」，シン；「秀」，シュウ，確是雙聲。又「昏曉」爲雙聲詞（曉母），但日語「コンギョウ」卻不是（作者原有之振り仮名，キ之濁化源於前面的ン），除非把「曉」標爲「キョウ」（原音訓）。"]},
"2":{"title":"其他","contents":["攄，syu1。","嶒，cang4。","毗，pei4。","峛崺，lei5 ji5。","培塿，pau2 lau5。","扛，gong1。"]}}
)
</pre>

The string attached to an anchor is either a JSON or a JSONL that can be processed by the rendering component. An array storing all the anchors affected is also created:

<pre>
Array
(
    [0] => 0003,詩題,1
    [1] => 0003,3,a
    [2] => 0003,4,a
    [3] => 0003,5,a
    [4] => 0003,6,a
    [5] => 0003,3,2,a
    [6] => 0003,4,2,a
    [7] => 0003,5,2,a
    [8] => 0003,6,2,a
    [9] => 0003,a
    [10] => a
)
</pre>

Now the tree and the anchor array can be passed to the rendering component to turn the tree into a view. The JSON/JSONL strings stored in anchors provide essential information for the rendering component and help it figuring out how to render the texts provided.

## Rendering the Tree

This is a preview of the rendering component.

- The component should provide a set of view creating functions, each responsible for the creation of a view of a certain format, like XML, HTML, .md or plain text
- the path array provides paths pointing to nodes which  store metadata that should be processed
- a view creating function will look at the semantic structure of the metadata and determine how to render the associated string
- the rendering component can also pass the tree received from the metadata component along to the client without doing anything