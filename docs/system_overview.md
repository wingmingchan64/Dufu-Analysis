# System Overview (By ChatGPT)

Status: Stable

## Purpose

The *Dufu-Analysis* system is designed to transform classical Chinese texts into a structured, machine-readable form that supports precise addressing, metadata attachment, and reproducible data generation.

The system separates **editable source text** from **generated structured data**, and defines a consistent framework for connecting them.

---

## Core Model

The system is built around three fundamental components:

### Canonical Text

The canonical text is the base representation of a work.

- Stored in plain text (`.txt`)
- Interpreted as a structured tree
- Organized into hierarchical units such as 行 (line), 句 (segment), and 字 (character)

This tree is the foundation of all further operations.

### Text Addressing

Text addressing provides a way to locate and extract text from the canonical text.

Uses coordinates to represent positions within the text tree
Supports both single points and ranges
Enables mapping between:
coordinate → text (extraction)
text → coordinate (search)

Text addressing operates purely on the structure of the canonical text.

### Metadata

Metadata represents structured information attached to the text.

Attached to specific coordinates or ranges
Encodes annotations, variants, references, and other semantic information
Does not modify the canonical text itself

Metadata depends on text addressing for locating its targets.

---

## Derived Structures

From the combination of canonical text and metadata, the system generates structured data.

These include:

JSON representations
Indexes (e.g., character → coordinate)
Mappings between different versions or structures
Aggregated datasets

All derived structures are generated programmatically and are not edited manually.

---

## Views

Views are reconstructions or presentations of the text based on structured data.

Examples include:

Reconstructed editions
Aggregated annotations
Structured outputs for analysis

A view is not a source, but a result of applying rules to canonical text and metadata.

---

## Workflow

The system follows a reproducible pipeline:

.txt (source text)
  → canonical text tree
  → text addressing structures
  → metadata attachment
  → derived data (JSON, indexes, mappings)
  → views

Each step is implemented by programs and can be rerun to regenerate all outputs.

6. Source of Truth

The system enforces a strict rule:

The only editable source is the plain text (.txt)
All structured data must be derivable from source text and programs

This ensures consistency, reproducibility, and long-term maintainability.

7. Module Relationships

The main modules of the system are related as follows:

Canonical Text
defines the base structure
Text Addressing
defines how the text is accessed
Metadata
defines how information is attached
Data
defines how structures are represented
Workflow / Implementation
defines how structures are generated

Each module has a distinct responsibility and should not redefine the role of another.

8. Design Principles

The system follows several guiding principles:

Separation of concerns
text, addressing, and metadata are distinct layers
Reproducibility
all outputs must be regenerable from source
Stability at the foundation
basic structures (text tree, addressing) should remain stable
Extensibility
new metadata and views can be added without altering the base text
9. Scope

This system is designed to support:

Classical Chinese text analysis
Cross-edition comparison
Annotation and commentary integration
Structured data generation for further research

It is not limited to a single edition or work, but is intended to generalize across similar textual corpora.