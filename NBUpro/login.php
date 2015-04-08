<?php
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_DEPRECATED); // ver 5.5.0
session_start();
include 'function.php';
if (filter_input(INPUT_POST, 'login_form', FILTER_SANITIZE_STRING)==1){
    
   $login =  trim(filter_input(INPUT_POST, 'login_name', FILTER_SANITIZE_STRING));
   $pass = trim(filter_input(INPUT_POST, 'login_pass', FILTER_SANITIZE_STRING));
   
   if(strlen($login)>=1 && strlen($pass)>1){
       
       db_nbu();
       $rs=mysql_query('SELECT * FROM users WHERE username="'.addslashes($login).'" AND password="'.md5($pass).'"');
       if (mysql_num_rows($rs)==1){
           $row=mysql_fetch_assoc($rs);
           $_SESSION['is_logged']=true;
           $_SESSION['user_info']=$row;
           header('Location: index.php');
           exit;
       }elseif(mysql_num_rows($rs)==0){
           echo '<h1>Invalid name or pass</h1>';
       }else{
           header('Location: login.php');
                    exit;
       }
           
   }else{
       $error_array['login']='Username/pass is not valid';
       $error_array['pass']='Password/name is uncorrect';
   }
}
// NEED to USE MYSQLLI cuz mysql will be deprecated next time! ver 5.5.0
my_header("Entrance");
?>
<body style="background-image:url(brickbackgrounddarkteal.jpg)">
<link rel='stylesheet' type='text/css' href='Cssform.css' />
<form action="login.php" method="post">
    <input type="text" name="login_name" placeholder="Username"><br />
    <input type="password" name="login_pass" placeholder="Password"><br />
    <input type="checkbox", name="checkbox" id="keep" <label for="keep" />
    <span> Keep me logged in </span><br>
    <input class="btn" type="submit" value="Sign in"><br />
    <input type="hidden" name="login_form" value="1">
    
</form>
      
      <?php
footer();
