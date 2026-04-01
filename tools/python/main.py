'''
python H:/github/Dufu-Analysis/tools/python/main.py 0003
'''
import sys
from pathlib import Path

if len( sys.argv ) == 2:
    文檔碼 = str( sys.argv[ 1 ] )
    base = Path( __file__ ).parent.resolve()
    parts = [ 'bin', 'views', '搜索默認版本' ]
    sys.path.append( str( base.joinpath( *parts ) ) )
    import 默文檔碼_詩文
    output = 默文檔碼_詩文.默文檔碼_詩文( 文檔碼 )
    print( output )
else:
    print( "wrong argument" )