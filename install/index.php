<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Wizard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg">
        <div class="flex items-center mb-6">
            <i class="bi bi-gear-fill text-blue-600 text-3xl mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">Installation Wizard</h2>
        </div>

        <div id="requirements" class="mb-6 space-y-4">
            <?php
                // System Requirements
                $requirements = [
                    'PHP 8.1' => version_compare(PHP_VERSION, '8.1', '>='),
                    'JSON' => function_exists('json_encode'),
                    'Fileinfo' => function_exists('finfo_open'),
                    'SSL' => !empty($_SERVER['HTTPS']),
                    'Folder Permissions (uploads) 0777' => substr(sprintf('%o', fileperms('../uploads')), -4) === '0777',
                    'allow_url_fopen' => ini_get('allow_url_fopen') == '1',
                    'file_get_contents' => function_exists('file_get_contents')
                ];

                foreach ($requirements as $requirement => $status) {
                    $icon = $status ? 'bi bi-check-circle text-green-500' : 'bi bi-x-circle text-red-500';
                    $statusText = $status ? 'Pass' : 'Requires Attention';
                    echo "<div class='flex items-center space-x-2'>
                            <i class='$icon text-xl'></i>
                            <span class='text-gray-700'>$requirement: <strong>$statusText</strong></span>
                          </div>";
                }

                // Display post_max_size and upload_max_filesize settings
                $postMaxSize = ini_get('post_max_size');
                $uploadMaxSize = ini_get('upload_max_filesize');
                echo "<div class='flex items-center space-x-2'>
                        <i class='bi bi-check-circle text-yellow-500 text-xl'></i>
                        <span class='text-gray-700'>post_max_size: <strong>$postMaxSize</strong> (Adjustable in server settings as needed)</span>
                      </div>";
                echo "<div class='flex items-center space-x-2'>
                        <i class='bi bi-check-circle text-yellow-500 text-xl'></i>
                        <span class='text-gray-700'>upload_max_filesize: <strong>$uploadMaxSize</strong> (Adjustable in server settings as needed)</span>
                      </div>";
            ?>
        </div>
        
        <?php if (in_array(false, $requirements)): ?>
            <button onclick="location.reload();" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition-colors duration-200">
                Refresh
            </button>
        <?php else: ?>
            <a href="step2.php" class="w-full block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded transition-colors duration-200">
                Next
            </a>
        <?php endif; ?>
    </div>
</body>
</html>
