<?php include 'include/config.php'; ?>
<?php include 'include/video.php'; ?>
<?php include 'include/head.php'; ?>
<?php
// Ambil data iklan dari file JSON
$adsData = json_decode(file_get_contents('./include/json/ad.json'), true);

// Mengambil masing-masing posisi iklan
$topPlayerAd = $adsData['top_player_ad'] ?? '';
$bottomPlayerAd = $adsData['bottom_player_ad'] ?? '';
$aboveFooterPlayer = $adsData['above_footer_player'] ?? '';
$underWelcomeMessageHome = $adsData['under_welcome_message_home'] ?? '';
$aboveFooterHome = $adsData['above_footer_home'] ?? '';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="./assets/css/video.css">

<div class="container mx-auto mt-8">
<div class="mt-4 ad-container responsive-ad">
    <?php echo $topPlayerAd; ?>
</div>
    <div class="mt-8 flex justify-center">
        <div class="video-frame">
            <video id="video" controls playsinline class="plyr">
                <source src="<?php echo 'uploads/' . basename($videoPath); ?>" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="mt-4 ad-container responsive-ad">
    <?php echo $bottomPlayerAd; ?>
</div>
    <div class="mt-4 flex items-center justify-center">
        <div class="url-container flex bg-gray-100 border border-gray-300 rounded-lg shadow-sm p-2">
            <input id="video-url" type="text" readonly value="<?php echo $currentURL; ?>" class="video-url-input flex-grow bg-transparent border-none px-2 py-1 focus:outline-none focus:ring-0">
            <button id="copy-button" class="copy-button bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Copy</button>
        </div>
    </div>
    <div class="mt-2 flex items-center justify-center space-x-2">
        <button id="report-button" class="report-button border border-red-500 text-red-500 px-4 py-1 rounded hover:bg-red-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-500">Report</button>
        <button id="views-button" class="views-button border border-gray-500 text-gray-500 px-4 py-1 rounded" readonly><i class="bi bi-eye"></i> <?php echo $views; ?></button>
    </div>
</div>
<div class="mt-4 ad-container responsive-ad">
    <?php echo $aboveFooterPlayer; ?>
</div>
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
<script>
    const email = <?php echo json_encode($emailReport); ?>;
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const player = new Plyr('#video', {
        captions: { active: true },
        settings: ['captions', 'quality', 'download'],
        disableContextMenu: true,
        controls: [
            'play-large',
            'play',
            'fast-forward',
            'progress',
            'current-time',
            'duration',
            //'mute',
            //'volume',
            //'captions',
            'settings',
            'airplay',
            'download',
            'fullscreen'
        ]
    });

    const video = document.getElementById('video');
    video.addEventListener('play', function() {
        const videoFrame = document.querySelector('.video-frame');
        videoFrame.classList.add('video-playing');
    });

    const copyButton = document.getElementById('copy-button');
    const videoUrl = document.getElementById('video-url');
    copyButton.addEventListener('click', function() {
        videoUrl.select();
        videoUrl.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand('copy');
        alert('Successfully copied to clipboard');
    });

    const reportButton = document.getElementById('report-button');
    reportButton.addEventListener('click', function() {
        const subject = 'Report';
        const body = `Video: ${videoUrl.value}\nReason (Alasan):`;
        window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    });
});
</script>

<script>
document.getElementById('menu-toggle').addEventListener('click', function() {
    var menu = document.getElementById('menu');
    menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
});

window.addEventListener('resize', function() {
    var menu = document.getElementById('menu');
    if (window.innerWidth >= 768) {
        menu.style.display = 'none';
    }
});
</script>
</body>
</html>
