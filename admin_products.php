<?php
@include 'config.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
    exit;
}

// ADD PRODUCT
if(isset($_POST['add_product']) && isset($_FILES['image'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name='$name'") or die('query failed');

    if(mysqli_num_rows($select_product_name) > 0){
        $message[] = 'Product name already added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, author, description) VALUES('$name','$price','$image','$author','$description')") or die('query failed');

        if($add_product_query){
            if($image_size > 2000000){
                $message[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Product added successfully';
            }
        } else {
            $message[] = 'Product could not be added!';
        }
    }
}

// DELETE PRODUCT
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id='$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/'.$fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id='$delete_id'") or die('query failed');
    header('location:admin_products.php');
    exit;
}

// UPDATE PRODUCT
if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_author = mysqli_real_escape_string($conn, $_POST['update_author']);
    $update_price = $_POST['update_price'];
    $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);
    $update_old_image = $_POST['update_old_image'];

    $update_image = isset($_FILES['update_image']['name']) ? $_FILES['update_image']['name'] : '';
    $update_image_tmp_name = isset($_FILES['update_image']['tmp_name']) ? $_FILES['update_image']['tmp_name'] : '';
    $update_image_size = isset($_FILES['update_image']['size']) ? $_FILES['update_image']['size'] : 0;
    $update_folder = 'uploaded_img/'.$update_image;

    if(isset($_POST['update_product'])){
    // ...existing update code...

    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $_SESSION['message'] = 'Image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `products` SET name='$update_name', author='$update_author', image='$update_image', price='$update_price', description='$update_description' WHERE id='$update_p_id'");
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/'.$update_old_image);
            $_SESSION['message'] = 'Product updated successfully';
        }
    } else {
        mysqli_query($conn, "UPDATE `products` SET name='$update_name', author='$update_author', price='$update_price', description='$update_description' WHERE id='$update_p_id'");
        $_SESSION['message'] = 'Product updated successfully';
    }
    header('location:admin_products.php');
    exit;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Products</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="admin.css">
</head>
<body>
<?php
if(isset($_SESSION['message'])){
   echo '
   <div class="message">
      <span>'.$_SESSION['message'].'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
   unset($_SESSION['message']); // clear after showing
}
?>
<?php include 'admin_header.php'; ?>

<!-- ADD PRODUCTS -->
<section class="add-products">
    <h1 class="title">Shop Products</h1>
    <form action="" method="POST" enctype="multipart/form-data"> 
        <h3>Add Product</h3>
        <input type="text" name="name" class="box" placeholder="Enter product name" required>
        <input type="text" name="author" class="box" placeholder="Enter author name" required>
        <textarea name="description" class="box" placeholder="Enter description" required></textarea>
        <input type="number" name="price" class="box" placeholder="Enter product price" required>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>
        <input type="submit" value="Add Product" name="add_product" class="btn">
    </form>
</section>

<!-- SHOW PRODUCTS -->
<section class="show-products">
    <div class="box2">
    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
    if(mysqli_num_rows($select_products) > 0){
        while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
        <div class="box">
            <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="name"><?php echo $fetch_products['name']; ?></div>
            <div class="author"><?php echo $fetch_products['author']; ?></div>
            <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
            <div class="description"><?php echo $fetch_products['description']; ?></div>
            <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
            <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
        </div>
    <?php
        }
    } else {
        echo '<p class="empty">No products added yet!</p>';
    }
    ?>
    </div>
</section>

<!-- EDIT PRODUCT FORM -->
<section class="edit-product-form">
<?php
if(isset($_GET['update'])){
    $update_id = $_GET['update'];
    $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$update_id'") or die('query failed');
    if(mysqli_num_rows($update_query) > 0){
        $fetch_update = mysqli_fetch_assoc($update_query);
?>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
        <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="Enter product name">
        <input type="text" name="update_author" value="<?php echo $fetch_update['author']; ?>" class="box" required placeholder="Enter author name">
        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="Enter product price">
        <textarea name="update_description" class="box" required placeholder="Enter description"><?php echo $fetch_update['description']; ?></textarea>
        <input type="file" name="update_image" class="box" accept="image/jpg, image/jpeg, image/png">
        <input type="submit" value="Update" name="update_product" class="btn">
        <input type="button" value="Cancel" onclick="window.location.href='admin_products.php';" class="option-btn">
    </form>
<?php
    }
}
 else {
    echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
}
?>
</section>

<script src="admin_script.js"></script>
</body>
</html>
