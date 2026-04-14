# Metadata Terminology

Status: Stable

---

## Purpose

This document defines the core terminology used in the metadata system.

It ensures that metadata-related concepts are used consistently across the system.

This document does not define metadata syntax or processing logic.
It defines the vocabulary used to describe them.

---

## Metadata

**Metadata** is structured information attached to the canonical text.

- It is external to the text
- It does not modify the canonical text
- It is anchored to text using coordinates

---

## Annotation

An **annotation** is a single metadata entry.

- It represents one unit of information
- It may include content, references, or classification
- It is the basic element of metadata

---

## Attachment

**Attachment** refers to the relationship between metadata and text.

- Metadata is attached to text via coordinates
- The attachment does not alter the text itself

---

## Anchor

An **anchor** is the reference point where metadata is attached.

- It is a coordinate
- It identifies a specific position in the canonical text
- It must satisfy anchor-specific validation rules

An anchor is not the same as a range.

---

## Target

A **target** is the text segment that a metadata entry refers to.

- It may be the same as the anchor
- It may be a range derived from the anchor
- It is defined using coordinates

---

## Scope

**Scope** defines the extent of text affected or covered by a metadata entry.

- It is expressed as a coordinate or range
- It must be contiguous
- It operates within the coordinate system

Scope is a semantic concept built on top of coordinates.

---

## Source

The **source** identifies where a metadata entry originates.

It may include:

- work identifier
- document identifier
- position within the source text

Source is independent of the canonical text structure.

---

## Key

A **key** is a named attribute in a metadata entry.

Examples:

- category
- reference
- type

Keys are drawn from a controlled set.

---

## Value

A **value** is the content associated with a key.

- It may be a string, number, or structured object
- It may reference coordinates or external data

Values must conform to the constraints defined for their keys.

---

## Category

A **category** is a classification label assigned to a metadata entry.

- It describes the functional role of the entry
- It is not a free-form tag
- It belongs to a closed set

---

## Type

A **type** defines a specific usage or selection within metadata.

- It is used for filtering or grouping
- It is distinct from category

---

## Entry Structure

A **metadata entry structure** is the set of keys and values that define an annotation.

- It may vary depending on category or type
- It must remain internally consistent

---

## Metadata Set

A **metadata set** is a collection of annotations.

- It may correspond to a document, work, or dataset
- It is typically stored in structured form (e.g., JSON)

---

## Valid Metadata

Valid metadata must satisfy:

- coordinate validation (for anchors and scopes)
- key constraints
- value constraints
- structural consistency

Validity is defined by the metadata system, not by coordinates alone.