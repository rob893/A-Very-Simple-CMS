<?php
    require_once('class-db.php');
    if(!class_exists('QUERY')){
        class QUERY{
            public function all_posts(){
                global $db;
                $query= "SELECT * FROM posts ORDER BY posts.ID DESC";
                return $db->select($query);
            }

            public function post($postid){
                global $db;
                $query = "SELECT * FROM posts WHERE ID ='$postid'";
                return $db->select($query);
            }
        }
    }
    $query = new QUERY;
?>
