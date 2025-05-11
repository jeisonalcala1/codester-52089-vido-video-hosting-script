<?php include 'include/head.php'; ?>
<?php include 'include/config.php'; ?>
<?php
$adsData = json_decode(file_get_contents('./include/json/ad.json'), true);

$topPlayerAd = $adsData['top_player_ad'] ?? '';
$bottomPlayerAd = $adsData['bottom_player_ad'] ?? '';
$aboveFooterPlayer = $adsData['above_footer_player'] ?? '';
$underWelcomeMessageHome = $adsData['under_welcome_message_home'] ?? '';
$aboveFooterHome = $adsData['above_footer_home'] ?? '';
?>

<div class="container mx-auto mt-8 py-36">
    <div id="upload-info">
        <h1 class="text-3xl font-medium text-center">Free and Simple<br> short video hosting</h1><br>
        <h3 class="text-l text-center">Just select or drop a MP4 file.<br><?php echo $fileSizeLimitText; ?></h3>
    </div>
    <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data" class="mt-8 flex flex-col items-center">
        <label class="border border-gray-300 rounded cursor-pointer text-lg animate-gradient flex items-center justify-center" id="browse-label" style="width: 150px; height: 35px;">
            Browse
            <input type="file" name="video" accept="video/mp4" class="hidden" id="video-input">
        </label>
        <br><br><br>
        <div id="upload-status" class="text-xl font-semibold text-center hidden">
            <h2>Upload Process...</h2>
            <h4 id="upload-percentage">0%</h4>
        </div>
        <div id="upload-error" class="text-red-500 text-center hidden">
            <h4><?php echo $fileSizeLimitText; ?></h4>
        </div>
    </form>
</div>

<!-- SEO Support Sections -->
<div class="container mx-auto my-16 px-4 space-y-16">
    <!-- About Section -->
    <section id="about" class="py-8">
        <h2 class="text-3xl font-semibold mb-4 text-center">About <?php echo $titleHeader; ?></h2>
        <p class="text-lg text-center">
            <?php echo $titleHeader; ?> provides a free and straightforward solution for hosting your short videos. Enjoy seamless uploads with high-quality streaming capabilities. Share your videos effortlessly and reach your audience without any limitations.
        </p>
    </section>
    <div class="mt-4 ad-container responsive-ad">
    <?php echo $underWelcomeMessageHome; ?>
</div>

    <!-- Features Section -->
    <section id="features" class="bg-white border border-gray-300 p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-4 text-center">Key Features</h2>
        <ul class="list-disc list-inside text-lg mx-auto max-w-xl space-y-2">
            <li class="flex items-start"><span class="text-blue-600 mr-2"><i class="bi bi-check" style="font-size: 2rem;"></i> 
</span> Free video hosting for MP4 files up to <?php echo $fileSizeLimitText; ?></li>
            <li class="flex items-start"><span class="text-blue-600 mr-2"><i class="bi bi-check" style="font-size: 2rem;"></i></span> Easy drag-and-drop interface</li>
            <li class="flex items-start"><span class="text-blue-600 mr-2"><i class="bi bi-check" style="font-size: 2rem;"></i></span> Secure and fast video upload process</li>
            <li class="flex items-start"><span class="text-blue-600 mr-2"><i class="bi bi-check" style="font-size: 2rem;"></i></span> Responsive video player powered by <?php echo $titleHeader; ?> media player</li>
            <li class="flex items-start"><span class="text-blue-600 mr-2"><i class="bi bi-check" style="font-size: 2rem;"></i></span> Simple sharing options for social media</li>
        </ul>
    </section>

    <!-- How-To Section -->
    <section id="how-to" class="py-8">
        <h2 class="text-3xl font-semibold mb-4 text-center">How to Upload Your Video</h2>
        <ol class="list-decimal list-inside text-lg mx-auto max-w-xl space-y-2">
            <li>Click the "Browse" button to select your MP4 file.</li>
            <li>Ensure the file size is below <?php echo $fileSizeLimitText; ?>.</li>
            <li>Wait for the upload process to complete, and your video will be available online.</li>
        </ol>
    </section>


    <!-- Benefits of Using Our Service -->
    <section id="benefits" class="bg-gray-50 p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-4 text-center">Why Choose <?php echo $titleHeader; ?> for Video Hosting?</h2>
        <p class="text-lg text-center max-w-2xl mx-auto">
            <?php echo $titleHeader; ?> provides a reliable, secure, and free solution for short video hosting. With our easy-to-use interface and rapid upload process, your videos can be online and shareable within seconds. Ideal for creators, businesses, and individuals who need an efficient way to share videos with a wide audience.
        </p>
    </section>
    <div class="mt-4 ad-container responsive-ad">
    <?php echo $aboveFooterHome; ?>
</div>
</div>
<?php include 'include/footer.php'; ?>


<script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
<script>
    const maxFileSize = <?php echo $maxFileSize; ?>;
</script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
