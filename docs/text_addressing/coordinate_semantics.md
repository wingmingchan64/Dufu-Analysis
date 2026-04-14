# Coordinate Semantics （By ChatGPT）

Status: Stable

## Purpose

This document defines the **meaning and interpretation** of coordinates.

It specifies how a syntactically valid coordinate is mapped to the canonical text.

---

## Coordinates as Paths

A coordinate represents a **path in the canonical text tree**.

- Each level corresponds to a node in the hierarchy
- The full coordinate identifies a unique position or segment

A coordinate is not a label, but a structural address.

---

## Deterministic Mapping

A valid coordinate must map to exactly one text segment.

This mapping must be:

- Deterministic
- Independent of external context
- Independent of metadata

---

## Addressing Units

Coordinates ultimately resolve to structural units such as:

- 段/章/闕
- 行
- 句
- 字

The lowest level of a coordinate determines the granularity of the result.

---

## Range Semantics

A range represents a **contiguous segment at a single level**.

For example:

>0003:3.1.2-5

Means:

- From the 2nd unit to the 5th unit
- Within the same parent node
- Without skipping intermediate elements

Ranges:

- Do not cross structural boundaries
- Do not imply hierarchy changes

---

## Contiguity Constraint

All coordinates must refer to **contiguous segments**.

The system does not support:

- Disjoint selections
- Non-contiguous unions
- Cross-level aggregation within a single coordinate

Such cases must be represented using multiple coordinates.

---

## Independence from Surface Form

Coordinates are defined by structure, not by surface text.

Therefore:

- Punctuation is not part of the coordinate system
- Variations in formatting do not affect coordinates
- Equivalent text with different punctuation maps to the same coordinate

---

## Stability

Coordinates remain stable as long as the canonical text structure is unchanged.

Changes that may invalidate coordinates include:

- Re-segmentation of 行 / 句
- Insertion or deletion of structural units
- Reorganization of the text tree

Minor textual variations that do not affect structure do not change coordinates.

---

## Exact Addressing

A coordinate provides **exact addressing**:

- Fully determined
- Resolves to a single segment
- Requires no interpretation

Exact addressing is the foundation of all operations.

---

## Structural Addressing

Structural addressing refers to locating text based on partial or indirect information.

Examples:

- Searching by substring
- Matching by pattern
- Inferring position from context

Structural addressing:

- Produces one or more candidate coordinates
- Is not part of the coordinate system itself
- Depends on search strategies

---

## Boundary Interpretation

When a coordinate refers to a segment:

- The boundaries are inclusive
- The segment is defined entirely by the coordinate

No implicit expansion or contraction is allowed.

---

## Relationship to Metadata

Coordinates define where metadata attaches.

- Metadata uses coordinates as references
- Coordinates do not encode metadata meaning

This separation ensures:

- Stability of addressing
- Flexibility of metadata

---

## Invariants

The following must always hold:

- One coordinate → one contiguous segment
- One segment → can be represented by at least one coordinate
- Coordinates do not depend on metadata
- Coordinates are valid only within a specific canonical text

---

## Design Principles

- **Path-based addressing**
	- Coordinates represent positions in a tree
- **Contiguity**
	- All segments are continuous
- **Determinism**
	- No ambiguity in mapping
- **Separation**
	- Addressing and metadata are independent