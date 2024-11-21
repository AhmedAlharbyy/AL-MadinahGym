<?php

include '../components/connect.php';
if(isset($_COOKIE['id'])){
   $id = $_COOKIE['id'];
}else{
   $id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){
   $delete_id = $_POST['gym_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_gym = $conn->prepare(" DELETE  FROM `gym_dscr` WHERE id = ?  LIMIT 1");
   $verify_gym->execute([$delete_id]);

   if($verify_gym->rowCount() > 0){
   $delete_gym_thumb = $conn->prepare("DELETE  FROM `gym_info` WHERE id = ? LIMIT 1");
   $delete_gym_thumb->execute([$delete_id]);
   $verify_gym = $delete_gym_thumb->fetch(PDO::FETCH_ASSOC);
 //  unlink('../uploaded_files/'.$verify_gym['thumb']);
   $message[] = 'gym deleted!';
   }else{
      $message[] = 'gym already deleted!';
   }
}
$select_gyms = $conn->prepare("SELECT * FROM `gym` WHERE id = ?");
$select_gyms->execute([$id]);
$total_gyms = $select_gyms->rowCount();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta gymName="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php include '../components/admin_header.php'; ?>
<section class="dashboard">

   <h1 class="heading" style="text-align :center">طلبات الانضمام  </h1>

   <div class="box-container">

     

       <?php
         $select_gym = $conn->prepare("SELECT * FROM `gym_dscr` WHERE states = ? ");
         $select_gym->execute(["0"]);
         if($select_gym->rowCount() > 0)
         {
            while($fetch_gym = $select_gym->fetch(PDO::FETCH_ASSOC)){
           
      ?>
      
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($fetch_gym['states'] == 'accepted'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_gym['states'] == 'accepted'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_gym['states']; ?></span></div>
         </div>
         <div class="thumb">
           
            <img src="../uploaded_files/<?= $fetch_gym['thumb']; ?>" alt="">
         </div>
         <h3 class="title"><?= $fetch_gym['title']; ?></h3>
         <p class="description"><?= $fetch_gym['descriptions']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="gym_id" value="<?= $fetch_gym['id']; ?>">
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this gym?');" name="delete">
         </form>
         <a href="accept.php?get_id=<?= $fetch_gym['id']; ?>" class="btn"> قبول الطلب</a>
      </div>

      <?php
            }
         }
         else{
            echo '<p class="empty">no gym added yet!</p>';
         }
      ?>
       
   </div>

</section>















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>*/