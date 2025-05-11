<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('LOCATION:/vd-admin.php');
    die();
}

$uploads_dir = '../uploads/';
$metadata_file = '../metadata.json';
$views_file = '../views.json';

function get_videos($metadata_file) {
    if (!file_exists($metadata_file)) {
        return [];
    }
    $json_data = file_get_contents($metadata_file);
    return json_decode($json_data, true);
}

function get_views($views_file) {
    if (!file_exists($views_file)) {
        return [];
    }
    $json_data = file_get_contents($views_file);
    return json_decode($json_data, true);
}

function get_file_upload_time($filename, $uploads_dir) {
    $file_path = $uploads_dir . $filename;
    return file_exists($file_path) ? filemtime($file_path) : 0;
}

// Handle updating views
if (isset($_POST['update_views'])) {
    $video_id = $_POST['video_id'];
    $new_views = intval($_POST['new_views']);
    $views = get_views($views_file);

    if (isset($views[$video_id])) {
        $views[$video_id] = $new_views;
        file_put_contents($views_file, json_encode($views, JSON_PRETTY_PRINT));
        echo "Views updated successfully.";
    } else {
        echo "Video not found in views data.";
    }
    exit;
}

$videos = get_videos($metadata_file);
$views_data = get_views($views_file);

$domain = $_SERVER['HTTP_HOST'];

foreach ($videos as &$video) {
    $video['upload_time'] = get_file_upload_time($video['filename'], $uploads_dir);
    $video['views'] = isset($views_data[$video['id']]) ? $views_data[$video['id']] : 0;
    $video['url'] = 'https://' . $domain . '/v?go=' . $video['id'];
}
unset($video);

$sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
usort($videos, function ($a, $b) use ($sort_order) {
    return $sort_order === 'newest' ? $b['upload_time'] - $a['upload_time'] : $a['upload_time'] - $b['upload_time'];
});

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$videos_per_page = 10;
$total_videos = count($videos);
$total_pages = ceil($total_videos / $videos_per_page);
$start_index = ($page - 1) * $videos_per_page;
$paginated_videos = array_slice($videos, $start_index, $videos_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Fake Views</title>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include 'include/header.php'; ?>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">Fake Views Tool</h1>
        <div class="flex justify-center mb-8">
            <div class="bg-white shadow rounded-lg p-1">
                <ul class="flex space-x-1">
                    <li class="tab-item active">
                        <a href="general.php" class="py-3 px-4 block text-gray-600 font-semibold transition duration-300">General</a>
                    </li>
                    <li class="tab-item">
                        <a href="reset.php" class="py-3 px-4 block text-gray-600 font-semibold">Reset PIN</a>
                    </li>
                    <li class="tab-item">
                        <a href="views.php" class="py-3 px-4 block text-blue-600 font-semibold">Fake Views</a>
                    </li>
                    
                </ul>
            </div>
        </div>
        <div class="mb-4">
            <label for="sort" class="mr-2">Sort by:</label>
            <select id="sort" name="sort" class="p-2 border" onchange="sortVideos()">
                <option value="newest" <?php echo $sort_order === 'newest' ? 'selected' : ''; ?>>Time Upload</option>
                <option value="oldest" <?php echo $sort_order === 'oldest' ? 'selected' : ''; ?>>Oldest</option>
            </select>
        </div>
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID Video</th>
                    <th class="py-2 px-4 border-b text-center">Video</th>
                    <th class="py-2 px-4 border-b text-center"><i class="bi bi-eye"></i></th>
                    <th class="py-2 px-4 border-b">FakeV</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paginated_videos as $video): ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($video['id']); ?></td>
                    <td class="py-2 px-4 border-b text-center">
                        <a href="<?php echo htmlspecialchars($video['url']); ?>" target="_blank" class="text-blue-500">
                            <i class="bi bi-link-45deg"></i>
                        </a>
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <?php echo htmlspecialchars($video['views']); ?>
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <input type="number" id="views-<?php echo htmlspecialchars($video['id']); ?>" value="<?php echo htmlspecialchars($video['views']); ?>" class="w-14 text-center border border-gray-300 rounded">
                        <button onclick="updateViews('<?php echo htmlspecialchars($video['id']); ?>')" class="ml-2 text-green-500">
                            <i class="bi bi-check-circle"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>&sort=<?php echo $sort_order; ?>" class="px-3 py-1 border <?php echo $i === $page ? 'bg-blue-500 text-white' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>
<?php include 'include/footer.php'; ?>
    <script>
    function sortVideos() {
        const sortOrder = document.getElementById('sort').value;
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sort', sortOrder);
        window.location.search = urlParams.toString();
    }

    function updateViews(videoId) {
        const newViews = document.getElementById('views-' + videoId).value;
        fetch('views.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `update_views=true&video_id=${videoId}&new_views=${newViews}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();  // Reload to update the views display
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
    <script>
    document.getElementById('menu-button').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
    </script>
</body>
</html>
