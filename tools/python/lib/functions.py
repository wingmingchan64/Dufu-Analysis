# import json
# with open("coords.json", "r", encoding="utf-8") as f:
#    data = json.load(f)
#
# tree = coords_to_tree(data)
# print(json.dumps(tree, ensure_ascii=False, indent=2))
def coords_to_tree(data):
    result = {}

    for doc_id, chars in data.items():
        doc = result.setdefault(doc_id, {})

        for coord, char in chars.items():
            coord = coord.strip("〚〛")

            # 只取最後一段 3.1.1
            pos = coord.rfind(":")
            line_sentence_char = coord[pos+1:]

            line, sentence, char_pos = line_sentence_char.split(".")

            doc.setdefault(line, {}) \
               .setdefault(sentence, {})[char_pos] = char

    return result
    
def coords_to_tree(data):
    result = {}

    for doc_id, chars in data.items():
        doc = result.setdefault(doc_id, {})

        for coord, char in chars.items():
            coord = coord.strip("〚〛")

            # 只取最後一段 3.1.1
            pos = coord.rfind(":")
            line_sentence_char = coord[pos+1:]

            line, sentence, char_pos = line_sentence_char.split(".")

            doc.setdefault(line, {}) \
               .setdefault(sentence, {})[char_pos] = char

    return result
    
