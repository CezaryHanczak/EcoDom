<?php
session_start();
require_once"connect.php";
if(!isset($_POST['id_house']))
{
	header('Location: index.php');	
	exit();
}
$id = $_POST['id_house'];


$sql2 = "DELETE FROM urzadzenia WHERE id_mieszkania='$id'";
$result2 = mysqli_query($conn,$sql2);

$sql3 = "DELETE FROM pomieszczenia WHERE id_mieszkania='$id'";
$result3 = mysqli_query($conn,$sql3);

$sql = "DELETE FROM mieszkania WHERE id='$id'";
$result = mysqli_query($conn,$sql);

header("Location: houses.php");	

$conn -> close();
?>