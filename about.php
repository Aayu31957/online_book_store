<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ABOUT</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="s2.css">

</head>
<body>

<?php include 'header.php'; ?>

   <div class="heading">
   <h3> about us </h3>
   <p> <a href="home.php">Home</a> / About </p>
   </div>

<!-- about page  -->
 <section class="about">
   <div class="flex">
      <div class="image">
         <img src="uploaded_img/about.jpg" alt="">
      </div>
      <div class="content">
         <h3>Why choose us?</h3>
         <p>At Bookly, we believe that every reader deserves easy access to knowledge, stories, and inspiration. 
            We offer a wide collection of books across all genres, carefully selected to meet every taste. </p>
          <p>  With our affordable prices, fast doorstep delivery, and dedicated customer support, Bookly makes your reading journey
             simple, enjoyable, and hassle-free. Choose us because your love for books is our passion.</p>
         <a href="contacts.php" class="white-btn">Contact us</a>
      </div>
      </div>
      </section>
      <section class="reviews">
         <h1 class="title">Client's reviews</h1>
         <div class="box-container">
            <div class="box">
               <img src="uploaded_img/pic-1.jpg" alt="">
               <p> Bookly always delivers on time, and the books are in perfect condition. </p>
               <div class="starts">
                  <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
</div>
               <h3>  Pinal_Br</h3>
</div>
               <div class="box">
               <img src="uploaded_img/pic-2.jpg" alt="">
               <p> With Bookly, you don't just buy books,you build memories, ideas, and dreams. </p>
               <div class="starts">
                  <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
</div>
               <h3>Maitri_Kp</h3>
</div>
               
            <div class="box">
               <img src="uploaded_img/pic-4.png" alt="">
               <p> This is my favorite online bookstore. Great service and genuine books.</p>
               <div class="starts">
                  <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star"></i>
                 <i class="fas fa-star-half-alt"></i>
</div>
               <h3>Ankit Joshi</h3>
</div>
           
</div>
</section>
































<?php include 'footer.php'; ?>
</body>
</html>























<script src="script.js"></script>

</body>
</html>