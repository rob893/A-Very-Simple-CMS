<?php
    require_once('class-db.php');
    if(!class_exists('INSERT')){
        class INSERT{
            public function post($postdata){
                global $db;
                $category = serialize($postdata['post_category']);
                $query = "INSERT INTO posts(post_title, post_content, post_category) VALUES ('$postdata[post_title]', '$postdata[post_content]', '$category')";
                return $db->insert($query);
            }
        }
 
    }
    $insert = new INSERT;
?>
