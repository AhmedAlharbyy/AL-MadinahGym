<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
<header class="header">
   <section class="flex">
      <a href="home.php" class="logo">نادي</a>
      <form action="search_gyms.php" method="post" class="search-form">
         <button type="submit" class="fas fa-search" name="search_series_btn"></button>
      </form>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div style="display :none" id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>
      <div class="profile">
      </div>

   </section>

</header>
<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
       
        
      </div>

      
   <nav class="navbar">
         <div class="button_container" >
        
      <a href="add_gym.php" > <button class="btn"><span style = "color : white">     طلب تسجيل النادي       </span></button></a>
     
      </div>  
      <a href="home.php"><i class="fas fa-home"></i>         <span>الصفحة الرئسية</span></a>
      <a href="about.php"><i class="fas fa-question"></i>         <span>عنا</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i>         <span>التواصل معنا</span></a>
    
   </nav>

</div>
