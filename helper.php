<?php
require_once 'Filter.php';
require_once 'ClientFTP.php';

$filter = new Filter();

$check = false;

if(isset($_POST['ftp_server'])&&isset($_POST['port'])&&isset($_POST['username'])&&isset($_POST['password'])&&is_uploaded_file($_FILES['file']['tmp_name'])){
    $ftp_server = $filter->sanitize($_POST['ftp_server']);
    $port = $filter->sanitize($_POST['port']);
    $username = $filter->sanitize($_POST['username']);
    $password = $filter->sanitize($_POST['password']);
    $loc_file = $_FILES['file']['tmp_name']; //nome file con percorso assoluto
    $rem_file = $_FILES['file']['name']; //nome file senza percorso
    $check = true;
}


$client = new ClientFTP($ftp_server, $port, $username, $password, $rem_file, $loc_file);

if($check == true){
    print($client->open());
    print($client->send());
    print($client->close());
}
