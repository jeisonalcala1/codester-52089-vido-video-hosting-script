<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('LOCATION:/vd-admin.php'); 
    die();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Reset PIN</title>
</head>
<body class="bg-gray-100">
    <?php include 'include/header.php'; ?>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-extrabold text-center mb-8 text-gray-800">Reset PIN</h1>
        <div class="flex justify-center mb-8">
            <div class="bg-white shadow rounded-lg p-1">
                <ul class="flex space-x-1">
                    <li class="tab-item active">
                        <a href="general.php" class="py-3 px-4 block text-gray-600 font-semibold transition duration-300">General</a>
                    </li>
                    <li class="tab-item">
                        <a href="reset.php" class="py-3 px-4 block text-blue-600 font-semibold">Reset PIN</a>
                    </li>
                    <li class="tab-item">
                        <a href="views.php" class="py-3 px-4 block text-gray-600 font-semibold">Fake Views</a>
                    </li>
                    
                </ul>
            </div>
        </div>

        <div class="mb-6">
            <?php
                // Include pin.php file
                include('../include/pin.php');

                // Display the current PIN (hashed)
                echo "<div class='text-center text-gray-700 text-xl'>
                        Default Admin PIN is: <strong class='text-blue-600'>1234</strong>
                      </div>";
            ?>
        </div>

        <form action="" method="POST" class="mb-6" id="resetForm">
            <label for="new_pin" class="block text-gray-700">Reset Admin PIN:</label>
            <input type="password" name="new_pin" id="new_pin" required class="mt-2 p-2 border border-gray-300 rounded w-full" 
                   placeholder="Encrypt by Argon2i" pattern="\d*" inputmode="numeric">
            <button type="button" onclick="openModal()" class="mt-4 w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition-colors duration-200">
                Save New PIN
            </button>
        </form>

        <?php
        // Handle form submission to save the new PIN
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil PIN baru dari form
            $newPIN = $_POST['new_pin'];

            // Enkripsi PIN menggunakan Argon2
            $hashedPIN = password_hash($newPIN, PASSWORD_ARGON2I);

            // Simpan hashed PIN ke dalam pin.php
            $pinFile = '../include/pin.php';
            file_put_contents($pinFile, "<?php\n\n\$adminPIN = '$hashedPIN';\n\n?>");

            // Tampilkan pesan sukses
            echo "<div class='mt-4 text-center text-green-600'>Success!</div>";
        }
        ?>

        <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-8 rounded shadow-lg w-1/2 max-w-md">
                <p class="text-gray-700 mb-4 text-center">Are you sure you want to save these changes?</p>
                <div class="flex justify-center gap-4">
                    <button onclick="proceedSave()" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Save</button>
                    <button onclick="cancelSave()" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Cancel</button>
                </div>
            </div>
        </div>

    </div>
<?php include 'include/footer.php'; ?>
    <script>
    // Open the confirmation modal
    function openModal() {
        document.getElementById('confirmationModal').classList.remove('hidden');
    }

    // Close the confirmation modal
    function cancelSave() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    // Proceed with form submission
    function proceedSave() {
        document.getElementById('resetForm').submit();
    }

    document.getElementById('menu-button')?.addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
    </script>
</body>
</html>
