<?php
session_start();
require_once"connect.php";
if(!isset($_POST['id_room']))
{
	header('Location: index.php');	
	exit();
}
$id = $_POST['id_room'];
$house_id = $_POST['id_house'];


$sql2 = "DELETE FROM urzadzenia WHERE id_pomieszczenia='$id'";
$result2 = mysqli_query($conn,$sql2);

$sql = "DELETE FROM pomieszczenia WHERE id='$id'";
$result = mysqli_query($conn,$sql);

header("Location: rooms.php?house_id=$house_id");	

$conn -> close();
?>