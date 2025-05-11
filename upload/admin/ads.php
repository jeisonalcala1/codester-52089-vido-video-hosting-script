<?php
function readAdsJson() {
    $json = file_get_contents('../include/json/ad.json');
    return json_decode($json, true);
}

function writeAdsJson($data) {
    file_put_contents('../include/json/ad.json', json_encode($data, JSON_PRETTY_PRINT));
}

$adsData = readAdsJson();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adsData['top_player_ad'] = $_POST['top_player_ad'];
    $adsData['bottom_player_ad'] = $_POST['bottom_player_ad'];
    $adsData['above_footer_player'] = $_POST['ad_slot_5'];
    $adsData['under_welcome_message_home'] = $_POST['ad_slot_3'];
    $adsData['above_footer_home'] = $_POST['ad_slot_4'];

    writeAdsJson($adsData);
    header('Location: ads.php?status=success');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Manage Ads</title>
</head>
<body class="bg-gray-100">
    <?php include 'include/header.php'; ?>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">Ad Management</h1>

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
                        <a href="seo.php" class="py-3 px-4 block text-gray-600 font-semibold">SEO</a>
                    </li>
                    <li class="tab-item">
                        <a href="ads.php" class="py-3 px-4 block text-blue-600 font-semibold">Ads</a>
                    </li>
                </ul>
            </div>
        </div>

        <form method="POST" class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4">Enter Ad Code</h2>

            <div class="mb-4">
                <label for="top_player_ad" class="block text-gray-700 font-semibold mb-2">Top Player Ad</label>
                <textarea id="top_player_ad" name="top_player_ad" rows="4" class="w-full p-2 border rounded" placeholder="Enter ad code here..."><?php echo htmlspecialchars($adsData['top_player_ad'] ?? ''); ?></textarea>
            </div>
            
            <div class="mb-4">
                <label for="bottom_player_ad" class="block text-gray-700 font-semibold mb-2">Bottom Player Ad</label>
                <textarea id="bottom_player_ad" name="bottom_player_ad" rows="4" class="w-full p-2 border rounded" placeholder="Enter ad code here..."><?php echo htmlspecialchars($adsData['bottom_player_ad'] ?? ''); ?></textarea>
            </div>
            
            <div class="mb-4">
                <label for="ad_slot_5" class="block text-gray-700 font-semibold mb-2">Above Footer Player</label>
                <textarea id="ad_slot_5" name="ad_slot_5" rows="4" class="w-full p-2 border rounded" placeholder="Enter ad code here..."><?php echo htmlspecialchars($adsData['above_footer_player'] ?? ''); ?></textarea>
            </div>

            <div class="mb-4">
                <label for="ad_slot_3" class="block text-gray-700 font-semibold mb-2">Under Welcome Message (home)</label>
                <textarea id="ad_slot_3" name="ad_slot_3" rows="4" class="w-full p-2 border rounded" placeholder="Enter ad code here..."><?php echo htmlspecialchars($adsData['under_welcome_message_home'] ?? ''); ?></textarea>
            </div>

            <div class="mb-4">
                <label for="ad_slot_4" class="block text-gray-700 font-semibold mb-2">Above Footer (home)</label>
                <textarea id="ad_slot_4" name="ad_slot_4" rows="4" class="w-full p-2 border rounded" placeholder="Enter ad code here..."><?php echo htmlspecialchars($adsData['above_footer_home'] ?? ''); ?></textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Save Ads
            </button>
        </form>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="text-green-500 text-center mb-4">Ads updated successfully!</div>
        <?php endif; ?>
    </div>
        <?php include 'include/footer.php'; ?>
    <script>
    document.getElementById('menu-button').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
    </script>
</body>
</html>
