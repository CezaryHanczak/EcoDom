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
		<h1>Lista Pokoi</h1>
		<p><a href="devices.php">Room 1</a></p>
		<p><a href="devices.php">Room 2</a></p>
		<p><a href="devices.php">Room 3</a></p>
		<p><a href="devices.php">Room 4</a></p>
	</div>
</div>
</body>
</html>