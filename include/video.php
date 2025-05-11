<?php
if (!isset($_GET['go'])) {
    header('Location: index.php');
    exit;
}

$videoId = urldecode($_GET['go']);
$metadataFile = 'metadata.json';
$viewsFile = 'views.json';
$videoPath = '';
$views = 0;


if (file_exists($metadataFile)) {
    $existingData = json_decode(file_get_contents($metadataFile), true);
    foreach ($existingData as $videoData) {
        if ($videoData['id'] === $videoId) {
            $videoPath = './uploads/' . $videoData['filename'];
            break;
        }
    }
}


if (!file_exists($videoPath)) {
    header('Location: /');
    exit;
}


if (file_exists($viewsFile)) {
    $viewsData = json_decode(file_get_contents($viewsFile), true);
} else {
    $viewsData = [];
}


if (isset($viewsData[$videoId])) {
    $viewsData[$videoId]++;
} else {
    $viewsData[$videoId] = 1;
}
$views = $viewsData[$videoId];


file_put_contents($viewsFile, json_encode($viewsData, JSON_PRETTY_PRINT));

// Generate the current URL
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$currentURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>