<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration - Finish</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg text-center">
        <i class="bi bi-check-circle text-green-600 text-3xl mb-4"></i>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Finish</h2>
        
        <div class="mb-4 text-gray-700">
            <p>Main Domain: <strong class="text-blue-600"><?php echo $_SERVER['HTTP_HOST']; ?></strong></p>
            <p>Admin Access: <strong class="text-blue-600"><?php echo $_SERVER['HTTP_HOST']; ?>/vd-admin.php</strong></p>
        </div>

        <p class="text-gray-600 mb-4">Make sure to delete the folder <strong class="text-red-600">Install</strong> before access website.</p>

        <a href="/" class="block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded transition-colors duration-200">
            Finish
        </a>
    </div>
</body>
</html>
