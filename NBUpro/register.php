<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include 'function.php';

if(!$_SESSION['is_logged']==true){

    
    if(filter_input(INPUT_POST, 'form_submit', FILTER_SANITIZE_STRING)==1){
   
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $repeatPassword = trim(filter_input(INPUT_POST, 'repeatPassword', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
    
    if(strlen($username)<2){
        $error_array['username']='<a class="regdata" >Uncorrect Username</a>';
    }
        if(strlen($password)<6){
            $error_array['password']=true;
        }
        if($password!=$repeatPassword){
            $error_array['password']=true;
        }
        if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
            $error_array['email']=true;
        }
        if (!count($error_array)>0){
            db_nbu();
            $sql = 'SELECT COUNT(*) as cnt FROM users WHERE username="'.addslashes($username).'"
                OR email="'.addslashes($email).'"';
            $res = mysql_query($sql);
            $row = mysql_fetch_assoc($res);
            if ($row['cnt']==0){
                
            mysql_query('INSERT INTO users (user_id,username,password,email,date_registered)
            VALUES("","'.addslashes($username).'","'.md5($password).'","'.addslashes($email).'",'.time().')');
                if(mysql_error()){
                    
                    $error_array['sql']='<h1>FAIL!Please try again!</h1>';
                }else{
                    header('Location: login.php');
                    exit;
                }
            }else{
                $error_array['username']='<a class="regdata" >Name/e-mail is allready taken!</a>';
                $error_array['email']='<a class="regdata" >E-mail is allready taken!</a>';
            }
        }
    }
    my_header('Registration');
    if ($error_array['sql']){
        echo $error_array['sql'];
    }
    ?>

<html>
<body style="background-image:url(brickbackgrounddarkteal.jpg)">
<link rel='stylesheet' type='text/css' href='cssform1.css' />
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" />
            <?php
                if($error_array['username']){
                    echo $error_array['username'];
                }
            ?><br>
            <input type="password" name="password" placeholder="Password" />
            <?php
                if($error_array['password']){
                    echo '<a class="regdata" >Password is uncorrect: min 6 chars</a>';
                }
            ?><br>
            <input type="password" name="repeatPassword" placeholder="Repeat Password" />
            <?php
                if($error_array['password']){
                    echo '<a class="regdata" >Passwords do not match</a>';
                }
            ?><br>
            <input type="text" name="email" placeholder="E-mail Address" />
            <?php
                if($error_array['email']){
                    echo '<a class="regdata" >E-mail is not valid or taken</a>';
                }
                ?><br>
            <input type="checkbox" name="checkbox" id="rememberMe" <label for="rememberMe"/>
            <span> I have read and agree to the
            <a href="http://wikimediafoundation.org/wiki/Terms_of_Use" style="color: #01DF01" >Terms of Use</a> | and
            <a href="http://wikimediafoundation.org/wiki/Terms_of_Use" style="color: #01DF01" >Privacy Policy</a></span><br>
            <input type="submit" class="btn" name="create accound" value="Create Accound" /><br>
            <span> Sign up with social media </span><br>
            <a class="social" href="http://www.facebook.com" target="_blank"><img alt="Facebook" src="Facebook.png"/></a>
            <a class="social" href="http://www.twitter.com" target="_blank"><img alt="Twitter" src="Twitter.png"/></a>
            <a class="social" href="http://www.youtube.com" target="_blank"><img alt="Youtube" src="YouTube.png"/></a><br>
            <input type="hidden" name="form_submit" value="1">
        </form>
<?php
    footer();
}else{
    header('Location: index.php');
    exit;
}