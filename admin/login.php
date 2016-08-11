<?php
    session_start();
    
    if(isset($_POST['login'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //echo "entered username/password: " .$username ." " .$password ."<br>";

        $conn = new mysqli('localhost', 'robert', 'qowpie893', 'rcms');
        if($conn->connect_error){
        	die("Connection failed: " .$conn->connect_error);
        }
        
        $sql ="SELECT * FROM users WHERE username = '$username'";
        $result= $conn->query($sql);
        if($result->num_rows > 0){
        	while($row = $result->fetch_assoc()){
        		$_SESSION['username'] = $row['username'];
        		$_SESSION['password'] = $row['password'];
        		$_SESSION['id'] = $row['id'];
        		//echo "id: " .$row["id"]. " Username: " .$row["username"] ." password: " .$row["password"] ."<br>";
        	}
        } else {
        	echo "Username does not exist!" ."<br>";
        }
        
        //echo "session username: " .$_SESSION['username']. "<br>"; 
        
        if($username == $_SESSION['username'] && $password == $_SESSION['password']){
        	header("Location: postEdit.php");
        } else {
        	echo "Invalid username/password.";
        }
    }
?>

<html>
<head>
    <title>Login</title>
</head>
<body>
    <a href="../index.php">Home</a>
    <a href="../about.php">About Us</a>
    <a href="../newsPhotos.php">News Photos</a>
    <h1>Login</h1>
    <form action='login.php' method='post' enctype='multipart/form-data'>
        <input placeholder="Username" name='username' type='text' autofocus>
        <input placeholder='Password' name='password' type='text'>
        <input name='login' type='submit' value='Login'>
    </form>
    <p>Don't have a username and password?</p><a href="register.php">Register!</a>
    <a href="login.php">Login</a>
    <a href="logout.php">Logout</a>
    <a href="postEdit.php">Test</a>
</body>
</html>
