<?php
require_once 'core/init.php';
$Auth = new Auth();
$Auth->logout();
Helper::redirect('index.php');