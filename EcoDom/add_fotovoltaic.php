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
$ilosc = $_POST['number'];;
$powierzchnia = $_POST['area'];
$moc = $_POST['power'];
$house_id = $_POST['house_id'];
$user_id = $_SESSION['id'];
$sql = "INSERT INTO fotowoltaika VALUES (NULL, '$house_id','$user_id', '$ilosc', '$powierzchnia', '$moc')";
$result = mysqli_query($conn, $sql);
$conn->close();
header("Location: rooms.php?house_id=$house_id");
?>
