<?php
session_start();
if (isset($_SESSION['login'])) {
    header('LOCATION:/admin/');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
<div class="container">
    <div class="panda">
        <div class="ear"></div>
        <div class="face">
            <div class="eye-shade"></div>
            <div class="eye-white">
                <div class="eye-ball"></div>
            </div>
            <div class="eye-shade rgt"></div>
            <div class="eye-white rgt">
                <div class="eye-ball"></div>
            </div>
            <div class="nose"></div>
            <div class="mouth"></div>
        </div>
        <div class="body"></div>
        <div class="foot">
            <div class="finger"></div>
        </div>
        <div class="foot rgt">
            <div class="finger"></div>
        </div>
    </div>

    <?php
    include 'include/pin.php'; // Sertakan pin.php untuk mengakses $adminPIN yang ter-hash

    if (isset($_POST['submit'])) {
        $password = $_POST['password'];

        // Verifikasi password dengan hash yang ada
        if (password_verify($password, $adminPIN)) { // Bandingkan dengan hash
            $_SESSION['login'] = true;
            header('LOCATION:/admin/');
            die();
        } else {
            $errorMessage = "Wrong password..!!";
        }
    } else {
        $errorMessage = "";
    }
    ?>

    <form method="post">
        <div class="hand"></div>
        <div class="hand rgt"></div>
        <h1>Hi Bro..</h1>

        <div class="form-group">
            <input id="password" name="password" type="password" required="required" class="form-control" placeholder="PIN Access"
                   inputmode="numeric" pattern="[0-9]*"/>
            <p class="alert" style="<?php echo isset($errorMessage) ? "display: " . ($errorMessage ? "block" : "none") : ""; ?>">
                <?php echo $errorMessage; ?>
            </p>
            <button type="submit" name="submit" class="btn">Login</button>
        </div>
    </form>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="assets/js/login.js"></script>
</body>
</html>
