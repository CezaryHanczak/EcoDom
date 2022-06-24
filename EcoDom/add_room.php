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
$house_id = $_POST['house_id'];
$sql = "INSERT INTO pomieszczenia VALUES (NULL, '$nazwa', '$house_id')";
$result = mysqli_query($conn, $sql);
$conn->close();
header("Location: rooms.php?house_id=$house_id");
?>