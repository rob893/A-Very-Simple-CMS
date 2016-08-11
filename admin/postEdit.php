<?php
  session_start();  
  if(!isset($_SESSION['id']) || $_SESSION['id'] < 1){
  	header("Location: login.php");
  }    
    if(!empty($_POST)){
        require_once('../includes/class-insert.php');

        if($insert->post($_POST)){
            echo '<p>Data inserted successfully!</p>';
        }
    }
?>
<html>
<head>
    <title>Insert Post</title>
</head>
<body>
    <a href="../index.php">Home</a>
    <a href="../about.php">About Us</a>
    <a href="../newsPhotos.php">News Photos</a>
    <h1>Create a new post.</h1>
    <form method="post">
        <p>                 
            <label for="post_title">Title</label>
            <input type="text" name="post_title"/>
        </p>
        <p>
            <label for="post_content">Body</label>
            <textarea name="post_content"></textarea>
        </p>
        <p>
            <input type="submit" value="Submit"/>
        </p>
    </form>
    <a href="login.php">Login</a>
    <a href="logout.php">Logout</a>
    <a href="register.php">Register</a>
</body>
</html>
