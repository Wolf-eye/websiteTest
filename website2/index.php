<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'core.php';
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
            echo '<p>Y need to <a href="login.php">log in</a> or <a href="registration.php">register</a></p>';
        }
        ?>
    </body>
</html>
    