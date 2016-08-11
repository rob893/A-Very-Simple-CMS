<?php
    session_start();
    $_SESSION['username'] = "";
    $_SESSION['password'] = "";
    $_SESSION['id'] = 0;
?>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <a href="../index.php">Home</a>
    <a href="../about.php">About Us</a>
    <a href="../newsPhotos.php">News Photos</a>
    <p>You are now logged out!</p>
    <a href="login.php">Login</a>
    <a href="logout.php">Logout</a>
    <a href="postEdit.php">Test</a>
</body>
<html>
