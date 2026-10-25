# Empty Trees and Tree Skeletons (樹骨架)

## Empty Tree

A text tree can be separated into two components: its structure and its textual content.

For example, 《八陣圖》 can be represented as:

<pre>
{
    "3572": {
        "詩題": "八陣圖",
        "3": {
            "1": {
                "1": "功",
                "2": "蓋",
                "3": "三",
                "4": "分",
                "5": "國"
            },
            "2": {
                "1": "名",
                "2": "成",
                "3": "八",
                "4": "陣",
                "5": "圖"
            }
        },
        "4": {
            "1": {
                "1": "江",
                "2": "流",
                "3": "石",
                "4": "不",
                "5": "轉"
            },
            "2": {
                "1": "遺",
                "2": "恨",
                "3": "失",
                "4": "吞",
                "5": "吳"
            }
        }
    }
}
</pre>

When the textual content is stripped away, the remaining structure is an **empty tree**.

For example, the following is a schematic representation of part of the empty tree (not valid JSON):

<pre>
{
    "3572": {
        "詩題",
        "3": {
            "1": {
                "1",
                "2",
                "3",
                "4",
                "5"
            },
            "2": {
                "1",
                "2",
                "3",
                "4",
                "5"
            }
        },
        "4": {
            "1": {
                "1",
                "2",
                "3",
                "4",
                "5"
            },
            "2": {
                "1",
                "2",
                "3",
                "4",
                "5"
            }
        }
    }
}
</pre>

---

## Flat Text Tree

The textual content can be stored separately in a flat text tree:

<pre>
{"3572":{"1":"八","2":"陣","3":"圖","4":"功","5":"蓋","6":"三","7":"分","8":"國","9":"名","10":"成","11":"八","12":"陣","13":"圖","14":"江","15":"流","16":"石","17":"不","18":"轉","19":"遺","20":"恨","21":"失","22":"吞","23":"吳"}}
</pre>

The numeric keys preserve the sequential order of the characters, independently of their positions in the hierarchical text tree.

---

## Tree Skeletons

A **tree skeleton** is a compact representation of the structure of a text tree.

For a non-suite 詩, the skeleton has two structural levels: 詩 and 行. For a 組詩, it has three: 詩, 首, and 行.

Each line is represented by an array of integers specifying the number of characters in each segment. Segment IDs and character IDs are generated from their sequential positions and do not require additional array levels in the skeleton.

The concept of 段 introduces an additional structural level when representing 文賦.

To describe the empty tree of 《八陣圖》:

- In the 默認版本, for a non-suite poem without a preface (序), the first two segments of the poem appear on physical line 3
- 《八陣圖》 is a 五絕, represented here by two physical lines, each containing two five-character segments
- Its empty tree can therefore be represented by the following skeleton:

<pre>
[[3],
 [5,5],
 [5,5]
]
</pre>

This skeleton describes the following structure:

- The first three characters form the 詩題
- The poem has two physical lines, each containing two segments
- The first line has line_id `3`
- Each segment in that line contains five characters

The skeleton specifies the structural arrangement and sizes of textual units. Node identifiers, including physical line numbers, are assigned according to the framework's addressing conventions and the source text layout.

When a skeleton describes a 組詩, it includes an additional layer corresponding to the individual member poems.

For example, the skeleton of 《江頭五詠》 is:

<pre>
[[4],
  [
    [2],
	[5,5],
	[5,5],
	[5,5],
	[5,5]
  ],
  [
    [2],
	[5,5],
	[5,5],
	[5,5],
	[5,5]
  ],
  [
    [2],
	[5,5],
	[5,5],
	[5,5],
	[5,5]
  ],
  [
    [2],
	[5,5],
	[5,5],
	[5,5],
	[5,5]
  ],
  [
    [2],
	[5,5],
	[5,5],
	[5,5],
	[5,5]
  ]
]
</pre>

- [4] represents the four-character 詩題
- represents a two-character 副題, such as 「丁香」
- 首碼 is determined by the order of the member poems
- Each member poem has four physical lines, each containing two five-character segments
- Physical line numbers are determined from a map containing structural information about the 組詩, including line numbers and 副題

---

## Empty Tree and Tree Skeleton Generation

Once a source text file has been manually prepared according to a predefined format, the tree skeleton, empty tree, and text tree can all be generated programmatically.

---

Revised by ChatGPT