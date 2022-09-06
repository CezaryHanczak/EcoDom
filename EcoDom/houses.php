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
		$sum_of_kWh = 0;
		$sql = "SELECT * FROM mieszkania WHERE id_uzytkownika = '".$_SESSION['id']."'";
		$r = mysqli_query($conn, $sql);
		echo
			'<div class="table-wrapper"><table class="fl-table">
				<thead>
				<tr>
					<th>Nazwa</th>
					<th>Zużycie energii</th>
					<th>Usuń mieszkanie</th>
				</tr>
				</thead>
				<tbody>';
		while($rez = mysqli_fetch_array($r))
		{
			$sql2 = "SELECT SUM(zuzycie_energii) FROM urzadzenia WHERE id_mieszkania = '".$rez['id']."'";
			$r2 = mysqli_query($conn, $sql2);
			$rez2 = mysqli_fetch_row($r2);
			echo
				'<form name="deletehouse" method="POST" action="delete_house.php">
					<tr>
						<td>
							<a class="tableA" href=rooms.php?house_id='.$rez['id'].'>'.$rez['nazwa'].'</a>
						</td>
						<td>
							<b>'.$rez2[0].' W</b>
						</td>
						<td>
							<input type="submit" name="usun" value="Usuń">
						</td>
						<input type="text" name="id_house" class="ukryty" value="'.$rez['id'].'">
					</tr>
				</form>';
			$sum += $rez2[0];
			$sql2 = "SELECT SUM(sredni_czas_pracy*zuzycie_energii) FROM urzadzenia WHERE id_mieszkania = '".$rez['id']."'";
			$r2 = mysqli_query($conn, $sql2);
			$rez2 = mysqli_fetch_row($r2);
			$sum_of_kWh += $rez2[0];
		}
		echo '</tbody></table></div>';
		$sql = "SELECT * FROM fotowoltaika WHERE uzytkownik_id = '".$_SESSION['id']."'";
		$r = mysqli_query($conn, $sql);
		$sum_of_panels_power = 0;
		while($rez = mysqli_fetch_array($r)){
				$sum_of_panels_power += $rez['ilosc_paneli']* $rez['moc_panela'];
		}
		$sum_of_kWh -= $sum_of_panels_power ;
		$sum_of_kWh /= 1000;
		echo "Całkowita moc sprzętów: <b>".$sum." W</b></br>";
		echo "Całkowita zużyta energia: <b>".$sum_of_kWh." kWh</b></br>";
		$sql = "SELECT * FROM prad where id = '1'";
		$r = mysqli_query($conn, $sql);
		$rez = mysqli_fetch_array($r);
		$sum_of_kWh *= $rez['cena_za_kWh'];
		if($sum_of_panels_power != 0){
			 $sum_of_kWh -= ($sum_of_kWh*0.2);
		}
		$sum_of_kWh = round($sum_of_kWh, 2);
		echo "Szacunkowy koszt przy cenie ".$rez['cena_za_kWh']."zł/kWh to: <b>".$sum_of_kWh." zł/dzień</b>";
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
