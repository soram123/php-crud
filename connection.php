<?php

$user = 'root';
$pass = '';
$db = 'myfirstdb';

$conn = new mysqli('localhost',$user,$pass,$db) or die("unable to connect");

echo "great work !"

?>