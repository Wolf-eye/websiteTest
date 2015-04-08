<?php
session_start();
$GLOBALS['config'] = array(
    'mysql' => array(
        'db_host' => '127.0.0.1',
        'db_username' => 'root',
        'db_password' => '',
        'database' => 'prodatabase'
        ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
        ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
        ));
    //function autoload($class) {
    //require_once(INC_ROOT.'/classes/'.$class.'.php');}
    spl_autoload_register(function($class) {
        require_once 'classes/'.$class.'.php';
    });
    require_once 'sanitize.php';
    if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
        $hash = Cookie::get(Config::get('remember/cookie_name'));
        $hashCheck = Db::getInstance()->get('users_session', array('hash', '=', $hash));
        if($hashCheck->count()){
            $user = new User($hashCheck->first()->user_id);
            $user->login();
        }
    }