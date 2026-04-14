# Documentation Overview (By ChatGPT)

Status: Stable

This directory contains the design documentation for the Dufu-Analysis system.

The goal of this documentation is not only to describe the system, but to define a stable conceptual framework that supports long-term development, data generation, and future extensions.

## How to Read This Documentation

The documentation is organized in layers. A suggested reading order is:

### System Overview

- Start with `system_overview.md`
- This provides a high-level picture of the system: what the core components are, and how they relate to each other.

### Terminology

- See `terminology/`
- Defines basic concepts such as 行, 句, 字, 坐標 (coordinate), etc.
- These are the foundation for all other modules.

### Core Modules

- Read the modules according to your focus:
	- `text_addressing/` — how text is addressed and retrieved
	- `metadata/` — how information is attached to text
	- `architecture/` — system-level structures and relationships
	- `data/` — data formats and generated structures

### Workflow and Implementation
	- `workflow/` — data processing pipelines
	- `controller/` — how concepts map to actual programs and data generation

You do not need to read everything sequentially. Each module is designed to be readable independently once the basic terminology is understood.

---

## System Layers (Conceptual)

At a high level, the system can be understood as a set of layered components:

- **Canonical Text**
	- The base text, modeled as a structured tree
- **Text Addressing**
	- A coordinate system used to locate and extract text from the canonical tree
- **Metadata**
	- Structured information attached to specific locations or ranges in the text
- **Derived Data**
	- JSON structures, indices, and mappings generated from text and metadata
- **Views**
	- Reconstructed or presentation-oriented outputs derived from structured data
- **Workflow**
	- Pipelines and programs that transform source text into structured data and views

Each layer depends only on the layers below it.

---

## Module Boundaries

The main modules in this documentation are separated by responsibility:

- **text_addressing**
	- Defines how text is located
	- Includes coordinate syntax, semantics, and lookup strategies
	- Does *not* define metadata
- **metadata**
	- Defines how information is attached to text
	- Uses coordinates defined in text_addressing
	- Does *not* redefine addressing rules
- **architecture**
	- Describes system-wide structures and relationships
	- Does not contain low-level syntax or implementation details
- **data**
	- Defines data formats (e.g., JSON structures)
	- Focuses on representation, not conceptual rules
- **workflow / implementation**
	- Describes how data is produced
	- Maps concepts to actual scripts, pipelines, and processes

---

## Stability of Documents

Not all documents in this directory have the same stability.

Each document may be in one of the following states:

- **Stable**
	- Defines core principles or invariants
	- Changes are rare and deliberate
- **Provisional**
	- Describes current design decisions
	- May evolve as the system develops
- **Draft**
	- Exploratory or experimental ideas
	- Not yet part of the stable system

The status of a document is indicated at the top of each file.

---

## Source of Truth

The system follows a strict separation between editable sources and generated data:

- **Editable source**
	- Plain text (`.txt`) files
- **Generated data**
	- Coordinates, JSON structures, indices, and views

All structured data should be reproducible from source text and programs.

Manual modification of generated data is strictly prohibited. Any inconsistency should be resolved by fixing source text or generation programs, not by editing generated data.

---

## Purpose of This Documentation

This documentation serves several purposes:

- To define the conceptual model of the system
- To ensure consistency across modules
- To support implementation and maintenance
- To make future extensions possible without breaking existing structures

It is expected to evolve, but its structure and core principles should remain stable.