# Transformation Constraints

This section defines the formal constraints of the transformation system used in the metadata architecture.

---

## 1. Source Tree Exclusivity

All coordinates, anchors, and scope definitions are valid only with respect to the base text tree.

They are used to identify positions or structures in the base text tree prior to transformation.
Once transformation begins, the resulting tree is no longer guaranteed to preserve the coordinate system of the base text tree.

Therefore:

coordinates do not apply to transformed trees
transformed nodes are not required to inherit source coordinates
no reverse mapping from transformed tree to base coordinates is assumed by default
2. Single-Pass Transformation

A transformation consists of:

one base text tree
one metadata set
one execution pass

The system applies the metadata set to the base text tree exactly once to produce one transformed result.

Therefore:

a transformed tree is not used as the input of a second transformation
multiple metadata layers are not recursively applied within the same transformation process
the transformation engine is not a general-purpose iterative tree editor
3. No Metadata-on-Metadata Execution

The transformation engine operates only on the base text tree.

If an inserted subtree requires its own internal metadata processing, that processing must be completed before the subtree is used as payload in the current transformation.

Therefore:

the transformation engine does not interpret metadata embedded inside payload subtrees
payload subtrees are treated as already prepared objects
subtree construction and subtree insertion are two separate stages
4. Payload as Precompiled Subtree

Any subtree inserted during transformation must be provided as a complete and self-contained payload.

Its internal structure must already be determined before insertion.
The transformation engine only performs placement and integration, not internal construction.

This means:

payload is an input object, not an executable instruction set
the engine does not modify payload structure unless explicitly required by the current operation
payload may represent text blocks, commentary sections, notes, or any other prepared subtree
5. JSON / JSONL Payload Support

Inserted payload subtrees may be serialized in JSON or JSONL form.

JSONL is permitted especially when:

the subtree is large
the subtree is naturally generated as line-based structural data
inspection, debugging, or staged generation is needed

However, JSON and JSONL are only serialization formats.
They do not define the abstract structure of the subtree itself.

Therefore:

the logical payload is a tree object
JSON / JSONL are external representations of that object
transformation operates on the parsed subtree, not on raw serialized text
6. Transformation Output as Result, Not New Source

The output of transformation is a generated result, not a new canonical source tree.

It may be used for display, export, comparison, or analysis, but it is not automatically eligible as a new coordinate-bearing base tree.

Therefore:

transformed output is read-only in principle
transformed output does not become a new source for further metadata execution
canonical reference remains anchored in the original base text tree
7. Structural Stability over Expressive Expansion

The transformation system is intentionally constrained.

Its purpose is not to support unlimited recursive rewriting, but to provide a stable and analyzable mechanism for generating structured textual views from a canonical base.

Therefore:

expressive power is deliberately bounded
system stability takes priority over maximal flexibility
any new operation type must be justified against these constraints