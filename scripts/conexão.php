<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'SaxClub';

$conn = mysqli_connect($host,$user,$pass,$db);
if ($conn) {
    print('Conexão sucedida');
}
?>