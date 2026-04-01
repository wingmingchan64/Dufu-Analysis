'''
python H:/github/Dufu-Analysis/tools/python/bin/views/搜索默認版本/默文檔碼_詩文.py 0003
'''

# must be defined first
def 默文檔碼_詩文( arg ):
    import sys
    from pathlib import Path
    sys.path.append( str( Path( __file__ )
        .parents[ 3 ].joinpath( 'lib' ) ) )
    import constants
    base  = Path( __file__ ).parents[ 6 ].resolve()
    parts = [ constants.杜甫_詩_文件夾, arg + '.txt' ]
    file_path = base.joinpath( *parts )

    try:
        with open( file_path, 'r', encoding = 'utf-8' ) as f:
            content = f.read()
            return "\n" + content
    except FileNotFoundError:
        print( "Error: The file " + file_path + 
            " was not found." )
    except UnicodeDecodeError:
        print( "Error: Could not decode the file with " +
            "the specified encoding. " +
            "Try a different encoding." )
    except IndexError:
        print( "Error: 必須提供默文檔碼。" )

import sys
if __name__ == "__main__":
    if len( sys.argv ) == 2:
        output = 默文檔碼_詩文( sys.argv[ 1 ] )
        print( output )
    else:
        print( "wrong argument" )