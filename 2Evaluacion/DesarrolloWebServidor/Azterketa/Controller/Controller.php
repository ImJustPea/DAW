<?php
session_start();
include_once("../View/bista.php");
include_once("../Model/ErabiltzaileaModel.php");
include_once("../Model/EskariaModel.php");

$Vista = new Bista();
$ModeloErabiltzaile = new ErabiltzaileaModel();
$ModeloProd = new EskariaModel();

if (!isset($_COOKIE['user']) && $_SESSION['Validado']) {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['Hasi'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $datosUser = $ModeloErabiltzaile->Login($user, $pass);
    $_SESSION['Validado'] = true;
    setcookie("user", $user, time() + 30, "/");
    if ($datosUser) {
        $_SESSION['user'] = $datosUser['user'];
        $_SESSION['admin'] = $datosUser['admin'];
        $_SESSION['id'] = $datosUser['id'];
        if ($datosUser['admin'] == 1) {
            $Vista->adminErabiltzaileGunea();
        } else {
            $Vista->erabiltzaileGunea($ModeloProd->GetArropa());
        }
    } else {
        echo "Erabiltzailea edo pasahitza ez da zuzena";
        $Vista->Login();
    }
}

if (isset($_POST['Erosi'])) {
    $id_erabiltzailea = $_SESSION['id'];
    $id_arropa = $_POST['produktuak'];
    $kantitatea = $_POST['zenbakiak'];
    $result = $ModeloProd->InsertEskaria($id_erabiltzailea, $id_arropa, $kantitatea);
    if ($result) {
        echo "Eskaria egin da";
        $Vista->erabiltzaileGunea($ModeloProd->GetArropa());
    } else {
        echo "Errorea eskaria egitean";
        $Vista->erabiltzaileGunea($ModeloProd->GetArropa());
    }
}

if (isset($_POST['Produktuak'])) {
    $Vista->produktuaSortu();
}

if (isset($_POST['Eskariak'])) {
    $eskariak = $ModeloProd->GetEskariak();
    $Vista->eskarienTaulaSortu($eskariak);
}

if (isset($_POST['Sortu_Produktuak'])) {
    $id = $_POST['id_produktua'];
    $izena = $_POST['izena'];
    $prezioa = $_POST['prezioa'];
    $result = $ModeloProd->InsertArropa($id, $izena, $prezioa);
    if ($result) {
        echo "Produktua sortu da";
        $Vista->adminErabiltzaileGunea();
    } else {
        echo "Errorea produktua sortzean";
        $Vista->adminErabiltzaileGunea();
    }
}
