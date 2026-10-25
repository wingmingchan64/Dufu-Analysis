# Dealing with Annotations (注釋) Etc.

## 杜著述

- 杜著述 containing annotations, comments, and other supplementary materials can be handled using a principle similar to that used for textual variants (異文)
- Let A represent the 默認版本 and B represent a 杜著述 containing Du Fu's text together with additional material
- The additional material contributed by B can be regarded conceptually as B − A, provided that the two are represented in a form suitable for comparison
- The 默認版本 is represented as a hierarchical text tree
- Additional material can be associated with nodes or ranges of nodes in this tree through metadata

---

## Generating Version B

- Using A as the starting point, the additional material associated with B can be incorporated into a generated tree
- This material may include annotations, comments, and other texts not belonging to Du Fu's original work
- The hierarchical structure provides locations for attaching this material
- Source paths and metadata relationships preserve the provenance and intended placement of the additional texts
- There is no need to store a separate, fully assembled version B, provided that its source texts and the information required for reconstruction are preserved

---

## Combining Multiple 杜著述

- Texts from any number of 杜著述 can be associated with the same 默認版本 tree
- Their source identities and metadata relationships allow them to be distinguished and organized in different ways