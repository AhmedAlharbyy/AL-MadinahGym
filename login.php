<?php

/*include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `gym` WHERE email = ? AND password = ? LIMIT 1");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
   
   if($select_user->rowCount() > 0){
     setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
     header('location:home.php');
   }else{
      $message[] = 'البريد الإلكتروني او كلمة المرور غير صحيح!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data" class="تسجيل الدخول ">
      <h3>مرجباً مجدداً!</h3>
      <p>بريدك الإلكتروني  <span>*</span></p>
      <input type="email" name="email" placeholder="ادخل بريدك الألكتروني " maxlength="50" required class="box">
      <p>كلمة المرور<span>*</span></p>
      <input type="password" name="pass" placeholder="أدخل كلمة المرور" maxlength="20" required class="box">
      <p class="link">لا تمتلك حساب ? <a href="register.php">إنشاء حساب</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>












<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>*/