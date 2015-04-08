<?php
function my_header($title){
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title;?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">       
    </head>
    <body>
        <link rel='stylesheet' type='text/css' href='Cssform.css' />
        <div id="top_menu">
            <?php
            if(!isset($_SESSION['is_logged'])){
            $_SESSION['is_logged'] = false;}
            ?>
        <?php
            if($_SESSION['is_logged']===true){
                echo '<a class="hi" >Hello</a> <a class="hi" >'.$_SESSION['user_info']['username'].'</a><a class="hi" >,nice to see ya!</a>
                <a class="bye" href="logout.php">Exit<a/a>';
            }else{
            echo '<a id="inv" class="enter" href="register.php">Registration</a> <a id="inv" class="signin" href="login.php">Sign in</a>';
            }
        ?>
        </div>
        <?php }
    function footer(){
    echo '</body></html>';
}
    function db_nbu(){
        @mysql_connect('localhost', 'root', '') or die ("Error with database");
        @mysql_select_db('nbu'); //  i need mysqli func on next revision
    }
