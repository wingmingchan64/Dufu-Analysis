# Coordinate Syntax （By ChatGPT）

Status: Stable

## Purpose

This document defines the **syntactic form** of coordinates used in text addressing.

It specifies how coordinates are written, structured, and validated as strings.

This document does not define how coordinates are interpreted.

2. General Form

A coordinate is a sequence of components representing a path in the canonical text tree.

A typical coordinate has the form:

>&lt;doc_id>:&lt;level1>.&lt;level2>.&lt;level3>

Where:

`<doc_id>` identifies the document or work
<levelN> are hierarchical indices
3. Separators

The coordinate uses fixed separators:

: separates the document identifier from the structural path
. separates levels within the structural path
- denotes a range at the lowest level

These separators are reserved and must not be used for other purposes.

4. Components
4.1 Document Identifier
Appears at the beginning of the coordinate
Identifies the scope of the coordinate
Treated as an opaque string at the syntax level
4.2 Hierarchical Levels
Represent positions within the text tree
Each level is expressed as a positive integer
Levels are ordered from higher to lower in the hierarchy

Example:

0003:3.1.2
5. Ranges

A coordinate may include a range at the lowest level:

<doc_id>:<path>.<start>-<end>

Example:

0003:3.1.2-5

Rules:

A range can only appear at the lowest level
<start> and <end> must be integers
<start> ≤ <end>
6. Validity Rules

A syntactically valid coordinate must satisfy:

Correct use of separators (:, ., -)
No missing components
All level values are positive integers
At most one range, and only at the lowest level

This document does not validate whether the coordinate exists in the text.

7. Canonical Form

Coordinates should be written in a canonical form:

No extra whitespace
No leading or trailing separators
No redundant levels

Canonical form ensures consistent comparison and storage.

8. Examples

Valid:

0003:3.1.2
0003:3.1.2-5
LUNYU,01,1,3,2,4   (alternative format, if defined elsewhere)

Invalid:

0003::3.1.2        (double separator)
0003:3.1           (missing level, if required by system rules)
0003:3.1.5-2       (invalid range)
0003:3.1.2-3-4     (multiple ranges)
9. Extensibility

The syntax is designed to be stable.

Possible extensions must:

Preserve existing separators
Remain backward compatible
Avoid introducing ambiguity

Any extension should be defined explicitly and not inferred.