# Text Addressing Principles （By ChatGPT）

Status: Stable

## Purpose

Text addressing defines how the canonical text is located, referenced, and retrieved.

It provides a formal system that maps between:

- `coordinates` → `text` (extraction)
- `text` → `coordinates` (search)

Text addressing operates independently of metadata and applies only to the canonical text.

## Scope

Text addressing is responsible for:

- Defining the coordinate system
- Defining valid addressable units (e.g., 行, 句, 字)
- Defining how ranges are expressed
- Enabling deterministic text extraction
- Supporting search from text to coordinates

Text addressing does **not**:

- Define metadata structures
- Encode semantic annotations
- Modify or transform the canonical text

---

## Canonical Text as a Tree

The canonical text is interpreted as a hierarchical tree.

Typical levels include:

- Work / Document
- 行 (line)
- 句 (phrase)
- 字 (character)

All coordinates refer to positions within this tree.

Text addressing assumes:

- The structure of the canonical text is fixed
- Each node has a well-defined position within the hierarchy

---

## Coordinates

A coordinate is a path that uniquely identifies a position in the canonical text.

A coordinate:

- Is expressed as a sequence of hierarchical indices
- May optionally include a range at the lowest level
- Refers to a **contiguous** segment within a single level

Coordinates must be:

- **Deterministic** — always resolve to the same text
- **Unambiguous** — represent a single path in the tree
- **Structure-based** — independent of punctuation or formatting variations

---

## Addressable Units

The system defines a closed set of addressable units.

Typical units include:

- 段/章/闕
- 行
- 句
- 字

Each unit:

- Has a clear structural definition
- Is independent of interpretation or usage
- Can be addressed directly or via ranges

Higher-level units must be decomposable into lower-level units.

## Ranges

Coordinates may include ranges at the lowest level.

A range:

- Must be contiguous
- Must stay within the same hierarchical level
- Cannot represent disjoint or mixed-level selections
- Underlyingly, a coordinate containing a range is represented as a set of coordinates

The interpretation of a range is purely structural.

---

## Extraction (coordinate → text)

Given a valid coordinate, the system must be able to:

- Retrieve the exact corresponding text segment
- Preserve the order and structure defined by the canonical text

Extraction must be:

- Deterministic
- Independent of metadata
- Independent of external context

---

## Search (text → coordinate)

The system supports mapping from text to coordinates.

Search may involve:

- Character-level indexing
- Phrase-level matching
- Structural constraints

Search results must:

- Return valid coordinates, or an empty string if nothing is found
- Correspond to actual segments in the canonical text

Search strategies may evolve, but must not violate the coordinate system.

---

## Structural vs Exact Addressing

Two forms of addressing may be distinguished:

- **Exact addressing**
	- Refers to a specific coordinate
	- Fully determined by the coordinate system
- **Structural addressing**
	- Refers to text based on structural patterns or partial information
	- May produce one or more candidate coordinates

Structural addressing is a layer built on top of exact addressing.

---

## Invariants

The following invariants must always hold:

- Every valid coordinate maps to exactly one text segment
- Every extracted text segment corresponds to a valid coordinate
- Coordinates do not depend on metadata
- Coordinates remain stable as long as the canonical text structure is unchanged

---

## Relationship to Metadata

Text addressing provides the foundation for metadata.

- Metadata references coordinates defined here
- Text addressing does not interpret metadata

The two systems are strictly separated but connected through coordinates.

---

## Design Principles

Text addressing follows these principles:

- **Structure-first**
	- Addressing is based on the text tree, not surface text
- **Determinism**
	- The same coordinate always yields the same result
- **Closure**
	- Addressable units and coordinate forms are from a closed set
- **Independence**
	- Addressing does not depend on metadata or external systems
	
---

## Evolution

The coordinate system and addressing rules are expected to remain stable.

Extensions should:

- Preserve backward compatibility
- Avoid redefining existing coordinates
- Maintain consistency with the canonical text structure

Any change that breaks these properties should be treated as a fundamental redesign.