<?php
session_start();
include_once("View/bista.php");
include_once("Model/ErabiltzaileaModel.php");


if (!isset($_COOKIE['user']) && $_SESSION['Validado']) {
    echo "Sesioa amaitu da";
}

$_SESSION['Validado'] = false;

$Vista = new Bista();

$Vista->Login();
