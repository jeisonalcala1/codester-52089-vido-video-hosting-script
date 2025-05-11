<?php include 'include/config.php'; ?>
<?php
$seoData = json_decode(file_get_contents('./include/json/seo.json'), true);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
 
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow p-4">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="text-black text-xl header-title">
                <a href="/" class="text-black"><?php echo $titleHeader; ?></a><a href="/" class="text-black text-xs header-title2"><?php echo $titleHeaderTiny; ?></a>
            </div>
            
            <div class="relative flex items-center menu-wrapper">
                <a href="/" class="upload-btn"><i class="bi bi-cloud-upload"></i> Upload</a>
                <button id="menu-toggle" class="block text-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <ul id="menu" class="absolute right-0 mt-2 py-2 bg-white border rounded shadow-xl menu-content md:relative md:border-none md:shadow-none md:flex md:space-x-4 md:mt-0">
                    <li><a href="/" class="block px-4 py-2 text-black">Home</a></li>
                    <li><a href="./page/privacy.php" class="block px-4 py-2 text-black">Privacy Policy</a></li>
                    <li><a href="./page/tos.php" class="block px-4 py-2 text-black">Term of Service</a></li>
                    <li><a href="mailto:<?php echo $emailReport; ?>" class="block px-4 py-2 text-black">Abuse</a></li>

                </ul>
            </div>
        </nav>
    </header>