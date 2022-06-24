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
		<?php
		require_once"connect.php";
		$sum = 0;
		$sql = "SELECT * FROM pomieszczenia WHERE id_mieszkania = '".$_GET['house_id']."'";
		$r = mysqli_query($conn, $sql);
		while($rez = mysqli_fetch_array($r))
		{	
			$sql2 = "SELECT SUM(zuzycie_energii) FROM urzadzenia WHERE id_pomieszczenia = '".$rez['id']."'";
			$r2 = mysqli_query($conn, $sql2);
			$rez2 = mysqli_fetch_row($r2);
			echo "<p><a href=devices.php?room_id=".$rez['id'].">".$rez['nazwa']."</a> <b>".$rez2[0]."</b></p>";
			$sum += $rez2[0];
		}
		echo "Suma: <b>".$sum."</b>";
		$conn->close();
		?>
		<br><br>
		<form action="new_room.php">
			<?php
			$house_id = $_GET['house_id'];
			echo "<input type='hidden' name='house_id' value='".$house_id."' />";
			?>
			<input type="submit" value="Dodaj Pokój" />
		</form>
	</div>
</div>
</body>
</html>