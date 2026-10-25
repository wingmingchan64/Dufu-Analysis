# Representing 文賦

## The Relevance of 段 in 文賦

- The concept of 段 is useful in the representation of 文賦
- Paragraph and line divisions may be introduced editorially to facilitate reading, text location, and annotation
- Line IDs correspond to the physical line numbers in the prepared source text file

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

A 文 or 賦 can be represented as either a flat tree or a hierarchical tree. The framework uses both representations.

The flat structure allows textual content to be edited independently of its hierarchical organization. This is particularly useful when handling textual differences between versions.

Textual units can be inserted, deleted, or replaced without relying on hierarchical paths.

The hierarchical structure, on the other hand, facilitates text location and the attachment of annotations, comments, and other information.

A flat structure have the following structure:

<pre>
doc_id (文檔碼)
  char_id (字碼)
</pre>

A hierarchical tree have the following structure:

<pre>
doc_id (文檔碼)
  paragraph_id (段碼)
    line_id (行碼)
      segment_id (句碼)
	    char_id (字碼)
</pre>

---

## Paths

Tree paths can be used to identify textual units in a 文 or 賦.

Each character has two distinct addresses, corresponding to its positions in the two representations:

- Flat address: doc_id,char_id
- Hierarchical address: doc_id,paragraph_id,line_id,segment_id,char_id

Corresponding characters in the flat and hierarchical representations of the same text can be identified through mappings between their respective addresses.

Textual changes may be specified using either form of address, with the appropriate mapping used when necessary.

When attaching annotations, comments, or other information to textual units, the hierarchical representation is used.

---

Revised by ChatGPT