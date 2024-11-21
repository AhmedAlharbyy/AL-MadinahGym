<?php

include 'components/connect.php';

if(isset($_POST['submit'])){

   $id = unique_id();
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = "0";

   $locations =$_POST['locations'];
   $price =$_POST['price'];
   $gender =$_POST['gender'];

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = unique_id().'.'.$ext;
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_files/'.$rename;

   $add_gym = $conn->prepare("INSERT INTO `gym_dscr` ( title, descriptions, thumb, states) VALUES(?,?,?,?)");
   $add_gym->execute([ $title, $description, $rename, $status]);

   $select_gyms = $conn->prepare("SELECT * FROM `gym_dscr` WHERE title = ? ");
   $select_gyms->execute([$title]);

   if($select_gyms->rowCount() > 0){
      while($fetch_gyms = $select_gyms->fetch(PDO::FETCH_ASSOC)){
         $id = $fetch_gyms['id'];
      }
   }   
   
   $add_gym = $conn->prepare("INSERT INTO `gym_info` ( id, locations, price, gender) VALUES(?,?,?,?)");
   $add_gym->execute([ $id, $locations, $price, $gender]);
   
   move_uploaded_file($image_tmp_name, $image_folder);
   
   $message[] = ' تم اضافة طلب نادي';  
   header('location:add_gym.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>اضافة نادي</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
   
<section class="playlist-form">

   

   <form action="" method="post" enctype="multipart/form-data">
   <h1 class="heading" style="text-align :center">طلب اضافة النادي</h1>
      <p> حالة النادي التجارى <span>*</span></p>
      
      <select name="gender" class="box" required>
         <option value="" selected disabled> النادي خاص     </option>
         <option value="خاص بالرجال">خاص بالرجال </option>
         <option value="خاص بالاناث ">خاص بالاناث </option>
         <option value="كلاالجنسين">كلا الجنسين  </option>
      </select>

      <p> اسم النادي <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="ادخل اسم النادي" class="box">

      <p> موقع النادي <span>*</span></p>
      <input type="text" name="locations" maxlength="100" required placeholder="ادخل موقع النادي" class="box">

      <p> سعر الاشتراك <span>*</span></p>
      <input type="text" name="price" maxlength="100" required placeholder="ادخل السعر " class="box">
      
      <select name="description" class="box" required>
         <option value="" selected disabled>-- هل يملك سجل تجاري</option>
         <option value="  يملك سجل تجاري">نعم </option>
         <option value=" لا يملك سجل تجاري">لا </option>
      </select>
      <p> صورة النادي <span>*</span></p>
      <input type="file" name="image" accept="image/*" required class="box">
      <input type="submit" value="اضافة نادي" name="submit" class="btn">
   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/admin_script.js"></script>

</body>
</html>