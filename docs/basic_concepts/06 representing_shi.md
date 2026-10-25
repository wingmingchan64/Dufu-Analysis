# Representing 詩

## The Relevance of 段 in 詩

- The concept of 段 is of limited use in the default representation of 詩
- In the framework's default representation, each 詩 is treated as a single 段
- Some 杜著述, such as 仇兆鰲《杜詩詳註》, divide poems into interpretive sections
- Such divisions belong to the organizational or interpretive structure of the particular 杜著述, rather than to the default representation of Du Fu's poems

---

## Hierarchical Structures of 詩

A 詩 can be analyzed in terms of various textual units, including:

- 詩題
- 題注（杜甫自注）
- 序
- 聯
- 句
- 字（言）

Important points:

- 詩題, 聯, 句, and other such units are traditional concepts, not concepts invented by the framework
- These units do not necessarily correspond to separate levels in every text tree
- Dividing a 詩 into smaller units facilitates text location, retrieval, and the attachment of additional texts

---

## Suites

A 組詩 (suite) can be treated as an ordered collection of 詩, grouped under a common 詩題. Each member of the suite may have its own 副題.

---

## Trees

A 詩 can be represented as a tree with the following structure:

<pre>
poem_id/doc_id (詩碼/文檔碼)
  line_id (行碼)
    segment_id (句碼)
	  char_id (字碼)
</pre>

A member of a suite has an additional member_id (首碼):

<pre>
doc_id (文檔碼)
  member_id (首碼)
    line_id (行碼)
      segment_id (句碼)
	    char_id (字碼)
</pre>

For a non-suite 詩, its poem_id and doc_id are identical. For example, both the doc_id and poem_id of 《望嶽》 in the default version (默認版本) are `0003`.

A member of a suite, however, has distinct doc_id and poem_id values. For example, `0013` is the doc_id of the default version of 《題張氏隱居二首》, whereas `0013-1` is the poem_id of the first member of the suite.

---

## Paths

Tree paths can be used to identify textual units in a 詩. For example:

- 0003 refers to 《望嶽》
- 0003,3 refers to 「岱宗夫如何。齊魯青未了。」
- 0003,3,1 refers to 「岱宗夫如何」
- 0003,3,1,2 refers to 「宗」
- 0013,1 refers to 《題張氏隱居二首》其一
- 0013,2,13,2,1 refers to 「春」

The framework extends tree paths with scope notation to identify ranges of textual units. For example:

- 0003,3-4 refers to the third and fourth lines of 《望嶽》
- 0003,3,1,1-2 refers to 「岱宗」
- 0003,3,1-2 is unnecessary because the shorter form 0003,3 is preferable

---

## About 行 And 行碼

- In the default representation of 詩, one 行 contains no more than two 句
- 行 corresponds roughly to 聯
- The framework uses the physical line number in the source text file as 行碼
- This convention facilitates the location of textual fragments, particularly in long texts, and is primarily intended to help human readers

---

## About Tree Paths

- Each node in a text tree has a unique path within that tree
- A path, optionally extended with scope notation, can identify a textual unit or a range of textual units
- Texts of 杜著述 can be represented and addressed in the same way (see 08 Representing 文賦)
- Mappings from paths to textual fragments can be used to generate index files for text location and retrieval
- Texts from 杜著述, such as 評論 and 注釋, can be associated with fragments of Du Fu's 詩文 through tree paths
- A text from a 杜著述 can be associated with two paths: one identifying its location in its source text tree, and another identifying the fragment of Du Fu's 詩文 to which it relates
- These two references allow the text to be extracted from its original context and handled independently while preserving its source and target relationships
- Texts from different 杜著述 can then be combined without ambiguity, provided that their source and target references are uniquely identifiable

---

## Metadata

The primary function of metadata markers in this context is to associate texts from 杜著述 with Du Fu's 詩 and 文賦.

- scope: Identifies a node or a range of textual units in the text tree of the 默認版本
- src_path: Identifies the source text in the text tree of a 杜著述
- op: Specifies how the source text is to be incorporated into the resulting structure, using operations such as `insert`, `replace`, and `graft`

---

Revised by ChatGPT