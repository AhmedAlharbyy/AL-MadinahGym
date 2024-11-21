<?php

include 'components/connect.php';
if(isset($_COOKIE['id'])){
   $user_id = $_COOKIE['id'];
}else{
   $user_id = '';
}
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:home.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gyms</title>
   <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="dashboard">

   <h1 class="heading">معلومات النادي</h1>



 
      <?php
         $select_gym = $conn->prepare("SELECT * FROM `gym_dscr` WHERE id = ? and states = ? LIMIT 1");
         $select_gym->execute([$get_id, 'accepted']);
         if($select_gym->rowCount() > 0){
            $fetch_gym = $select_gym->fetch(PDO::FETCH_ASSOC);
            $fetch_gym_ifo = $conn->prepare("SELECT * FROM `gym_info` WHERE id = ?");
            $fetch_gym_ifo->execute([$get_id]);
            $gym_ifo = $fetch_gym_ifo->fetch(PDO::FETCH_ASSOC);

      ?>
    <div class="box-container">   
         <div class="box">
                     

            <div class="thumb">

               <img src="uploaded_files/<?= $fetch_gym['thumb']; ?>" alt="">

            </div>
                        
                           
                           <h1>  اسم النادي   :<?= $fetch_gym['title']; ?>  </h1>
                           <h1>     موقع النادي :<?= $gym_ifo['locations']; ?> </h1>
                           <h1> الجنس المحدد <?= $gym_ifo['gender']; ?></h1>
                           <h1>سعر الاشتراك الشهري    : <?= $gym_ifo['price']; ?></h1>
                     
                  
         </div>
         <?php
            }else{
               echo '<p class="empty">this gym was not found!</p>';
            }  
         ?>
      </div>
</section>
<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>