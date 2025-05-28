<!DOCTYPE HTML>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>星を作ろう</title>
    <style>
        body{font-family: monospace;}
    </style>
</head>

<body>
<pre><?php
// 🔹左寄り
for ($i = 1; $i <= 5; $i++) {
echo str_repeat("*", $i) . "\n";
}

echo "\n";

// 🔸右寄り
for ($i = 1; $i <= 5; $i++) {
echo str_repeat(" ", 5 - $i); 
echo str_repeat("*", $i) . "\n";
}

echo "\n";

// 🔷ひし形
$max = 5; // 一番長い行の半分（行数：上下合わせて $max*2 - 1）

// 🔼 上半分
for ($i = 1; $i <= $max; $i++) {
echo str_repeat(" ", $max - $i);           // スペース
echo str_repeat("*", $i * 2 - 1);          // アスタリスク
echo "\n";
}

// 🔽 下半分
for ($i = $max - 1; $i >= 1; $i--) {
echo str_repeat(" ", $max - $i);           // スペース
echo str_repeat("*", $i * 2 - 1);          // アスタリスク
echo "\n";
}

?>
</pre>
</body>

</html>