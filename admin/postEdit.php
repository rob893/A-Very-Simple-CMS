<?php
  session_start();  
  if(!isset($_SESSION['id']) || $_SESSION['id'] < 1){
  	header("Location: login.php");
  }    
    if(!empty($_POST)){
        
        $conn = new mysqli('localhost', 'robert', '(removed)', 'rcms');
        if($conn->connect_error){
        	die("Connection failed: " .$conn->connect_error);
        }
    
        $posttitle = $_POST['post_title'];
        $postcontent = $_POST['post_content'];
        
        $sql = "INSERT INTO posts(post_title, post_content) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $title, $content);

        $title = $_POST['post_title'];
        $content = $_POST['post_content'];
        $stmt->execute();
        
        echo "<p>New post added!</p>";

        $stmt->close();
        $conn->close();
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
                <input name="submit" type="submit" value="Submit"/>
            </p>
        </form>
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
        <a href="register.php">Register</a>
    </body>
</html>
