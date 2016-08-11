<?php
    if(!class_exists('DB')){
        class DB{

            public function __construct(){

                $servername = "localhost";
                $username = "robert";
                $password = "qowpie893";
                $database = "rcms";

                $connection = new mysqli($servername, $username, $password, $database);

                if($connection->connect_error){
                    die("Connection Failed: " . $connection->connect_error);
                }
                //echo "Connected successfully";
                $this->connection = $connection;
            }

            public function insert($query){
                $result = $this->connection->query($query);
                return $result;
            }

            public function select($query){
                $result = $this->connection->query($query);
                while($obj = $result->fetch_object()){
                    $results[] = $obj;
                }
                return $results;
            }
        }
    }
    $db = new DB;
?>
