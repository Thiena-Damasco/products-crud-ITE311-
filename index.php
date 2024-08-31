<?php
require 'config.php';

try{
    $query = $conn->query("SELECT * FROM products");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <a href="add.php">Create new product</a>
    <h2>Product List</h2>
    <?php if (!empty($products)): ?>
        <table border="1">
            <thead>                                                                                      
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id_'])?></td>
                    <td><?php echo htmlspecialchars($product['name_'])?></td>
                    <td><?php echo htmlspecialchars($product['description'])?></td>
                    <td><?php echo htmlspecialchars($product['price'])?></td>
                    <td><?php echo htmlspecialchars($product['quantity'])?></td>
                    <td>
                        <a href="edit.php? id=<?php echo $product['id_']?>"><button>Edit</button></a>
                        <a href="delete.php? id=<?php echo $product['id_']?>"><button>Delete</button></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
</body>
</html>                                                                                                                     


