<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'pdf';
$con = mysqli_connect($host,$user,$password,$database);
if (!$con) {
   ?>
   <script>alert("Connection unsuccessfull!");</script>
   <?php
}

?>