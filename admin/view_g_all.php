<?php

include '../components/connect.php';

// if(isset($_COOKIE['id'])){
//    $id = $_COOKIE['id'];
// }
if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:gyms.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>تفاصيل النوادي</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
<?php include '../components/control_header.php'; ?>
   
<section class="playlist-details">

</section>

<section class="contents">

   <h1 class="heading"> النوادي</h1>

   <div class="box-container">

   <?php
      $select_gym = $conn->prepare("SELECT * FROM `gym_dscr` WHERE id =?");
      $select_gym->execute([$get_id]);
      $fecth_gyms = $select_gym->fetch(PDO::FETCH_ASSOC);
      
      $fetch_gym_ifo = $conn->prepare("SELECT * FROM `gym_info` WHERE id = ?");
      $fetch_gym_ifo->execute([$get_id]);
      $gym_ifo = $fetch_gym_ifo->fetch(PDO::FETCH_ASSOC);
           
   ?>
      <div class="box">
         <div class="flex">
            <div>السجل التجاري <i class="fas fa-dot-circle" style="<?php if($fecth_gyms['states'] == 'accepted'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fecth_gyms['states'] == 'accepted'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fecth_gyms['states']; ?></span></div>
            <div><i class=""></i><span><?= $fecth_gyms['descriptions']; ?></span></div>
         </div>
         <img src="../uploaded_files/<?= $fecth_gyms['thumb']; ?>" class="thumb" alt="">
         <h1 class="title"><?= $fecth_gyms['title']; ?></h1>
         <div class="title"><h1>  <span>   موقع النادي :<?= $gym_ifo['locations']; ?> </span></h1></div>
         <div class="title"><h1><?= $gym_ifo['gender']; ?></h1></div>
         <div class="title"><h1><span>سعر الاشتراك الشهري  : <?= $gym_ifo['price']; ?>رس</span></h1></div>
      </div>
   <?php
         
      
   ?>

   </div>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>