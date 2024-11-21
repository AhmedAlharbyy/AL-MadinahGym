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
      <a href="dashboard.php" class="logo">Admin.</a>
      <form action="search_page.php" method="post" class="search-form">
         <input type="text" name="search" placeholder="search here..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>
      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
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
      <a href="control_pannel.php"><i class="fas fa-home"></i><span>control pane</span></a>
      <a href="view_gym_for_control.php"><i class="fa-solid fa-bars-staggered"></i><span>control gyms</span></a>
   </nav>

</div>

<!-- side bar section ends -->