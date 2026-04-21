# From Canonical Tree to Metadata

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

>`添加標點符號( $樹 );`
>`添加錨( $樹 );`

<pre>

</pre>