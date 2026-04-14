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
    
from typing import Any


def flatten_tree_to_text(node: Any) -> str:
    """
    將任意層級的基準正文樹攤平成文字字串。

    規則：
    - terminal node: str
    - non-terminal node: dict / list / tuple
    - 任何層級皆可
    - 子節點依原有順序串接
    """
    if isinstance(node, str):
        return node

    if isinstance(node, dict):
        return "".join(flatten_tree_to_text(child) for child in node.values())

    if isinstance(node, (list, tuple)):
        return "".join(flatten_tree_to_text(child) for child in node)

    raise TypeError("Tree node must be str, dict, list, or tuple.")
    
from typing import Any, Iterable


def flatten_tree_to_text_skip_keys(node: Any, skip_keys: Iterable[str] = ()) -> str:
    skip_keys = set(skip_keys)

    if isinstance(node, str):
        return node

    if isinstance(node, dict):
        parts = []
        for key, child in node.items():
            if str(key) in skip_keys:
                continue
            parts.append(flatten_tree_to_text_skip_keys(child, skip_keys))
        return "".join(parts)

    if isinstance(node, (list, tuple)):
        return "".join(flatten_tree_to_text_skip_keys(child, skip_keys) for child in node)

    raise TypeError("Tree node must be str, dict, list, or tuple.")

def flatten_tree_to_text(node):
    if isinstance(node, str):
        return node
    return "".join(flatten_tree_to_text(child) for child in node.values())


def flatten_with_sentence_punctuation(tree):
    text = ""
    for line in tree.values():
        for sentence in line.values():
            text += flatten_tree_to_text(sentence) + "。"
    return text
    
def flatten_with_sentence_depth(node, current_depth=0, sentence_depth=2):
    if isinstance(node, str):
        return node

    if not isinstance(node, dict):
        raise TypeError("Invalid node")

    if current_depth == sentence_depth:
        return flatten_tree_to_text(node) + "。"

    return "".join(
        flatten_with_sentence_depth(child, current_depth + 1, sentence_depth)
        for child in node.values()
    )
    
print(flatten_tree_to_text_skip_keys(tree["0003"], skip_keys=["詩題", "副題"]))

