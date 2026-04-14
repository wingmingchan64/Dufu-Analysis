# Coordinate Terminology （By ChatGPT）

Status: Stable

---

## Purpose

This document defines the core terminology used in the coordinate system.

Its purpose is to ensure that all modules use the same terms with consistent meanings.

This document does not define syntax, semantics, or validation rules in detail.
It defines the vocabulary used to describe them.

---

## Coordinate

A **coordinate** is a structured address that identifies a position or segment in the canonical text.

- It represents a path in the text tree
- It may refer to a single unit or a range
- It is independent of metadata

---

## Path

A **path** is the hierarchical sequence of levels within a coordinate.

- Each component represents a position at a given level
- The full path identifies a location in the tree

A coordinate is a path with a defined syntax.

---

## Level

A **level** is a layer in the canonical text hierarchy.

Typical levels include:

- 文檔
- 段/章/闕
- 行
- 句
- 字

Levels are ordered from higher to lower.

---

## Unit

A **unit** is a structural element at a given level.

Examples:

- a specific 段/章/闕
- a specific 行
- a specific 句
- a specific 字

Units are the basic targets of coordinates.

---

## Granularity

**Granularity** refers to the lowest level reached by a coordinate.

Examples:

- 段/章/闕-level coordinate
- 行-level coordinate
- 句-level coordinate
- 字-level coordinate

Granularity determines the precision of addressing.

---

## Range

A **range** is a coordinate that represents multiple contiguous units at the same level.

- Defined by a start and an end
- Must be contiguous
- Must remain within a single parent structure

A range is not a collection of arbitrary units.

---

## Contiguity

**Contiguity** means that units are adjacent without gaps.

A valid coordinate or range must refer to a contiguous segment.

Non-contiguous selections must be expressed using multiple coordinates.

---

## Fragment

A **fragment** is the text returned by resolving a coordinate.

It may correspond to a single unit or a range
It is always contiguous
It is defined entirely by the coordinate

---

## Exact Coordinate

An **exact coordinate** refers to a fully specified coordinate that resolves deterministically to a segment.

- No ambiguity
- No interpretation required

Exact coordinates are the primary form used in the system.

---

## Structural Addressing

**Structural addressing** refers to locating text using partial or indirect information.

Examples:

- substring search
- pattern matching

Structural addressing produces candidate coordinates.

It is distinct from exact coordinates.

---

## Anchor

An **anchor** is a coordinate used as a reference point in another system, such as metadata.

- It must satisfy additional constraints beyond general coordinate validity
- It typically refers to a single position rather than a range

Anchor rules are defined by the system that uses them.

---

## Boundary

A **boundary** refers to the start or end position of a coordinate or range.

- Boundaries are inclusive
- A range includes both its start and end

---

## Canonical Text

The **canonical text** is the structured text to which coordinates apply.

- It is interpreted as a tree
- Coordinates are always defined relative to it

---

## Coordinate Space

The **coordinate space** is the set of all valid coordinates within a given canonical text.

- It is finite and structured
- It depends on the structure of the text

---

## Valid Coordinate

A **valid coordinate** is one that satisfies the required level of validation in a given context.

Depending on context, this may include:

- syntactic validity
- structural validity
- usability for a specific operation

Validity is always context-dependent.