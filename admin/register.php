<?php
    if(isset($_POST['register'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $conn = new mysqli('localhost', 'robert', 'qowpie893', 'rcms');
        if($conn->connect_error){
        	die("Connection failed: " .$conn->connect_error);
        }
        
        $sql ="INSERT INTO users (username, password) 
            VALUES ('$username', '$password')";

        if($conn->query($sql) === true){
            echo "Registered successfully!";
        } else {
            echo "Error: " .$sql . "<br>" .$conn->error;
        }
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
