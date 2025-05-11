<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration - Step 3</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-lg">
        <div class="flex items-center mb-6">
            <i class="bi bi-lock-fill text-blue-600 text-3xl mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">Admin PIN</h2>
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

        <form action="" method="POST" class="mb-6">
            <label for="new_pin" class="block text-gray-700">Create New Admin PIN:</label>
            <input type="password" name="new_pin" id="new_pin" required class="mt-2 p-2 border border-gray-300 rounded w-full" 
                   placeholder="Encrypt by Argon2i" pattern="\d*" inputmode="numeric">
            <button type="submit" class="mt-4 w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded transition-colors duration-200">
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

        <a href="step4.php" class="w-full block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded transition-colors duration-200">
            Next
        </a>
    </div>
</body>
</html>
