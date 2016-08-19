<?php
    ini_set('display_errors', false);
    require_once('includes/class-query.php');

    if(!empty($_GET)){
        if(!empty($_GET['p'])){
            $post = $_GET['p'];
        }
    }
    
    if(empty($post)){
        $posts_array = $query->all_posts(); 
    } else if ( !empty($post)){
        $posts_array = $query->post($post);
    }
?>

<html>
    <head>
        <title>Totally Fake News Site</title>
    </head>
    <body>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="newsPhotos.php">News Photos</a>
        <h1>Welcome to a Totally Fake News Site!</h1>
        <?php foreach($posts_array as $post): ?>
            <div>
                <h1><a href="?p=<?php echo $post->ID;?>"><?php echo htmlspecialchars($post->post_title); ?></a></h1>
                <p><?php echo htmlspecialchars($post->post_content);?></p>
            </div>
        <?php endforeach; ?>
        <a href="admin/login.php">Login</a>
        <a href="admin/logout.php">Logout</a>
        <a href="admin/register.php">Register</a>
    </body>
</html>
