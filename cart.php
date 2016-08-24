<?php
    session_start();

    require("includes/db.php");
        
    if(isset($_POST['submit'])){
        foreach($_POST['quantity'] as $key => $val) {
            if($val==0) {
                unset($_SESSION['cart'][$key]);
            } else {
                $_SESSION['cart'][$key]['quantity']=$val;
            }
        }
    }
?>

<html>
    <head>
        <title>Current Cart</title>
    </head>  
    <body>
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
        <a href="products.php">Shop</a>
        
        <h1>Current Cart</h1>
        <a href="products.php">Continue Shopping</a>
        <?php
        echo $_SESSION['id'];
        if(isset($_SESSION['cart'])){
        ?>
        <form method="post" action="cart.php">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Items Price</th>
                </tr>
                <?php
                    $sql3="SELECT * FROM Products WHERE id_product IN(";
                    foreach($_SESSION['cart'] as $id => $value) {
                        $sql3.=$id.",";
                    }

                    $sql3=substr($sql3, 0, -1).") ORDER BY name ASC";
                    $result3= $conn->query($sql3);
                    $totalprice = 0;
                    while($row= $result3->fetch_array()){
                        $subtotal=$_SESSION['cart'][$row['id_product']]['quantity']*$row['price'];
                        $totalprice+=$subtotal;
                ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><input type="text" name="quantity[<?php echo $row['id_product'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id_product']]['quantity'] ?>" /></td>
                        <td>$<?php echo $row['price'] ?></td>
                        <td>$<?php echo $_SESSION['cart'][$row['id_product']]['quantity']*$row['price'] ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td>Total Price: $<?php echo $totalprice ?></td>
                </tr>
            </table>
            <br/>
            <button type="submit" name="submit">Update Cart</button>
            <button type="submit" name="order">Place Order</button>
        </form>
        <p>To remove an item, set it's quantity to 0.</p>
        <?php
            if(isset($_POST['order'])){ //checks to see if the "Place order" button was pushed. If it was, this inserts the order into the orders table.
                $sql4="INSERT INTO orders (userid, totalorderprice) VALUES (?,?)";
                $stmt = $conn->prepare($sql4);
                $stmt->bind_param("ii", $_SESSION['id'], $totalprice); //uses $_SESSION['id'], which is set to the current user, to connect the order to the user.
                $stmt->execute();
                echo "<p>Order placed!</p>";
                $stmt->close();
                
                $sql5="SELECT MAX(orderID) AS max FROM orders"; //gets the current highest orderID.
                $max = $conn->query($sql5);
                while($row3=$max->fetch_assoc()){
                    $maxID=$row3['max']; //Sets $maxID to orderID. Used when inserting into orderline.
                }
    
                $result4= $conn->query($sql3);
                while($row2=$result4->fetch_array()){ //This while loop inserts each item ordered (with their quantity) using the current orderID into orderline table.
                    $item = $row2['id_product'];
                    $amount = $_SESSION['cart'][$row2['id_product']]['quantity'];
                    $sql5="INSERT INTO orderline (orderID, id_product, Orderedquantity) VALUES (?, ?, ?)";
                    $conn->query($sql5);
                    $stmt2= $conn->prepare($sql5);
                    $stmt2->bind_param("iii", $maxID, $item, $amount);
                    $stmt2->execute();
                    $stmt2->close();
                }
            }
        } else { //This currently does not work.
            echo "<p>Your cart is empty. </p><a href='products.php'>Add items to your car.</a>";
        }
        ?>
        <a href="admin/login.php">Login</a>
        <a href="admin/logout.php">Logout</a>
        <a href="admin/register.php">Register</a>
    </body>
</html>
