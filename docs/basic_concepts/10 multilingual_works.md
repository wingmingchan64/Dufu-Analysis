# Works With Multilingual Translations

## Listing Texts Of Different Languages Side By Side

- It is possible to use the same approach to deal with literal works of any languages
- Processing an individual language involves tokenization of texts
- It is also possible to create trees listing original texts and one or more translated versions side by side

## Mapping Between Two (Or More) Languages

- To simplify the process, we can impose a requirement on both the original texts and translated texts: they must have the same tree structure
- If this requirement is lifted, then mapping will require elaborated metadata marking
- The two versions (original and one translated version) have the same segmentation of paragraphs
- No segmentation below the level of paragraphs; the concepts of clauses and sentences may differ in the two languages involved
- (A ∩ B) does not involve any texts; instead, it is the tree structure shared by both versions
- A simple program can pair the texts of the two lanugages, paragraph by paragraph
- If there is a one-one mapping of punctuations between the two languages, demarcating sentence boundaries, then splitting paragraphs into sentences is also possible
- The approach can easily be extended to more than one translation

## Adding Dictionary Definitions

- Definitions from dictionaries of various involved languages can be inserted into the tree automatically
- Dictionary definitions can be stored using key-value pairs
- Metadata markers are required to mark the targeted nodes of words/phrases
- terms listed in metadata markers can be looked up in the dictionaries and corresponding definitions are inserted into the correct nodes