<?php
require 'config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    try{
        $query = $conn->prepare("DELETE FROM products WHERE id_ = :id");
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if($query->execute()){
            echo "Product deleted successfully";
        }
        else{
            echo "Failed to delete item";
        }
    }
    catch(PDOException $e){
        echo  "Error: " . $e->getMessage();
        exit;
    }
}
else{
    echo "Invalid ID";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <a href="index.php">Back to Product List</a>
</body>
</html>
