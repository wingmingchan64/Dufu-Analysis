# Representing 詩

## The Relevance Of 段 In 詩

- The concept of 段 is not very useful in the context of 詩
- A 詩 has only one 段
- In some 杜著述 like 仇兆鰲《杜詩詳註》, which use the concepts of 段落, is 杜著述-specific, not Du Fu's

---

## Hierarchical Structures of 詩

A 詩 can be analyzed in terms of:

- 詩題
- 題注（杜甫自注）
- 序
- 聯
- 句
- 字（言）

Important points:

- 詩題,聯,句 and so on are traditional concepts, not belonging specifically to the framework
- Analyzing a 詩 into these smaller units facilitates easy text location, retrieval, and attachment of additional text

---

## Suites

A 組詩 (suite) can be treated as a set of 詩s, grouped under a common 詩題. Each member of the suite can have a separate 副題.

---

## Trees

A 詩, when represented as a tree, has the following structure:

<pre>
poem_id/doc_id (詩碼/文檔碼)
  line_id (行碼)
    segment_id (句碼)
	  char_id (字碼)
</pre>

A member of a suite, on the other hand, has a separate member_id (首碼):

<pre>
doc_id (文檔碼)
  member_id (首碼)
    line_id (行碼)
      segment_id (句碼)
	    char_id (字碼)
</pre>

When dealing with a non-suite 詩, its poem_id and doc_id are identical. For example, both the doc_id and poem of 《望嶽》 in the default version (默認版本) is `0003`. But a member of a suite has dictinct doc_id and poem_id. For example, `0013` is the doc_id of the default version of 《題張氏隱居二首》, whereas `0013-1` is the poem_id of the first member of this suite.

---

## Paths

Tree paths can be used to refer to units of a 詩. For example:

- 0003 refers to 《望嶽》
- 0003,3 refers to 「岱宗夫如何。齊魯青未了。」
- 0003,3,1 refers to 「岱宗夫如何」
- 0003,3,1,2 refers to 「宗」
- 0013,1 refers to 《題張氏隱居二首》其一
- 0013,2,13,2,1 refers to 「春」

To extend the concept of paths, the framework allows the scope notation. For example:

- 0003,3-4 refers to the third and fourth lines of 《望嶽》
- 0003,3,1,1-2 refers to 「岱宗」
- There is no need of 0003,3,1-2, because the shorter form 0003,3 is more preferable

---

## About 行 And 行碼

- For 詩s, one 行 contains no more than two 句s
- 行 corresponds roughly to 聯
- 行碼 is an artificial construct of the framework
- 行碼 is the physical line number of a document containing a text
- 行碼 facilitates easy location of a fragment of a long text; its design is mainly meant for human readers

---

## About Tree Paths

- Every fragment of 詩文 (excluding 詩題, 副題, 序, 注) is associated with a unique path, which can serve as the primary key of the fragment
- texts of a 杜著述 can also be treated in the same way (see 07 representing_wenfu)
- Mapping from paths to fragments can be used to generate index files for text location and retrieval
- Texts from 杜著述s (like 評論, 注釋) can also be associated with any 杜詩 fragment through tree paths
- When a text is associated with two paths, one indicating the source of the text, and the other indicating which fragment of 詩文 of 杜甫 it is associated with, the text can be extracted out of its larger container (context) and becomes independent
- Any amount of any texts from any 杜著述s, when each is associated with these two unique paths, can be thrown together without creating ambiguity

---

## Metadata

- The basic function of a metadata marker is to associate texts of 杜著述s to 詩, 文賦 of 杜甫
- The value of `scope` points to a node (could be a scope of more than one 字) in the tree of 默認版本
- The value of `src_path` points to the text tree of a 杜著述
- The value of `op` indicates the types of operation, the ways of attaching texts to the tree of 默認版本 (`insert`, `replace`, `graft`)