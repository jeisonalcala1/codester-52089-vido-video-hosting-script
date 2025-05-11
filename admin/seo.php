<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('LOCATION:/vd-admin.php'); 
    die();
}

$jsonFile = '../include/json/seo.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_seo'])) {
    $seoData = [
        "title" => $_POST['website_name'],
        "description" => $_POST['meta_description'],
        "keywords" => $_POST['keywords'],
        "og_title" => $_POST['og_title'],
        "og_description" => $_POST['og_description'],
        "og_url" => $_POST['ogurl'],
        "og_image" => $_POST['ogimage'],
        "favicon" => $_POST['ogico']
    ];
    file_put_contents($jsonFile, json_encode($seoData, JSON_PRETTY_PRINT));
}

$seoData = json_decode(file_get_contents($jsonFile), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <title>SEO Management</title>
    <script>
        function confirmSave(event) {
            event.preventDefault();
            const confirmDialog = document.getElementById("confirm-dialog");
            confirmDialog.classList.remove("hidden");
        }

        function proceedSave() {
            document.getElementById("seo-form").submit();
        }

        function cancelSave() {
            document.getElementById("confirm-dialog").classList.add("hidden");
        }
    </script>
</head>
<body class="bg-gray-100">
<?php include 'include/header.php'; ?>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">SEO Management</h1>
        <div id="confirm-dialog" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-xs text-center">
                <h2 class="text-xl font-semibold mb-4">Confirm Save?</h2>
                <p class="text-gray-700 mb-4">Are you sure you want to save these changes?</p>
                <div class="flex justify-center gap-4">
                    <button onclick="proceedSave()" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Confirm Save</button>
                    <button onclick="cancelSave()" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Cancel</button>
                </div>
            </div>
        </div>
        <div class="flex justify-center mb-8">
            <div class="bg-white shadow rounded-lg p-1">
                <ul class="flex space-x-1">
                    <li class="tab-item active">
                        <a href="/admin" class="py-3 px-4 block text-gray-600 font-semibold transition duration-300">Dashboard</a>
                    </li>
                    <li class="tab-item">
                        <a href="manage_videos.php" class="py-3 px-4 block text-gray-600 font-semibold">Manage</a>
                    </li>
                    <li class="tab-item">
                        <a href="seo.php" class="py-3 px-4 block text-blue-600 font-semibold">SEO</a>
                    </li>
                    <li class="tab-item">
                        <a href="ads.php" class="py-3 px-4 block text-gray-600 font-semibold">Ads</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4">Manage SEO Settings</h2>
            <form id="seo-form" action="seo.php" method="post">
                <div class="mb-4">
                    <label for="website_name" class="block text-gray-700 font-semibold mb-2">Title</label>
                    <input type="text" id="website_name" name="website_name" class="w-full p-2 border rounded" value="<?= htmlspecialchars($seoData['title']) ?>" required>
                </div>
                <div class="mb-4">
                    <label for="meta_description" class="block text-gray-700 font-semibold mb-2">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" class="w-full p-2 border rounded" rows="3" required><?= htmlspecialchars($seoData['description']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="keywords" class="block text-gray-700 font-semibold mb-2">Keywords</label>
                    <input type="text" id="keywords" name="keywords" class="w-full p-2 border rounded" placeholder="e.g., video, hosting, media" value="<?= htmlspecialchars($seoData['keywords']) ?>" required>
                </div>
                <div class="mb-4">
                    <label for="og_title" class="block text-gray-700 font-semibold mb-2">Open Graph Title (og:title)</label>
                    <input type="text" id="og_title" name="og_title" class="w-full p-2 border rounded" placeholder="Title for Social Sharing" value="<?= htmlspecialchars($seoData['og_title']) ?>">
                </div>
                <div class="mb-4">
                    <label for="og_description" class="block text-gray-700 font-semibold mb-2">Open Graph Description (og:description)</label>
                    <textarea id="og_description" name="og_description" class="w-full p-2 border rounded" rows="3" placeholder="Description for Social Sharing"><?= htmlspecialchars($seoData['og_description']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="ogurl" class="block text-gray-700 font-semibold mb-2">Open Graph URL (og:url)</label>
                    <input type="url" id="ogurl" name="ogurl" class="w-full p-2 border rounded" placeholder="https://example.com" value="<?= htmlspecialchars($seoData['og_url']) ?>">
                </div>
                <div class="mb-4">
                    <label for="ogimage" class="block text-gray-700 font-semibold mb-2">Open Graph Image (og:image)</label>
                    <input type="url" id="ogimage" name="ogimage" class="w-full p-2 border rounded" placeholder="url screenshot website" value="<?= htmlspecialchars($seoData['og_image']) ?>">
                </div>
                <div class="mb-4">
                    <label for="ogico" class="block text-gray-700 font-semibold mb-2">favicon.ico</label>
                    <input type="url" id="ogico" name="ogico" class="w-full p-2 border rounded" placeholder="url ico website" value="<?= htmlspecialchars($seoData['favicon']) ?>">
                </div>
                <button type="button" onclick="confirmSave(event)" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Save SEO Settings
                </button>
                <input type="hidden" name="save_seo" value="1">
            </form>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>
    <script>
    document.getElementById('menu-button').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
    </script>
</body>
</html>
