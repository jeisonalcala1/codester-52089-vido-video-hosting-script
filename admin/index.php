<?php
session_start();
if(!isset($_SESSION['login'])) {
    header('LOCATION:/vd-admin.php'); die();
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
    <title>Dashboard</title>
</head>
<body class="bg-gray-100">
    <?php include 'include/header.php'; ?>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">Dashboard</h1>
        <div class="flex justify-center mb-8">
            <div class="bg-white shadow rounded-lg p-1">
                <ul class="flex space-x-1">
                    <li class="tab-item active">
                        <a href="/admin" class="py-3 px-4 block text-blue-600 font-semibold transition duration-300">Dashboard</a>
                    </li>
                    <li class="tab-item">
                        <a href="manage_videos.php" class="py-3 px-4 block text-gray-600 font-semibold">Manage</a>
                    </li>
                    <li class="tab-item">
                        <a href="seo.php" class="py-3 px-4 block text-gray-600 font-semibold">SEO</a>
                    </li>
                    <li class="tab-item">
                        <a href="ads.php" class="py-3 px-4 block text-gray-600 font-semibold">Ads</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex justify-center mb-8">
            <div class="relative bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg rounded-lg p-8 max-w-sm w-full">
                <div class="flex items-center mb-4">
                    <i class="bi bi-film display-4 text-5xl mr-4 bg-white bg-opacity-20 rounded-full p-4"></i>
                    <div>
                        <h2 class="text-2xl font-bold">Total Videos Uploaded</h2>
                        <p class="text-sm text-gray-200 opacity-75">Uploads and Activity</p>
                    </div>
                </div>
                <p id="totalVideos" class="text-4xl font-extrabold text-white mt-4 mb-6">0 Video</p>
            </div>
        </div>

        <div class="flex justify-center mb-8">
            <div class="relative bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg rounded-lg p-8 max-w-sm w-full">
                <div class="flex items-center mb-4">
                    <i class="bi bi-star display-4 text-5xl mr-4 bg-white bg-opacity-20 rounded-full p-4"></i>
                    <div>
                        <h2 class="text-2xl font-bold">Popular Video</h2>
                        <p class="text-sm text-gray-200 opacity-75">Most Views Video</p>
                    </div>
                </div>
                <p>
                    <a id="mostPopularVideo" class="text-4xl font-extrabold text-white mt-4 mb-1 hover:underline cursor-pointer">Video Name</a>
                </p>
                <p id="viewsCount" class="text-lg text-white opacity-75">0 Views</p>
            </div>
        </div>

        <div class="flex justify-center mb-8">
            <div class="relative bg-gradient-to-r from-green-600 to-teal-600 text-white shadow-lg rounded-lg p-8 max-w-sm w-full">
                <div class="flex items-center mb-4">
                    <i class="bi bi-file-earmark-text display-4 text-5xl mr-4 bg-white bg-opacity-20 rounded-full p-4"></i>
                    <div>
                        <h2 class="text-2xl font-bold">5 New Videos</h2>
                        <p class="text-sm text-gray-200 opacity-75">Latest Uploads</p>
                    </div>
                </div>
                <ul id="newVideosList" class="list-disc pl-5"></ul>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Upload Statistics Over Time</h2>
                <canvas id="videoChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>
<?php include 'include/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
