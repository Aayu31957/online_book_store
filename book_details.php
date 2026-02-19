<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit;
}

if(isset($_POST['add_to_cart'])){ 
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_quantity = $_POST['product_quantity'];
   $product_image = $_POST['product_image'];

   $check_cart_numbers = mysqli_query($conn,"SELECT * FROM `cart` WHERE name = '$product_name' AND user_id ='$user_id' ") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart';
   } else {
      mysqli_query($conn,"INSERT INTO `cart`(user_id,name,price,quantity,image) 
      VALUES('$user_id','$product_name', '$product_price', '$product_quantity','$product_image')") or die('query failed');
      $message[]='product added to cart!';
   }
}

// product id from URL
if(isset($_GET['id'])){
   $book_id = $_GET['id'];
   $select_product = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$book_id'") or die('query failed');
   if(mysqli_num_rows($select_product) > 0){
      $fetch_product = mysqli_fetch_assoc($select_product);
   } else {
      echo "<script>alert('Product not found!'); window.location='home.php';</script>";
      exit;
   }
} else {
   echo "<script>alert('No product selected!'); window.location='home.php';</script>";
   exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $fetch_product['name']; ?> - Book Details</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="s2.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="details">
   <h1 class="title">Book Details</h1>
   <div class="box-container">
      <form action="" method="post" class="box">
         <div class="image">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
         </div>
         <div class="content">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <p><b>Author:</b> <?php echo $fetch_product['author']; ?></p>
            <p><b>Description:</b> <?php echo $fetch_product['description']; ?></p>
            <div class="price">₹<?php echo $fetch_product['price']; ?>/-</div>

            <input type="number" min="1" name="product_quantity" value="1" class="qty">
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                        <a href="shop.php" class="btn">continue shopping</a>
         </div>
      </form>
   </div>
</section>

<?php include 'footer.php'; ?>

<script src="script.js"></script>
</body>
</html>
