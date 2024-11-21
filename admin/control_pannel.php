<?php

include '../components/connect.php';
if(isset($_COOKIE['id'])){
   $id = $_COOKIE['id'];
}else{
   $id = '';
   //header('location:login.php');
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
   <title>لوحةالتحكم</title>
   <link rel="stylesheet" href="../fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/control_header.php'; ?>
<section class="dashboard">
   <h1 class="heading"> لوحة التحكم </h1>

   <div class="box-container">

      <div class="box">
         <h1> اشعارات طلب انضمام </h1>
         
         <a href="view_gym_for_control.php" class="btn">عرض  </a>
      </div>
   </div>

</section>
<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>*/