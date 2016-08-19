<?php
    if(isset($_POST['register'])){
        
        $conn = new mysqli('localhost', 'robert', '(removed)', 'rcms');
        if($conn->connect_error){
        	die("Connection failed: " .$conn->connect_error);
        }

        $username = strip_tags($_POST['username']);
        $password = strip_tags($_POST['password']);

        $username = stripslashes($username);
        $password = stripslashes($password);

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        
        $password = password_hash($password, PASSWORD_DEFAULT);
         
        $sql ="INSERT INTO users (username, password) 
            VALUES ('$username', '$password')";

        if($conn->query($sql) === true){
            echo "Registered successfully!";
        } else {
            echo "Error: " .$sql . "<br>" .$conn->error;
        }

        $conn->close();
    }
?>

<html>
    <head>
        <title>Register</title>
    </head>
    <body> 
        <a href="../index.php">Home</a>
        <a href="../about.php">About Us</a>
        <a href="../newsPhotos.php">News Photos</a>
        <h1>Register</h1>
        <form action='register.php' method='post' enctype='multipart/form-data'>
            <input placeholder="Username" name='username' type='text' autofocus>
            <input placeholder='Password' name='password' type='text'>
            <input name='register' type='submit' value='Register'>
        </form>
        <a href="login.php">Login</a>
        <a href="logout.php">Logout</a>
        <a href="register.php">Register</a>
    </body>
</html>
