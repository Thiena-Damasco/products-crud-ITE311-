<?php
require 'config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    try{
        $query = $conn->prepare("SELECT * FROM products WHERE id_ = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if(!$product) {
            echo "Product not found";
            exit;
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name_'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];

            $update = $conn->prepare("UPDATE  products SET name_ = :name, description = :description, price = :price, quantity = :quantity, updated_at = NOW() WHERE id_ = :id");
            $update->bindParam(':name', $name);
            $update->bindParam(':description', $description);
            $update->bindParam(':price', $price);
            $update->bindParam(':quantity', $quantity);
            $update->bindParam(':id', $id, PDO::PARAM_INT);
            
            if($update->execute()) {
                echo "Product updated successfully";
            }
            else{
                echo "Failed to update product";
            }
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
else{
    echo "ID not found";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name_" value="<?php echo htmlspecialchars($product['name_'])?>" required>
        <br>
        <label>Description</label>
        <input type="text" name="description"  value="<?php echo htmlspecialchars($product['description'])?>" required>
        <br>
        <label>Price</label>
        <input type="text" name="price" value="<?php echo htmlspecialchars($product['price'])?>" required>
        <br>
        <label>Quantity</label>
        <input type="text" name="quantity" value="<?php echo htmlspecialchars($product['quantity'])?>" required>
        <br>
        <button type="submit">Update</button>
    </form>
    <a href="index.php">Back to Product List</a>
</body>
</html>
