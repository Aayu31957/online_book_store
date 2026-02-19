  <?php

include 'config.php';

session_start();

$admin_name = $_SESSION['admin_name'];

if(!isset($admin_name)){
   header('location:login.php');
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

  <!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="admin.css">
</head>
<body>
     <?php include 'admin_header.php'; ?>
    <section class="users">
      <h1 class="title"> user account </h1>
      <div class="box2">
        <?php
        $select_users = mysqli_query($conn,"SELECT * FROM `user_form`") or die('query failed');
        while($fetch_users = mysqli_fetch_assoc($select_users)){
        ?>
        <div class="box">
          <p> username : <span> <?php echo $fetch_users['name'];  ?>  </span> </p>
          <p> email : <span> <?php echo $fetch_users['email'];  ?>  </span> </p>
          <p> user type : <span> <?php echo $fetch_users['user_type'];  ?>  </span> </p>
           <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this users?');" class="delete-btn">delete</a>
         </form>
        </div>
            <?php
            };
            ?>
      </div>
</section>

      
   <script src="admin_script.js"> </script>
</body>
</html>
