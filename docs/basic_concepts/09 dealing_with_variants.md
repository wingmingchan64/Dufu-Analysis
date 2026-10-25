# Dealing with Variants (異文)

## Scope of 異文 in This Discussion

This discussion concerns textual differences between two versions of a work directly attributed to the same author, in this case, 杜甫.

The following conditions are assumed:

- The two versions have the same tree structure and the same set of tree paths
- Each path identifies one character in each version.
- A variant occurs when the same path is associated with different characters in the two versions

---

## 默認版本 (The Default Version)

- The 默認版本 serves as the starting point for comparison
- The term 默認版本 does not imply that the version is standardized, authoritative, or necessarily correct
- Its set of path-character pairs is denoted by A

---

## 杜著述版本

- A 杜著述 is a work that annotates or discusses Du Fu's writings, life, or related subjects
- When a 杜著述 contains a version of a poem or prose work by Du Fu, that text can be compared with the 默認版本
- An example is 王洙本《杜工部集》
- The set of path-character pairs of the version under comparison is denoted by B

---

## The Intersection and Difference of Two Versions

A version can be represented as a set of (path, character) pairs.

Although the text itself is ordered, the order is determined by the paths rather than by the set.

For two versions A and B with identical sets of paths:

- A ∩ B contains the path-character pairs common to both versions
- A − B contains the path-character pairs belonging to A but not B
- B − A contains the path-character pairs belonging to B but not A

Therefore:

[
A=(A\cap B)\cup(A-B)
]

[
B=(A\cap B)\cup(B-A)
]

---

## Generating Version B

- Given A as the starting point, only the differences in B − A need to be stored to reconstruct B
- Under the assumptions stated above, each pair in B − A specifies a path and its corresponding character in B
- Version B can therefore be represented relative to A by B − A
- These differences can be applied as character replacements to generate B
- There is no need to store the complete version B separately

---

## Listing More Than One Version

- Multiple versions, such as A, B, and C, can be displayed side by side.
- Only one complete base version A is required
- Other versions can be reconstructed from A and their respective differences, such as B − A and C − A, provided that the assumptions of this discussion are satisfied