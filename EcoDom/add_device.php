<?php
//Sprawdzanie czy dana osoba jest zalogowana
session_start();
if(isset($_SESSION['zalogowany']))
{
	if($_SESSION['zalogowany']==false)
	{
		header('Location: index.php');
		exit();
	}
}
else
{
	header('Location: index.php');
	exit();
}
//Dodawanie
require_once"connect.php";
$nazwa = $_POST['name'];
$energia = $_POST['energy'];
$czas = $_POST['time'];
$room_id = $_POST['room_id'];


$sql = "SELECT id_mieszkania FROM pomieszczenia WHERE id = '".$room_id."'";
$r = mysqli_query($conn, $sql);
$rez = mysqli_fetch_row($r);
$house_id = $rez[0];
$sql = "INSERT INTO urzadzenia VALUES (NULL, '$nazwa', '$energia', '$house_id', '$room_id', '$czas')";
$result = mysqli_query($conn, $sql);
$conn->close();
header("Location: devices.php?room_id=$room_id");
?>
