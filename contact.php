<?php

include 'components/connect.php';

if(isset($_POST['submit'])){

   $name = $_POST['name']; 
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email']; 
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number']; 
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg']; 
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_contact = $conn->prepare("SELECT * FROM `contact` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_contact->execute([$name, $email, $number, $msg]);

   if($select_contact->rowCount() > 0){
      $message[] = 'أرسلت الرسالة بالفعل!';
   }else{
      $insert_message = $conn->prepare("INSERT INTO `contact`(name, email, number, message) VALUES(?,?,?,?)");
      $insert_message->execute([$name, $email, $number, $msg]);
      $message[] = 'تم إرسال الرسالة بنجاح!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   <link rel="stylesheet" href="fontawesome-free-6.5.2-web/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>
<section class="contact">

   <div class="row">

      <div class="image">
         <img src="images/contact-img.svg" alt="">
      </div>

      <form action="" method="post">
         <h3>تواصل معنا</h3>
         <input type="text" placeholder="ادخل أسمك " required maxlength="100" name="name" class="box">
         <input type="email" placeholder="أدخل بريدك الإلكتروني " required maxlength="100" name="email" class="box">
         <input type="number" min="0" max="9999999999" placeholder="أدخل رقمك" required maxlength="10" name="number" class="box">
         <textarea name="msg" class="box" placeholder="أكتب رسالتك" required cols="30" rows="10" maxlength="1000"></textarea>
         <input type="submit" value="إرسال الرسالة" class="inline-btn" name="submit">
      </form>

   </div>

   <div class="box-container">

      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>رقم الهاتف</h3>
         <a href="tel:1234567890">123-456-7890</a>
         <a href="tel:1112223333">111-222-3333</a>
      </div>

      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>البريد الإلكتروني </h3>
         <a href="mailto:shaikhanas@gmail.com">university1@gmail.come</a>
         <a href="mailto:anasbhai@gmail.com">noone@gmail.come</a>
      </div>

      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>الموقع</h3>
         <a href="#">flat no. 23, a-1 building, Gada,  KSA  - 11111</a>
      </div>


   </div>

</section>

<!-- contact section ends -->











<?php include 'components/footer.php'; ?>  

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>