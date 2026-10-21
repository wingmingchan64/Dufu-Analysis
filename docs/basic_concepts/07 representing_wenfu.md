# Representing 文賦

## The Relevance Of 段 In 文賦

- The concept of 段 is useful in the context of 文賦
- Both 段 and 行 are artificial constructs of the framework

---

## Hierarchical Structures of 文賦

A 文 or 賦 can be analyzed in terms of:

- 篇名
- 題注
- 序
- 段
- 行
- 句
- 字

---

## Trees

- A 文 or 賦, when represented as a tree, can have either a flat structure or a hierarchical structure
- The framework uses both
- The flat structure makes modification of the text easy, especially when two versions of the same 文 or 賦 has large number of differences
- chunks of texts can easily be added, deleted, or replaced, without the need of using hierarchical paths
- hierarchical structure, on the other hand, facilitate text location, and attachment of annotations, comments, etc.

A flat structure have the following configuration:
<pre>
doc_id (文檔碼)
  char_id (字碼)
</pre>

A hierarchical structure have the following configuration:
<pre>
doc_id (文檔碼)
  paragraph_id (段碼)
    line_id (行碼)
      segment_id (句碼)
	    char_id (字碼)
</pre>

---

## Paths

Tree paths can be used to refer to units of a 文 or 賦. 

- A 字 in a 文 or 賦 has two distinct ids
  - doc_id,char_id
  - doc_id,paragraph_id,line_id,segment_id,char_id
- When making text changes, either path can be used, depending on which one is easier to handle
- When attaching additional information, the hierarchical structure is used