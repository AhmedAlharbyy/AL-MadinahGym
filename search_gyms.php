<?php

include 'components/connect.php';

if(isset($_COOKIE['id'])){
   $user_id = $_COOKIE['id'];
}else{
   $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>seriess</title>
   <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="channel1s">
   <h1 class="heading">القنوات اليمينة</h1>
   <form action="" method="post" class="search-channel">
      <input type="text" name="search_gym" maxlength="100" placeholder="search gym..." required>
      <button type="submit" name="search_gym_btn" class="fas fa-search"></button>
   </form>
   <div class="box-container">
      <?php
         if(isset($_POST['search_gym']) or isset($_POST['search_gym_btn'])){
            $search_gym = $_POST['search_gym'];
            $select_gym = $conn->prepare("SELECT * FROM `gym_dscr` WHERE title LIKE '%{$search_gym}%' and states = ? ");
            $select_gym->execute(['accepted']);
            if($select_gym->rowCount() > 0){
               while($fetch_gym = $select_gym->fetch(PDO::FETCH_ASSOC)){

                  $gym_id = $fetch_gym['id'];

                  $info_gyms = $conn->prepare("SELECT * FROM `gym_info` WHERE id = ?");
                  $info_gyms->execute([$gym_id]);
                  $fetch_ifo = $info_gyms->fetch(PDO::FETCH_ASSOC);
                  $get_id =$fetch_gym['id'];
      ?>
      <div class="box">
         <div class="channel">
            <img src="uploaded_files/<?= $fetch_gym['thumb']; ?>" alt="">
            <div>
               <h1><?= $fetch_gym['title']; ?></h1>
               
            </div>
            <div>
               <h1><?= $fetch_gym['descriptions']; ?></h1>
               
            </div>
            <a href="gym.php?get_id=<?= $get_id  ?>" class="inline-btn">عرض معلومات النادي</a>
         </div>
         
      </div>
      <?php
               }
            }else{
               echo '<p class="empty">لا توجك نتائج!</p>';
            }
         }else{
            echo '<p class="empty">من فضلك ابحث!</p>';
         }
      ?>

   </div>

</section>
<?php include 'components/footer.php'; ?>
<script src="js/script.js"></script>
   
</body>
</html>