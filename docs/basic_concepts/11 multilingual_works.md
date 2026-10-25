# Works with Multilingual Translations

## Listing Texts of Different Languages Side By Side

- The same framework can be used to represent literary works in different languages
- Texts in different languages may require different tokenization methods, depending on the intended level of analysis
- Text trees can be used to display an original work and one or more translations side by side

---

## Mapping between Two (Or More) Languages

- To simplify the process, the original and translated texts can be required to have corresponding paragraph divisions
- Under this requirement, the two texts share the same set of paragraph-level paths, even though their textual contents differ
- No further segmentation is required for paragraph-level alignment, since sentence and clause structures may differ across languages
- A program can use the shared paragraph paths to pair the original and translated texts, paragraph by paragraph
- If sentence boundaries correspond one-to-one across the languages, the alignment can be extended to the sentence level
- If corresponding paragraph divisions cannot be assumed, more elaborate metadata is required to specify the relationships between textual units
- The same approach can be extended to multiple translations

## Adding Dictionary Definitions

- Dictionary definitions in the languages involved can be associated with appropriate nodes in the text trees
- Dictionary data can be organized using key-value pairs, with provisions for words or phrases having multiple definitions
- Metadata markers identify the words or phrases to which dictionary information should be attached
- The terms specified in the metadata can be looked up automatically in the relevant dictionaries
- The resulting definitions can then be attached to the corresponding nodes
- Where necessary, metadata can also specify the intended dictionary sense