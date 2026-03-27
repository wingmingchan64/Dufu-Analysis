# 生成數據結構 JSON

- Code base: tools\bin
- JSON base: schemas\json

## ids\生成默認詩文檔碼.php

- Dependency: None
- Generation: ids\默認詩文檔碼.json
- Example:

<pre>	[
		"0003",
		"0008",
		"0013",
		...
	]</pre>

## ids\生成默認版本詩碼.php

- Dependency: None
- Generation: ids\默認版本詩碼.json
- Example:

<pre>	[
		"0003",
		"0008",
		"0013-1",
		...
	]</pre>

## ids\生成默認詩文檔碼_默認詩碼.php

- Dependency: ids\默認版本詩碼.json
- Generation: ids\默認文檔碼_默認詩碼.json
- Example:

<pre>	{
		"0003": "0003",
		"0008": "0008",
		"0013": [
			"0013-1",
			"0013-2"
		],
		...
	}
</pre>
