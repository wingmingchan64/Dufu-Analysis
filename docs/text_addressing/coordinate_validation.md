# Coordinate Validation

Status: Stable

---

## Purpose

This document defines how coordinates are validated in the system.

Validation is the process of determining whether a coordinate is not only syntactically well-formed, but also acceptable and usable within a given canonical text.

This document stands between:

- **coordinate syntax** — whether a coordinate is well-formed as a string
- **coordinate semantics** — what a valid coordinate means

---

## Levels of Validation

Coordinate validation consists of multiple levels.

### Syntactic Validation

This checks whether a coordinate conforms to the required string format.

Examples:

- correct separators
- correct number structure
- valid range syntax

A coordinate that fails syntactic validation is invalid in all contexts.

### Structural Validation

This checks whether the coordinate is compatible with the structure of the canonical text.

Examples:

- the referenced document exists
- the referenced levels exist
- the path is complete enough for the system
- a range stays within the same structural parent

A syntactically valid coordinate may still fail structural validation.

### Usability Validation

This checks whether the coordinate is acceptable for a specific operation or module.

Examples:

- whether the coordinate can be used as an anchor
- whether the coordinate has the required granularity
- whether the coordinate is allowed in a given metadata field
- whether the coordinate refers to a supported unit

A structurally valid coordinate may still be unusable in a specific context.

---

## Validation Targets

Validation may apply to different kinds of coordinate-related values.

Typical targets include:

- exact coordinates
- range coordinates
- anchor values
- coordinate references embedded in metadata

Each target may have additional constraints.

---

## Syntactic Validity

A coordinate is syntactically valid if it satisfies the rules defined in coordinate_syntax.md.

This includes:

- correct separators
- valid integer components
- valid range form
- canonical string form where required

Syntactic validity does not require that the coordinate actually exists.

---

## Structural Validity

A coordinate is structurally valid if it refers to a real position or segment in a specific canonical text.

This requires that:

- the document identifier is recognized
- each hierarchical level exists
- the coordinate resolves to an actual node or segment
- any range is contiguous and remains within one level

Structural validity is always evaluated against a specific canonical text.

A coordinate cannot be structurally valid in the abstract.

---

## Completeness Requirements

Some operations require coordinates to be complete to a specific depth.

For example:

- a character-level operation may require a full path down to 字
- a line-level operation may accept a coordinate ending at 行

Therefore, validation must consider not only whether a coordinate exists, but whether it is complete enough for its intended use.

---

## Range Validation

A range coordinate is valid only if:

- it is syntactically well-formed
- both boundaries exist
- the start boundary does not exceed the end boundary
- both boundaries belong to the same parent structure
- the resulting segment is contiguous

Ranges that cross structural boundaries are invalid.

---

## Anchor Validation

An anchor is a coordinate value used as a reference point in another system, such as metadata.

Anchor validation may impose stricter rules than general coordinate validation.

For example, an anchor may require:

- a specific granularity
- a non-range coordinate
- a coordinate whose endpoint is the final addressed unit
- compatibility with a specific document or dataset

Thus:

- a coordinate may be valid
- but not valid as an anchor

Anchor rules must be defined explicitly by the module that uses them.

---

## Context Dependence

Validation is context-sensitive.

The same coordinate may be:

- syntactically valid
- structurally valid in one text
- invalid in another text
- usable for one operation
- unusable for another

Validation must always state the context in which it is performed.

---

## Validation Outcomes

Validation should produce explicit outcomes.

Typical outcomes include:

- **invalid syntax**
- **invalid structure**
- **invalid range**
- **unsupported granularity**
- **invalid for this operation**
- **valid**

Validation should fail early and clearly whenever possible.

---

## Relationship to Extraction

Validation must precede extraction.

A coordinate should not be used for extraction unless it has passed the required level of validation.

This ensures that extraction remains deterministic and safe.

---

## Relationship to Metadata

Metadata may depend on stricter coordinate validation rules.

For example:

- some metadata fields may require anchors
- some fields may allow ranges
- some fields may require coordinates at a fixed level

These are metadata-level constraints built on top of coordinate validation.

Coordinate validation itself does not define metadata policy.

---

## Invariants

The following invariants must hold:

- invalid syntax always implies invalid coordinate
- structural validation depends on a specific canonical text
- usability validation depends on a specific operation or module
- validation rules must not contradict coordinate semantics

---

## Design Principles

Coordinate validation follows these principles:

- **Layered validation**
	- syntax, structure, and usability must be distinguished
- **Context awareness**
	- validation must specify the text and operation involved
- **Early failure**
	- invalid values should be rejected as early as possible
- **Determinism**
	- the same validation context should always produce the same result