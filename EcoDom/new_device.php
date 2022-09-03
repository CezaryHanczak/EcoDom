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
		<h1>Dodaj Urządzenie</h1>
		<br><br>
		<form action="add_device.php" method="POST">
			<?php
			$room_id = $_GET['room_id'];
			echo "<input type='hidden' name='room_id' value='".$room_id."' />";
			?>
			<input type="text" required="required" placeholder="Nazwa" name="name" />
			<input type="number" required="required" min="0" placeholder="Zużycie energii" name="energy" />
			<input type="number" required="required" min="0" placeholder="Średni czas użytkowania w ciągu dnia" name="time" />
			<input type="submit" value="Dodaj Urządzenie" />
		</form>
	</div>
</div>
</body>
</html>
