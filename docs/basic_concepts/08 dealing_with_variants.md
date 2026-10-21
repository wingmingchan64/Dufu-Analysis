# Dealing With Variants (異文)

## Definition Of 異文

- Comparison of two different versions
- Only works directly attributed to the same author; in our case, 杜甫
- No structural differences (same set of tree paths)
- One tree path associated with two different 字 in two versions

---

## 默認版本 (The Default Version)

- The starting point of Comparison
- The term 默認版本 does not imply any connotation of standardization or correctness
- Referred as set A

---

## 杜著述版本

- Any works annotating 杜詩, 杜文賦, discussing the life of 杜甫, or any work related directly or indirectly to 杜甫
- When considering only 杜詩, 杜文賦, a 杜著述 can have variants (異文)
- Example: 王洙本《杜工部集》
- Referred as set B

---

## The Intersection And Difference Of Two Versions

- When 字s in a text is treated as an ordered set, two different versions (without structural differences) can have an intersection: the set of path:字 pairs
- Set A contains the intersection (A ∩ B) as well as (A - B); i.e., A = (A ∩ B) ∪ (A - B)
- Set B contains the intersection (A ∩ B) as well as (B - A); i.e., B = (A ∩ B) ∪ (B - A)

---

## Generating Version B

- Using A as the starting point, only (B - A) is needed
- Indeed, B can be seen as (B - A)
- (B - A) can be treated as modifications of A as well
- There is no need of storing B separately

---

## Listing More Than One Version

- It is possible to list versions A, B, C and so on side by side
- Only one A is needed, everything else are just (B - A), (C - A) and so on