# System Layers

Status: Stable

---

## Purpose

This document defines the conceptual layers of the system.

It describes how different components are organized and how they depend on each other.

---

## Overview

The system is organized as a set of layered components:
<pre>
Source Text
  ↓
Canonical Text
  ↓
Text Addressing
  ↓
Metadata
  ↓
Derived Data
  ↓
Views
</pre>
Each layer builds on the layers below it.

---

## Source Text

The source text is the only editable input.

- Stored as plain text (`.txt`)
- Maintained manually
- Serves as the origin of all data

No structured data is edited directly.

---

## Canonical Text

The canonical text is the structured interpretation of the source text.

- Modeled as a tree
- Defines structural units (段/章/闕, 行, 句, 字)
- Provides the base for addressing

All higher layers depend on this structure.

---

## Text Addressing

Text addressing defines how the canonical text is accessed.

- Provides coordinates
- Enables extraction and search
- Operates independently of metadata

It is the interface to the canonical text.

---

## Metadata

Metadata attaches structured information to the text.

- Uses coordinates defined by text addressing
- Encodes annotations, references, and classifications
- Does not modify the canonical text

Metadata depends on text addressing.

---

## Derived Data

Derived data consists of generated structures.

Examples:

- JSON representations
- indices
- mappings

Derived data:

- is generated programmatically
- is not manually edited
- can be regenerated at any time

---

## Views

Views are representations derived from structured data.

Examples:

- reconstructed texts
- aggregated annotations
- analytical outputs

Views are not sources; they are results.

---

## Workflow Layer

The workflow layer consists of programs and pipelines that connect all layers.

- transforms source text into structured data
- applies metadata
- generates derived data and views

The workflow must be reproducible.

---

## Dependency Rules

The system follows strict dependency rules:

- Each layer depends only on lower layers
- No layer may redefine a lower layer
- No circular dependencies are allowed

This ensures consistency and maintainability.

---

## Separation of Concerns

Each layer has a distinct responsibility:

- Source Text — editable content
- Canonical Text — structure
- Text Addressing — location
- Metadata — meaning
- Derived Data — representation and mapping
- Views — presentation

Mixing responsibilities across layers is discouraged.

---

## Stability Strategy

Different layers have different stability levels:

- Lower layers (text, addressing) are highly stable
- Middle layers (metadata) may evolve
- Upper layers (views) are flexible

This allows the system to grow without breaking its foundation.