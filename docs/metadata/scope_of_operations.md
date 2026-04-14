# Scope of Operations （By ChatGPT）

Status: Stable

---

## Purpose

This document defines how **scope** is used in metadata.

It specifies how text segments are selected, combined, and constrained when attaching metadata.

Scope is built on top of the coordinate system and must respect its properties.

---

## Definition of Scope

A **scope** is the text segment to which a metadata entry applies.

- It is expressed as a coordinate or a coordinate range
- It must resolve to a contiguous segment
- It operates entirely within the canonical text

Scope defines **where** a metadata entry is valid.

---

## Contiguity Requirement

All scopes must be contiguous.

- A scope must correspond to a single continuous segment
- Non-contiguous selections are not allowed within a single scope

Non-contiguous relationships must be expressed using multiple scopes or metadata-level structures.

---

## Granularity Principle

Scope selection follows a granularity principle:

>Use the smallest possible scope that fully expresses the intended meaning.
If the meaning cannot be expressed at that level, use a larger enclosing scope.

This ensures:

- precision where possible
- structural consistency where necessary

---

## Scope Segmentation

When multiple scopes are used within a single annotation, they must satisfy:

- Each scope is contiguous
- Scopes must not partially overlap

For any two scopes A and B:

- either A and B are disjoint, or
- one fully contains the other

Partial overlap without containment is not allowed.

---

## Containment

A scope may fully contain another scope.

Containment may occur:

- within the same level (e.g., range within range)
- across levels (e.g., 行 containing 字)

Containment is valid and does not violate scope constraints.

---

## Prohibition of Partial Overlap

The following pattern is not allowed:

A: 2–4
B: 3–5

Such scopes:

overlap
but neither contains the other

This creates ambiguity and is prohibited.

---

## Structural Consistency

Scope relationships must preserve a tree-like structure:

- scopes may form a hierarchy (nesting)
- or remain separate (disjoint)

They must not form arbitrary overlapping graphs.

---

## Relationship to Addressing

Scope is defined using coordinates.

Therefore:

- all scope constraints depend on coordinate semantics
- scope cannot violate contiguity or structural rules of coordinates

Scope does not extend the coordinate system; it uses it.

---

## Relationship to Metadata Semantics

Scope defines coverage, not meaning.

- It specifies where metadata applies
- It does not define how metadata is interpreted

Additional semantic relationships (e.g., correspondence, contrast) must be expressed separately.

---

## Non-Contiguous Semantics

Some meanings involve non-contiguous elements.

These must not be expressed by a single scope.

Instead, they should be represented using:

- multiple scopes, or
- additional fields within metadata

Example:
<pre>
{
  "scope": "0003:3.1.1-5",
  "focus": ["0003:3.1.1", "0003:3.1.5"]
}
</pre>
---

## Escalation Strategy

When a concept cannot be expressed using a contiguous scope at a given level:

- move to a higher-level scope
- use that scope as the base
- express finer relationships separately

In the extreme case, scope may extend to the entire document.

---

## Invariants

The following must always hold:

- every scope is contiguous
- no partial overlap is allowed between scopes
- scope relationships form a tree structure
- scope is always representable as coordinates

---

## Design Principles

Scope of operations follows these principles:

- **contiguity**
	- no fragmented segments
- **minimality**
	- prefer the smallest valid scope
- **hierarchy**
	- allow nesting, disallow crossing
- **separation**
	- structure (scope) and meaning (metadata) are distinct