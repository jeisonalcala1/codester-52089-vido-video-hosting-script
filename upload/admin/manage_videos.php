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

if (isset($_POST['delete_video'])) {
    $video_id = $_POST['delete_video'];
    $videos = get_videos($metadata_file);
    $views = get_views($views_file);
    $video_to_delete = null;

    foreach ($videos as $video) {
        if ($video['id'] === $video_id) {
            $video_to_delete = $video;
            break;
        }
    }

    if ($video_to_delete) {
        $file_to_delete = $uploads_dir . $video_to_delete['filename'];

        if (file_exists($file_to_delete)) {
            unlink($file_to_delete);
            $updated_videos = array_filter($videos, function($video) use ($video_id) {
                return $video['id'] !== $video_id;
            });
            file_put_contents($metadata_file, json_encode(array_values($updated_videos)));

            if (isset($views[$video_id])) {
                unset($views[$video_id]);
                file_put_contents($views_file, json_encode($views, JSON_PRETTY_PRINT));
            }

            echo "Video successfully deleted.";
        } else {
            echo "Video not found.";
        }
    } else {
        echo "Video not found in metadata.";
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
    <title>Manage Videos</title>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include 'include/header.php'; ?>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">Manage Video</h1>
        <div class="flex justify-center mb-8">
            <div class="bg-white shadow rounded-lg p-1">
                <ul class="flex space-x-1">
                    <li class="tab-item">
                        <a href="/admin" class="py-3 px-4 block text-gray-600 font-semibold">Dashboard</a>
                    </li>
                    <li class="tab-item active">
                        <a href="manage_videos.php" class="py-3 px-4 block text-blue-600 font-semibold transition duration-300">Manage</a>
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
                    <th class="py-2 px-4 border-b">Delete</th>
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
                    <td class="py-2 px-4 border-b text-center"><?php echo htmlspecialchars($video['views']); ?></td>
                    <td class="py-2 px-4 border-b text-center">
                        <button onclick="deleteVideo('<?php echo htmlspecialchars($video['id']); ?>')" class="text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
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

    function deleteVideo(videoId) {
        if (confirm('Are you sure you want to delete this video?')) {
            fetch('manage_videos.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'delete_video=' + videoId
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    }
    </script>
    <script>
    document.getElementById('menu-button').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
    </script>
</body>
</html>
