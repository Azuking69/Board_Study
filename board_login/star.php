<!DOCTYPE HTML>
<html lang="ko">

<head>
    <meta charset="UTF-8">
</head>

<body>
<pre>
<?php
    for ($i1 = 1; $i1 <= 9; $i1++){
        echo str_repeat("*", $i1) . "<br>";
    }

echo "<br>";

    for ($i2 = 1; $i2 <= 9; $i2++){
        echo str_repeat("&nbsp;", 9 - $i2) . str_repeat("*", $i2) . "<br>";
    }

echo "<br>";

    $height = 5;
    for($i3 = 1; $i3 <= $height; $i3++){
        echo str_repeat("&nbsp;", $height - $i3);
        echo str_repeat("*", 2 * $i3 - 1) . "<br>";
    }

    for ($i4 = $height - 1; $i4 >= 1; $i4--) {
    echo str_repeat("&nbsp;", $height - $i4);
    echo str_repeat("*", 2 * $i4 - 1);
    echo "<br>";
    }
?>
</body>

</html>