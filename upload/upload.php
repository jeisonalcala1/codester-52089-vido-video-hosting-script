<?php
include './include/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    if ($_FILES['video']['size'] > $maxFileSize) {
        echo $fileSizeLimitText; // Gunakan teks dari config
        exit;
    }

    $uploadDir = './uploads/';
    $uniqueId = bin2hex(random_bytes(4));
    $originalFilename = basename($_FILES['video']['name']);
    $uploadFile = $uploadDir . $uniqueId . '-' . $originalFilename;

    if (move_uploaded_file($_FILES['video']['tmp_name'], $uploadFile)) {
        
        $metadata = array(
            'id' => $uniqueId,
            'filename' => $uniqueId . '-' . $originalFilename,
            'original_filename' => $originalFilename,
        );

        $metadataFile = 'metadata.json';
        if (file_exists($metadataFile)) {
            $existingData = json_decode(file_get_contents($metadataFile), true);
        } else {
            $existingData = array();
        }

        $existingData[] = $metadata;
        file_put_contents($metadataFile, json_encode($existingData));

        
        $videoUrl = 'v?go=' . urlencode($uniqueId);
        header('Location: ' . $videoUrl);
        exit;
    } else {
        echo "Failed to upload video.";
    }
} else {
    header('Location: index.php');
    exit;
}
?>
