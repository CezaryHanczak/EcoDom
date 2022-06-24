<?php
//Sprawdzanie czy dana osoba jest zalogowana
session_start();
if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
	unset($_SESSION['blad']);
}
else
{
	header('Location: index.php');
	exit();
}
?>
<html>
<head>
<title>EkoDom</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div id="container">
	<div id="menu">
		<ul>
			<li><a href="houses.php">Home</a></li>
			<li id="logout"><a href="logout.php">Wyloguj</a></li>
		</ul>
	</div>
	<div id="content">
		<h1>Lista Mieszkań</h1>
		<?php
		require_once"connect.php";
		$sum = 0;
		$sql = "SELECT * FROM mieszkania WHERE id_uzytkownika = '".$_SESSION['id']."'";
		$r = mysqli_query($conn, $sql);
		while($rez = mysqli_fetch_array($r))
		{
			$sql2 = "SELECT SUM(zuzycie_energii) FROM urzadzenia WHERE id_mieszkania = '".$rez['id']."'";
			$r2 = mysqli_query($conn, $sql2);
			$rez2 = mysqli_fetch_row($r2);
			echo "<p><a href=rooms.php?house_id=".$rez['id'].">".$rez['nazwa']."</a> <b>".$rez2[0]."</b></p>";
			$sum += $rez2[0];
		}
		echo "Suma: <b>".$sum."</b>";
		$conn->close();
		?>
		<br><br>
		<form action="new_house.php">
			<input type="submit" value="Dodaj Mieszkanie" />
		</form>
	</div>
</div>
</body>
</html>