<?php
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['id'] < 1){ //requires the user to be logged in.
        header("Location: admin/login.php");
    }    

    require("includes/db.php");
    
    if(isset($_GET['action']) && $_GET['action']=="add"){
        $cid=intval($_GET['cid']);
        if(isset($_SESSION['cart'][$cid])){
            $_SESSION['cart'][$cid]['quantity']++;
        } else {
            $sql2="SELECT * FROM Products WHERE id_product={$cid}";
            $result2= $conn->query($sql2);
            if(mysqli_num_rows($result2) !=0){
                $row2=mysqli_fetch_array($result2);

                $_SESSION['cart'][$row2['id_product']]=array("quantity" => 1, "price" => $row2['price']);
            } else {
                $messege="This product id is invalid.";
            }
        }
    }
?>

<html>
    <head>
        <title>Products</title>
    </head>

    <body>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="products.php">Shop</a>

        <h1>Product List</h1>
        <?php
            if(isset($message)){
                echo "<h2>$message</h2>";
            }
        ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql ="SELECT * FROM Products ORDER BY name ASC"; //displays items from the database
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['price'] ?></td>
                    <td><a href="products.php?&action=add&cid=<?php echo $row['id_product'] ?>">Add to Cart</a>
                </tr>
                <?php
                    }
                ?>
                
            </table>
        <h1>Cart</h1>
        <?php
            if(isset($_SESSION['cart'])){ //Shows current cart.
                $sql3="SELECT * FROM Products WHERE id_product IN(";
                foreach($_SESSION['cart'] as $id => $value) {
                    $sql3.=$id.",";
                }

                $sql3=substr($sql3, 0, -1).") ORDER BY name ASC";
                $result3= $conn->query($sql3);
                while($row3= $result3->fetch_array()){
        ?>
            <p><?php echo $row3['name'] ?> x <?php echo $_SESSION['cart'][$row3['id_product']]['quantity'] ?></p>
            <?php
            }
            ?>
            <hr />
            <a href="cart.php">Go to cart</a>
            <?php
            } 
            if(!isset($_SESSION['cart'])) {
                echo "<p>Your cart is empty</p>";
            }

            $conn->close();
        ?>
        <a href="admin/login.php">Login</a>
        <a href="admin/logout.php">Logout</a>
        <a href="admin/register.php">Register</a>
    </body>
</html>
