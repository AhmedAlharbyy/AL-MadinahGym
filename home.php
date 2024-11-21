<?php

include 'components/connect.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
   <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="quick-select">
   
</section>
<section class="seriess">

<h1 class="heading"> الأندية</h1>

   <div class="box-container">

      <?php
         $select_gyms = $conn->prepare("SELECT * FROM `gym_dscr` WHERE states = ? ");
         $select_gyms->execute(['accepted']);
         if($select_gyms->rowCount() > 0){
            while($fetch_gyms = $select_gyms->fetch(PDO::FETCH_ASSOC)){
               $get_id = $fetch_gyms['id'];
      ?>
      <div class="box">
         <div class="channel">
            <img src="uploaded_files/0NEOz0KWjeCRMjGc7S4G.jpg" alt="">
            <div>
               <h3><?= $fetch_gyms['title']; ?></h3>
               <span><?= $fetch_gyms['descriptions']; ?></span>
            </div>
         </div>
         <img src="uploaded_files/<?= $fetch_gyms['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fetch_gyms['title']; ?></h3>

         <a href="gym.php?get_id=<?= $get_id  ?>" class="inline-btn">عرض معلومات النادي</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">لم يتم إضافة نادي بعد!</p>';
      }
      ?>

   </div>

</section>

<!-- seriess section ends -->












<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>