<?php
session_start();
require_once"connect.php";

$login = $_POST['login'];
$haslo = $_POST['haslo'];
//anty hacking
$login = htmlentities($login, ENT_QUOTES, "UTF-8");
//Sprawdzenie błędów i logowanie
if($rezultat = $conn->query(sprintf("SELECT *FROM uzytkownicy WHERE BINARY login='%s'",
mysqli_real_escape_string($conn,$login))))
{
	$ile_userow = $rezultat->num_rows;
	if($ile_userow>0)
	{
		$wiersz = $rezultat->fetch_assoc();
		if($haslo == $wiersz['password'])
		{
			$_SESSION['zalogowany'] = true;
			$_SESSION['id'] = $wiersz['id'];
			$_SESSION['login'] = $wiersz['login'];
			$_SESSION['haslo'] = $wiersz['password'];
			$_SESSION['email'] = $wiersz['email'];

			unset($_SESSION['blad']);
			$rezultat->close();
			header('Location: houses.php');
		}
		else
		{
			$_SESSION['blad'] = '<span style="color:red">Niepoprawne hasło.</span>';
			header('Location: index.php');	
			$rezultat->close();
		}
	}
	else
	{
		$_SESSION['blad'] = '<span style="color:red">Konto nie istnieje.</span>';
		header('Location: index.php');
	}
}
$conn->close();
?>