<?php include '../include/config.php'; ?>
<?php
$seoData = json_decode(file_get_contents('../include/json/seo.json'), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($seoData['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seoData['description']); ?>"">
    <meta name="keywords" content="<?php echo htmlspecialchars($seoData['keywords']); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($seoData['og_title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seoData['og_description']); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($seoData['og_url']); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo htmlspecialchars($seoData['og_image']); ?>">
    <link rel="icon" href="<?php echo htmlspecialchars($seoData['favicon']); ?>" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.plyr.io/3.7.8/plyr.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="/assets/css/head.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow p-4">
    <nav class="container mx-auto flex justify-center items-center">
        <div class="text-black text-xl header-title">
            <a href="/" class="text-black"><?php echo $titleHeader; ?></a>
            <a href="/" class="text-black text-xs header-title2"><?php echo $titleHeaderTiny; ?></a>
        </div>
    </nav>
</header>
