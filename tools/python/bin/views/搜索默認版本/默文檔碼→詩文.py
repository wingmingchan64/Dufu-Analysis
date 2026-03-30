'''
python H:/github/Dufu-Analysis/tools/python/bin/views/搜索默認版本/默文檔碼→詩文.py 0003
'''
# import lib
import sys
from pathlib import Path

# constant
DUFU_SHI = Path("DuFu") / "默認版本" / "詩"
current_file_path = Path(__file__).resolve()
#current_file_path = Path.cwd()
# base_path = Path(__file__).parent.resolve()
# Get the absolute path of the current file's directory
# current_dir = os.path.dirname(os.path.abspath(__file__))
base = current_file_path.parent.parent.parent.parent.parent.parent.parent

try:
    parts = [DUFU_SHI, sys.argv[1]+'.txt']
    file_path = base.joinpath(*parts)
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
        print("\n"+content)
except FileNotFoundError:
    print("Error: The file "+ file_path + " was not found.")
except UnicodeDecodeError:
    print("Error: Could not decode the file with the specified encoding. Try a different encoding.")
except IndexError:
    print("Error: 必須提供默文檔碼。")