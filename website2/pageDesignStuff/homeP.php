<!DOCTYPE html>

<html>
    <head>
        <title>Webpage haha</title>
        <link rel="stylesheet" href="styleP.css" type="text/css" />
        <script src="jquery-1.11.2.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body class="body">
        <header class="mainHeader">
            <nav class="navContainer">
                        <a  class="btn" href="#">
                            <span class="homeBtn"></span>
                            <span class="text">HOME</span>
                        </a>
                    
                    
                        <a class="btn" href="#">
                            <span class="aboutBtn"></span>
                            <span class="text">About</span>
                        </a>
                    
                    
                        <a class="btn" href="#">
                            <span class="faqBtn"></span>
                            <span class="text">FAQ</span>
                        </a>
                    
                    
                        <a class="btn" href="#">
                            <span class="contactBnt"></span>
                            <span class="text">Contact</span>
                        </a>
                    
                        <a class="btn" href="#">
                            <span class="shipBtn"></span>
                            <span class="text">Shipping Rules</span>
                        </a>
                    
                        <a class="btn" href="#">
                            <span class="shopBtn"></span>
                            <span class="text">Shop</span>
                        </a>
            </nav>
        </header>
        <script src="functionP.js"></script> 
        <div class="social">
        <a href="http://www.facebook.com" target="_blank"><img alt="Facebook" src="pics/facebook_icon.png"/></a>
        <a href="http://www.twitter.com" target="_blank"><img alt="Twitter" src="pics/twitter_icon.png"/></a>
        <a href="http://www.google.com" target="_blank"><img alt="Google" src="pics/google_icon.png"/></a>
        </div>
        <?php
        
define('ROOT', 'C:\xampp\htdocs\website2\\');
require_once(ROOT . "core.php");

        if(Session::exists('home')){
        echo '<p>' . Session::flash('home') . '</p>';
        }
        $user = new User();
        if($user->isLoggedIn()){
        ?>
                <p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>
            <ul>
                <li><a href="logout.php">Log out</a></li>
                <li><a href="update.php">Update details</a></li>
                <li><a href="changePassword.php">change password</a></li>
            </ul>
                <?php
                if($user->hasPermission('admin')){
                echo '<p>y r admin.</p>'; // we can say if !user is not admin whrre to go mean register or what
            }
        }else{
            echo '<p class="logReg">If you allready have an account <a href="login.php">log in</a><br> or'
            . ' <a href="registration.php">register</a> , it is fast and you can use all of the fun!</p>';
        }
        ?>
        <footer class="mainFooter">
            <p>Copyright &copy; 2015 <a href="#" title="Responsive design Web by Boris">www.borismasters.com</a></p>
        </footer>
    </body>
</html>
