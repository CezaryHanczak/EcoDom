<?php
session_start();
require_once"connect.php";
if(!isset($_POST['id_device']))
{
	header('Location: index.php');	
	exit();
}
$id = $_POST['id_device'];
$room_id = $_POST['id_room'];
 
//Usuwanie albumu/zdjęć/komentarzy/ocen z bazy
$sql = "DELETE FROM urzadzenia WHERE id='$id'";
$result = mysqli_query($conn,$sql);

header("Location: devices.php?room_id=$room_id");	

$conn -> close();
?>