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
$user_id = $_SESSION['id'];
$sql = "INSERT INTO mieszkania VALUES (NULL, '$nazwa', '$user_id')";
$result = mysqli_query($conn, $sql);
$conn->close();
header("Location: houses.php");
?>