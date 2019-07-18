<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $train_no = $_SESSION['trainno'];

   $ses_sql = mysqli_query($db,"SELECT User from user_data where User = '".$user_check."' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['User'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>