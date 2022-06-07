<?php
/* Łączenie z serwerem MySQL*/
$conn = mysqli_connect("localhost", "root", "", "ecodom");
/* Ustawienie strony kodowej */
mysqli_query($conn, 'SET NAMES utf8');
mysqli_query($conn, 'SET CHARACTER SET utf8');
mysqli_query($conn, "SET collation_connection = utf8_polish_ci");
?>