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
		<h1>Dodaj Pokój</h1>
		<br><br>
		<form action="add_room.php" method="POST">
			<?php
			$house_id = $_GET['house_id'];
			echo "<input type='hidden' name='house_id' value='".$house_id."' />";
			?>
			<input type="text" required="required" placeholder="Nazwa" name="name" />
			<input type="submit" value="Dodaj Pokój" />
		</form>
	</div>
</div>
</body>
</html>