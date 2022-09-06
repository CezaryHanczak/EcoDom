<?php
session_start();
//Zmienne potrzebne do pokazania poprzednich danych przy rejestracji
$_SESSION['fr_login'] = $_POST['login'];
$_SESSION['fr_haslo'] = $_POST['haslo'];
$_SESSION['fr_potw'] = $_POST['potw'];
$_SESSION['fr_email'] = $_POST['email'];
require_once"connect.php";

//Sprawdzanie czy wszystko działa
$wszystko_OK=true;

//login
$login = $_POST['login'];
if((strlen($login)<6) || (strlen($login)>20))
{
	$wszystko_OK=false;
	$_SESSION['e_login1']="Login musi posiadać od 6 do 20 znaków.";
}
if(ctype_alnum($login)==false)
{
	$wszystko_OK=false;
	$_SESSION['e_login2']="Nick może składać się tylko z liter i cyfr.";
}
$rezultat = $conn->query("Select id FROM uzytkownicy WHERE login='$login'");
$ile_takich_loginow = $rezultat->num_rows;
if($ile_takich_loginow>0)
{
	$wszystko_OK = false;
	$_SESSION['e_login3'] = "Istnieje już konto o danym loginie.";
}
//haslo
$haslo = $_POST['haslo'];
$potw = $_POST['potw'];
if((strlen($haslo)<6) || (strlen($haslo)>20))
{
	$wszystko_OK=false;
	$_SESSION['e_haslo1']="Hasło musi posiadać od 6 do 20 znaków.";
}
if (!preg_match('/[A-Z]/', $haslo))
{
	$wszystko_OK=false;
	$_SESSION['e_haslo3']="Hasło musi zawierać minimum 1 dużą literę, 1 małą literę oraz 1 cyfrę.";
}
if (!preg_match('/[a-z]/', $haslo))
{
	$wszystko_OK=false;
	$_SESSION['e_haslo3']="Hasło musi zawierać minimum 1 dużą literę, 1 małą literę oraz 1 cyfrę.";
}
if (!preg_match('/[0-9]/', $haslo))
{
	$wszystko_OK=false;
	$_SESSION['e_haslo3']="Hasło musi zawierać minimum 1 dużą literę, 1 małą literę oraz 1 cyfrę.";
}
//potwierdzanie
if($haslo != $potw)
{
	$wszystko_OK=false;
	$_SESSION['e_haslo2']="Hasła różnią się.";
}

//email
$email = $_POST['email'];
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB != $email))
{
	$wszystko_OK=false;
	$_SESSION['e_email']="Niepoprawny adres e-mail.";
}
//Działa
if($wszystko_OK == true)
{
	$sql = "INSERT INTO uzytkownicy VALUES (NULL, '$login', '$haslo', '$email')";
	$result = mysqli_query($conn,$sql);
	if($rezultat = $conn->query(sprintf("SELECT *FROM uzytkownicy WHERE BINARY login='%s'",
	mysqli_real_escape_string($conn,$login))))
	$wiersz = $rezultat->fetch_assoc();
	$_SESSION['id'] = $wiersz['id'];
	$_SESSION['login'] = $wiersz['login'];
	$_SESSION['haslo'] = $wiersz['password'];
	$_SESSION['email'] = $wiersz['email'];

	//Usuwanie zmiennych mówiących o blędach przy rejestracji i przechowywująych danych w przypadku błędnej rejestracji
	if(isset($_SESSION['fr_login']))unset($_SESSION['fr_login']);
	if(isset($_SESSION['fr_haslo']))unset($_SESSION['fr_haslo']);
	if(isset($_SESSION['fr_potw']))unset($_SESSION['fr_potw']);
	if(isset($_SESSION['fr_email']))unset($_SESSION['fr_email']);
	if(isset($_SESSION['e_login1']))unset($_SESSION['e_login1']);
	if(isset($_SESSION['e_login2']))unset($_SESSION['e_login2']);
	if(isset($_SESSION['e_login3']))unset($_SESSION['e_login3']);
	if(isset($_SESSION['e_haslo1']))unset($_SESSION['e_haslo1']);
	if(isset($_SESSION['e_haslo2']))unset($_SESSION['e_haslo2']);
	if(isset($_SESSION['e_haslo3']))unset($_SESSION['e_haslo3']);
	if(isset($_SESSION['e_email']))unset($_SESSION['e_email']);

	$_SESSION['zalogowany'] = true;
	header('Location: houses.php');
	$rezultat->close();
}

else
{
	header('Location: index.php');
}

$conn->close();
?>
