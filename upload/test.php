<?php
// Fungsi untuk mengaburkan JavaScript
function obfuscate_js($code) {
    // Encode string literals
    $code = preg_replace_callback('/(["\'])(.*?)(["\'])/s', function ($matches) {
        $encoded = base64_encode($matches[2]);
        return $matches[1] . "atob('$encoded')" . $matches[3];
    }, $code);

    // Randomize variable names
    $code = preg_replace_callback('/\b(var|let|const)\s+(\w+)/', function ($matches) {
        $newVarName = '_0x' . substr(md5(rand()), 0, 8);
        return $matches[1] . ' ' . $newVarName;
    }, $code);

    // Wrap in eval for control flow obfuscation
    $encodedCode = base64_encode($code);
    return "eval(atob('$encodedCode'));";
}

// Proses form jika ada input JavaScript
$obfuscated_code = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['js_code'])) {
    $js_code = $_POST['js_code'];
    $obfuscated_code = obfuscate_js($js_code);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JavaScript Obfuscator</title>
</head>
<body>
    <h1>JavaScript Obfuscator</h1>
    <form method="POST">
        <label for="js_code">Masukkan kode JavaScript:</label><br>
        <textarea id="js_code" name="js_code" rows="10" cols="50"><?php echo isset($js_code) ? htmlspecialchars($js_code) : ''; ?></textarea><br>
        <button type="submit">Obfuscate</button>
    </form>

    <?php if ($obfuscated_code): ?>
        <h2>Kode JavaScript yang Diobfuscate:</h2>
        <textarea rows="10" cols="50" readonly><?php echo htmlspecialchars($obfuscated_code); ?></textarea>
    <?php endif; ?>
</body>
</html>
