<?php
class Redirect{
    public static function to($location = null){
        if($location){
            if(is_numeric($location)){
                switch ($location){
                    case 404:
                        header('HTTP/1.0 404 Not Found');
                        include 'errors/404.php';
                        exit();
                        break; // i can use more case:brake for another errors 502 for exmaple
                }
            }
            header('Location: ' . $location);
            exit();
        }
    }
}