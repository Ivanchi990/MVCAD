<?php

error_reporting(E_ALL);

ini_set('display_errors', '1');

session_start();

include 'model.php';
include 'view.php';
include 'controler.php';

actualizar_sesion();

showHeader();
showContent();
showFooter();
?>