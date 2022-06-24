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
		<h1>Lista Urządzeń</h1>
		<?php
		require_once"connect.php";
		$sum = 0;
		$sql = "SELECT * FROM urzadzenia WHERE id_pomieszczenia = '".$_GET['room_id']."'";
		$r = mysqli_query($conn, $sql);
		while($rez = mysqli_fetch_array($r))
		{	
			echo "<p><a>".$rez['nazwa']."</a> <b>".$rez['zuzycie_energii']."</b></p>";
			$sum += $rez['zuzycie_energii'];
		}
		echo "Suma: <b>".$sum."</b>";
		$conn->close();
		?>
		<br><br>
		<form action="new_device.php">
			<?php
			$room_id = $_GET['room_id'];
			echo "<input type='hidden' name='room_id' value='".$room_id."' />";
			?>
			<input type="submit" value="Dodaj Urządzenie" />
		</form>
	</div>
</div>
</body>
</html>