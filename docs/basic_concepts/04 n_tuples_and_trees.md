# N-Tuples and Trees

## Relationship between N-Tuples and Trees

N-tuples can be used to represent the addresses or paths of nodes in a rooted tree, provided that a consistent addressing scheme is defined.

In a common addressing scheme, each element of a tuple identifies a child of the preceding node:

- Root: Represented by the empty tuple ()
- Children of the Root: Represented by 1-tuples, such as (1), (2), and (3)
- Grandchildren: Represented by 2-tuples, such as (1, 1), (1, 2), and (2, 1)

In this scheme, each additional tuple element represents one step from a parent to a child. Consequently, the length of the tuple equals the depth of the corresponding node.

Other addressing schemes may use different conventions, in which case tuple length and node depth need not be equal.

---

## Important Distinctions

- Path：從根節點到目標節點所經過的結構路徑 (structural pathway from the root to the targeted node)
- Address：用來唯一識別節點的表示方式 (a means of uniquely identifying nodes)
- Coordinate：在某個約定的參照系統下表示位置的數值或標識組合 (within an agreed conventional locating system, a value or an identifier representing a location in a tree)

---

Source: Gemini (original draft, subsequently revised by ChatGPT)