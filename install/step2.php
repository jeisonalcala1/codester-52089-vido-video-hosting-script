<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration - Step 2</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg">
        <div class="flex items-center mb-6">
            <i class="bi bi-gear-fill text-blue-600 text-3xl mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">Configuration - Step 2</h2>
        </div>

        <div id="config-content" class="space-y-4">
            <?php
            $configFile = '../include/config.php';

            // Load config.php
            if (file_exists($configFile)) {
                include $configFile;
            } else {
                echo "<div class='text-red-500'>Config file not found. Please make sure the config.php file is in the correct directory.</div>";
                exit;
            }

            // Convert max file size to MB for display
            $maxFileSizeMB = $maxFileSize / (1024 * 1024); // Convert bytes to megabytes
            ?>

            <form method="post" action="">
            <div class="mb-4 flex space-x-4">
    <div class="flex-1">
        <label for="titleHeader" class="block text-gray-700">Title Header Nav:</label>
        <input type="text" id="titleHeader" name="titleHeader" value="<?php echo htmlspecialchars($titleHeader); ?>" class="border border-gray-300 rounded w-full py-2 px-3" required>
    </div>

    <div class="flex-1">
        <label for="titleHeaderTiny" class="block text-gray-700">Domain:</label>
        <input type="text" id="titleHeaderTiny" name="titleHeaderTiny" value="<?php echo htmlspecialchars($titleHeaderTiny); ?>" class="border border-gray-300 rounded w-full py-2 px-3" required>
    </div>
</div>

                <div class="mb-4">
                    <label for="emailReport" class="block text-gray-700">Email Report:</label>
                    <input type="email" id="emailReport" name="emailReport" value="<?php echo htmlspecialchars($emailReport); ?>" class="border border-gray-300 rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label for="maxFileSize" class="block text-gray-700">Max Upload File Size (MB):</label>
                    <input type="number" id="maxFileSize" name="maxFileSize" value="<?php echo htmlspecialchars($maxFileSizeMB); ?>" class="border border-gray-300 rounded w-full py-2 px-3" required>
                </div>

                <div class="mb-4">
                    <label for="fileSizeLimitText" class="block text-gray-700">File Size Limit for Text Alert:</label>
                    <input type="text" id="fileSizeLimitText" name="fileSizeLimitText" value="<?php echo htmlspecialchars($fileSizeLimitText); ?>" class="border border-gray-300 rounded w-full py-2 px-3" required>
                </div>

                

                

                <button type="submit" name="saveConfig" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition-colors duration-200">
                    Save Configuration
                </button>
            </form>

            <?php
// Handle form submission
if (isset($_POST['saveConfig'])) {
    $maxFileSizeMB = $_POST['maxFileSize'];
    $maxFileSize = $maxFileSizeMB * 1024 * 1024; // Convert MB back to bytes
    $fileSizeLimitText = $_POST['fileSizeLimitText'];
    $titleHeader = $_POST['titleHeader'];
    $titleHeaderTiny = $_POST['titleHeaderTiny'];
    $emailReport = $_POST['emailReport'];

    // Prepare the new config content
    $configContent = "<?php\n\n";
    $configContent .= "\$maxFileSize = $maxFileSize;\n";
    $configContent .= "\$fileSizeLimitText = \"$fileSizeLimitText\";\n";
    $configContent .= "\$titleHeader = \"$titleHeader\";\n";
    $configContent .= "\$titleHeaderTiny = \"$titleHeaderTiny\";\n";
    $configContent .= "\$emailReport = \"$emailReport\";\n";
    $configContent .= "?>";

    // Save the new config to the config.php file
    if (file_put_contents($configFile, $configContent) !== false) {
        echo "<div class='text-green-500 mt-4'>Configuration saved successfully!</div>";
        echo "<div class='mt-4'><button onclick='location.reload()' class='w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded transition-colors duration-200'>Refresh for Synch</button></div>";
    } else {
        echo "<div class='text-red-500 mt-4'>Failed to save configuration. Please check your permissions.</div>";
    }
}
?>

        </div>

        <div class="mt-6">
            <a href="step3.php" class="w-full block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded transition-colors duration-200">
                Next
            </a>
        </div>
    </div>
</body>
</html>
