# Dufu-Analysis (By ChapGPT)

Dufu-Analysis is the analysis/build repository of my long-term Du Fu project.

This repo focuses on **structured data**, **metadata**, **indexes**, and **build tools** derived from source materials (stored elsewhere, mainly in the `DuFu` repo). Instead of generating a huge amount of fixed annotated texts up front, the project emphasizes:

- organic **decomposition** of source materials into computable units
- incremental **tagging** (metadata) and classification
- reproducible **build pipelines**
- on-demand **recomposition** into different “views” (appearances)

In short: **a text-as-tree system + attachable metadata + multiple generated views**.

---

## Core ideas

### 1) Text as an ordered tree
A poem is modeled as a finite-depth ordered tree:

- root: poem
- level 1: line (聯 / 行)
- level 2: segment (句) — a structural segment within a line (not “sentence”)
- level 3: character

A coordinate (anchor) is a **path** from root to a node, e.g.:

- `〚0456:3.2.1〛` = poem 0456 → line 3 → segment 2 → char 1
- range anchors exist (continuous ranges only), e.g. `〚0003:3-5〛`

### 2) Metadata as attachable “decorations”
Annotations (variants, notes, comments, citations, etc.) are modeled as objects attached to anchor points.

A metadata record:
- must embed its anchor(s)
- must be semantically related to the anchor
- is not meant to replace the base text, but to highlight properties of the text

### 3) Views as “appearances”
Different traversal / rendering strategies produce different views, for example:
- inline long notes (classical editions look)
- inline short glosses (interlinear notes)
- numbered notes collected after the poem
- one-line-base-text + many notes inserted between lines (optimized for comparison across editions)

Views are generated artifacts: they can be rebuilt at any time.

---

## Identity (IDs)

This project is identity-driven.

Common IDs:

- `edition_prefix` : edition abbreviation, e.g. `全`, `蕭`, `郭`
- `document_id`    : document container id within an edition, e.g. `0098`
- `poem_id`        : single-poem id (may be a group member), e.g. `0098-1`
- `doc_id`         : global document id, e.g. `全0098` (document)
- `canonical_poem_id` : poem id in the canonical/base-text layer
- `a`, `b_a`: anchors on the poem tree
- `sid` : source id of an edition in the metadata layer, e.g. `郭0001:P0001L03:33b2683d2d47`
- `anchor` : page and line numbers of the source, e.g. `P0001L03`

**IDs identify objects (containers/poems/records). Anchors identify positions on the poem tree or in the edition.**

---

## Repository roles

### Relationship to `DuFu`
- `DuFu` stores source materials (including my own input and cleaned texts).
- `Dufu-Analysis` stores:
  - build code (PHP/Python tools)
  - derived JSON structures (schemas/base_text, mappings, registries)
  - indexes
  - experimental view generators
  - tests

All JSON files in this repo are **generated** from source text + build scripts.

---

## Data outputs (high-level)

Typical generated outputs include:
- base_text shards (canonical layer)
- edition catalogs and mapping tables
- metadata by document id
- inverted indexes by category/tags/keywords
- generated views (txt/json/md), when enabled

---

## Build and tests

This repo uses automated build scripts to regenerate JSON artifacts and automated tests to ensure invariants (IDs, anchors, mappings, etc.) remain consistent.

(Implementation details and commands are documented under `tools/` and `tests/`.)

---

## Status

The system is actively evolving. Metadata can be added incrementally:

start with a few categories (e.g. variants and notes), then expand without breaking existing data.

---

## Site Map （我加的部分）

- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/schemas/json/base_text">基準正文樹</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/schemas/json/coords">坐標表</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/schemas/json/registry">術語、規則說明</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/packages">注本資料</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/tools/php">PHP Controller</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/tests/php">PHP Test Programs</a>
- Python Controller (to come)
- Python Test Programs (to come)

### 注本資料內部結構：郭知達《新刊校定集注杜詩》
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/packages/%E9%83%AD%E7%9F%A5%E9%81%94%E3%80%8A%E6%96%B0%E5%88%8A%E6%A0%A1%E5%AE%9A%E9%9B%86%E6%B3%A8%E6%9D%9C%E8%A9%A9%E3%80%8B/catalog">目錄</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/packages/%E9%83%AD%E7%9F%A5%E9%81%94%E3%80%8A%E6%96%B0%E5%88%8A%E6%A0%A1%E5%AE%9A%E9%9B%86%E6%B3%A8%E6%9D%9C%E8%A9%A9%E3%80%8B/metadata">後設資料</a>
- <a href="https://github.com/wingmingchan64/Dufu-Analysis/tree/main/packages/%E9%83%AD%E7%9F%A5%E9%81%94%E3%80%8A%E6%96%B0%E5%88%8A%E6%A0%A1%E5%AE%9A%E9%9B%86%E6%B3%A8%E6%9D%9C%E8%A9%A9%E3%80%8B/samples">View 樣本</a>
<!--
- <a href=""></a>
- <a href=""></a>
-->