<?php
include("koneksi.php");
session_start();

if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query_cek = $mysqli->query("SELECT * FROM users where username='$user' AND password='$pass'");
    if ($query_cek->num_rows > 0) {
        $row = mysqli_fetch_assoc($query_cek);
        $_SESSION['username'] = $row['username'];
        echo $_SESSION['username'];
    } else {
        echo 'salah';
    }
    header('Location: index.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>
    <!-- partial:index.partial.html -->

    <body>
        <section class="container">
            <div class="login-container">
                <div class="circle circle-one"></div>
                <div class="form-container">
                    <h1 class="opacity">LOGIN</h1>
                    <form action="" method="POST">
                        <input type="text" name="username" placeholder="USERNAME" />
                        <input type="password" name="password" placeholder="PASSWORD" />
                        <button class="opacity" name="submit">SUBMIT</button>
                    </form>
                </div>
                <div class="circle circle-two"></div>
            </div>
            <div class="theme-btn-container"></div>
        </section>
    </body>
    <!-- partial -->
    <script src="./script.js"></script>

</body>

</html>