<?php

include '../components/connect.php';

// if(isset($_COOKIE['id'])){
//    $id = $_COOKIE['id'];
// }else{
//    $id = '';
//    header('location:login.php');
// }

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:view_gym_for_control.php');
}
if(isset($_POST['submit'])){

   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   
   $locations =$_POST['locations'];
   $price =$_POST['price'];
   $gender =$_POST['gender'];

   $update_gym = $conn->prepare("UPDATE `gym_dscr` SET title = ?, descriptions = ?, states = ? WHERE id = ?");
   $update_gym->execute([$title, $description, $status, $get_id]);

   $update_gym_ifo = $conn->prepare("UPDATE  `gym_info` set locations = ?, price = ?, gender = ? WHERE id = ?");
   $update_gym_ifo->execute([ $locations, $price, $gender,$get_id]);

   $old_image = $_POST['old_image'];
   $old_image = filter_var($old_image, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_files/'.$rename;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `gym_dscr` SET thumb = ? WHERE id = ?");
         $update_image->execute([$rename, $get_id]);
         move_uploaded_file($image_tmp_name, $image_folder);
         if($old_image != '' AND $old_image != $rename){
            unlink('../uploaded_files/'.$old_image);
         }
      }
   } 

   $message[] = 'playlist updated!';  

}

if(isset($_POST['delete'])){
   $delete_id = $_POST['gym_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_playlist_thumb = $conn->prepare("SELECT * FROM `gym_dscr` WHERE id = ? LIMIT 1");
   $delete_playlist_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_playlist = $conn->prepare("DELETE FROM `gym_dscr` WHERE id = ?");
   $delete_playlist->execute([$delete_id]);

   
   header('location:view_gym_for_control.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Playlist</title>
   <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/control_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">update playlist</h1>

   <?php
         $select_gym = $conn->prepare("SELECT * FROM `gym_dscr` WHERE id = ?");
         $select_gym->execute([$get_id]);
         if($select_gym->rowCount() > 0){
         $fetch_gym = $select_gym->fetch(PDO::FETCH_ASSOC);
         $gym_id = $fetch_gym['id'];

         $select_gym_ifo = $conn->prepare("SELECT * FROM `gym_info` WHERE id = ?");
         $select_gym_ifo->execute([$gym_id]);
         $gym_ifo = $select_gym_ifo->fetch(PDO::FETCH_ASSOC);
         $gym_ifo_id = $gym_ifo['id'];
      ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_image" value="<?= $fetch_gym['thumb']; ?>">
      <p> تعديل السجل التجارى <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_gym['states']; ?>" selected><?= $fetch_gym['states']; ?></option>
         <option value="active">نعم</option>
         <option value="deactive">لا</option>
      </select>

      <p> النادي خاص ب   <span>*</span></p>
      <select name="gender" class="box" required>
         <option value="<?= $gym_ifo['gender']; ?>" selected > <? $gym_ifo['gender']; ?>  </option>
         <option value="خاص بالرجال">خاص بالرجال </option>
         <option value="خاص بالاناث ">خاص بالاناث </option>
         <option value="كلاالجنسين">كلا الجنسين  </option>
      </select>

      <p> اسم النادي <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="  ادخل اسم النادي" value="<?= $fetch_gym['title']; ?>" class="box">

      <p> موقع النادي <span>*</span></p>
      <input type="text" name="locations" maxlength="100" required placeholder="  ادخل موقع النادي" value="<?= $gym_ifo['locations']; ?>" class="box">

      <p> سعر الاشتراك <span>*</span></p>
      <input type="text" name="price" maxlength="100" required placeholder="  ادخل سعر الاشتراك" value="<?= $gym_ifo['price']; ?>" class="box">


      <p> وصف النادي <span>*</span></p>
      <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30" rows="10"><?= $fetch_gym['descriptions']; ?></textarea>
      <p>playlist thumbnail <span>*</span></p>
      <div class="thumb">
        
         <img src="../uploaded_files/<?= $fetch_gym['thumb']; ?>" alt="">
      </div>
      <input type="file" name="image" accept="image/*" class="box">
      <input type="submit" value="update " name="submit" class="btn">
   </form>
   <?php
      
   }else{
      echo '<p class="empty">no gym added yet!</p>';
   }
   ?>

</section>


<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>