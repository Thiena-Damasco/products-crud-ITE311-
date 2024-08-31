<?php
require 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
    try{
        $name = $_POST['name_'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $insert = $conn->prepare("INSERT INTO products (name_, description, price, quantity)
        VALUES (:name, :description, :price, :quantity)");
                                                              
        $insert->bindParam(":name", $name);
        $insert->bindParam(":description", $description);
        $insert->bindParam(":price", $price);
        $insert->bindParam(":quantity", $quantity);

        if($insert->execute()){
            echo "Successfully inserted";
        }
        else{
            echo "Error occured";
        }
    }
    catch (PDOException $e){
        echo "Error: ", $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
</head>
<body>
    <h2>Add Products</h2>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name_">
        <br>
        <label>Description</label>
        <input type="text" name="description">
        <br>
        <label>Price</label>
        <input type="numbers" name="price">
        <br>
        <label>Quantity</label>
        <input type="numbers" name="quantity">
        <br>
        <button type="submit" name="submit">Add</button>
    </form>
    <a href="index.php">Back to Product List</a>
</body>
</html>
