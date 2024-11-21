<?php

include '../components/connect.php';

if(isset($_COOKIE['id'])){
   $id = $_COOKIE['id'];
}else{
   $id = '';
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="contents">

   <h1 class="heading">contents</h1>

   <div class="box-container">
   <?php
      if(isset($_POST['search']) or isset($_POST['search_btn'])){
      $search = $_POST['search'];
      $select_gym = $conn->prepare("SELECT * FROM `gym_dscr` WHERE title LIKE '%{$search}%'");
      $select_gym->execute();
      if($select_gym->rowCount() > 0){
         while($fecth_gyms = $select_gym->fetch(PDO::FETCH_ASSOC)){    
         $get_id = $fecth_gyms['id'];
         // $fetch_gym_ifo = $conn->prepare("SELECT * FROM `gym_info` WHERE id = ?");
         // $fetch_gym_ifo->execute([$get_id]);
         // $gym_ifo = $fetch_gym_ifo->fetch(PDO::FETCH_ASSOC);
   ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-dot-circle" style="<?php if($fecth_gyms['states'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fecth_gyms['states'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fecth_gyms['states']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fecth_gyms['title']; ?></span></div>
         </div>
         <img src="../uploaded_files/<?= $fecth_gyms['thumb']; ?>" class="thumb" alt="">
         <h3 class="title"><?= $fecth_gyms['title']; ?></h3>
         <form action="" method="post" class="flex-btn">
           
            <a href="update_gym.php?get_id=<?= $get_id; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
         </form>
         <a href="view_gym.php?get_id=<?= $get_id; ?>" class="btn">view content</a>
      </div>
   <?php
         }
      }else{
         echo '<p class="empty">no contents founds!</p>';
      }
   }else{
      echo '<p class="empty">please search something!</p>';
   }
   ?>

   </div>

</section>
















<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>