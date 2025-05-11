<?php include '../include/head2.php'; ?>
<?php include '../include/config.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Privacy Policy</h2>
        <p><strong>Effective Date:</strong> 8 June 2024</p>
        <p>This Privacy Policy is designed to help you understand how we collect, use, disclose, and safeguard your personal information. By using <?php echo $titleHeader; ?>, you consent to the practices outlined in this Privacy Policy.</p>
        
        <h2 class="text-xl font-semibold mt-6">1. Information We Collect:</h2>
        <p class="mt-2"><strong>User-Provided Information:</strong> We do not require users to create accounts. However, we may collect information you voluntarily provide, such as videos you upload.</p>
        <p><strong>Automatically Collected Information:</strong> We may collect certain information automatically, including but not limited to your IP address, device type, and browser type.</p>
        
        <h2 class="text-xl font-semibold mt-6">2. Cookies and Tracking Technologies:</h2>
        <p class="mt-2"><strong>Cookies:</strong> We use cookies to enhance your experience and for analytics purposes. You can disable cookies in your browser settings, but this may affect the functionality of <?php echo $titleHeader; ?>.</p>
        <p><strong>Google Analytics:</strong> We utilize Google Analytics to analyze website traffic and user behavior. Google Analytics may collect information about your use of <?php echo $titleHeader; ?>. For more information on Google Analytics, please visit <a href="https://policies.google.com/privacy" class="text-blue-500">Google Analytics Privacy & Terms</a>.</p>
        
        <h2 class="text-xl font-semibold mt-6">3. Advertisements:</h2>
        <p class="mt-2"><strong>Third-Party Advertisements:</strong> We may display advertisements through Google and other partners. These third parties may use cookies and similar technologies to collect information about your interaction with advertisements. Please refer to their respective privacy policies for more details.</p>
        
        <h2 class="text-xl font-semibold mt-6">4. How We Use Your Information:</h2>
        <p class="mt-2">We may use the information we collect for various purposes, including improving and customizing <?php echo $titleHeader; ?>, analyzing trends, and serving relevant advertisements.</p>
        <p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent.</p>
        
        <h2 class="text-xl font-semibold mt-6">5. Data Security:</h2>
        <p class="mt-2">We implement reasonable security measures to protect your personal information. However, no method of transmission over the internet or electronic storage is completely secure, and we cannot guarantee absolute security.</p>
        
        <h2 class="text-xl font-semibold mt-6">6. GDPR Compliance:</h2>
        <p class="mt-2"><strong>Rights of EU Users:</strong> If you are a user located in the European Union, you have certain rights under the General Data Protection Regulation (GDPR), including the right to access, rectify, or erase your personal data. To exercise these rights, please contact us at <?php echo $emailReport; ?></p>
        <p><strong>Lawful Basis for Processing:</strong> We process personal data based on the lawful bases outlined in the GDPR, including user consent and legitimate interests.</p>
        
        <h2 class="text-xl font-semibold mt-6">7. Changes to This Privacy Policy:</h2>
        <p class="mt-2">We may update this Privacy Policy from time to time. Any changes will be effective immediately upon posting the revised policy on <?php echo $titleHeader; ?>. We encourage you to review this Privacy Policy regularly.</p>
        
        <h2 class="text-xl font-semibold mt-6">8. Contact Information:</h2>
        <p class="mt-2">If you have any questions or concerns about this Privacy Policy, please contact us at <?php echo $emailReport; ?></p>
        
        <p class="mt-6">By using <?php echo $titleHeader; ?>, you acknowledge that you have read and understood this Privacy Policy.</p>
    </div>
    <script>  
  document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
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