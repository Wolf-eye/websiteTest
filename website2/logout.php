<?php
require_once 'core.php';

$user = new User();
$user->logout();
Redirect::to('index.php');