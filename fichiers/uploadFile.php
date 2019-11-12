<?php

header('Access-Control-Allow-Origin: *');
define('PUBLIC_KEY', 'e21cc284848a3f5b0240');

$tempPath = $_FILES['file']['tmp_name'];
$actualName = $_FILES['file']['name'];
$uploads_dir = '/uploads';

//$actualPath = dirname(__FILE__)."\\temp\\".$actualName;

 $nomC=$_FILES['file']['name'];
 $yon = './uploads/'.$_FILES['file']['name'];
 move_uploaded_file($_FILES['file']['tmp_name'],$yon);

