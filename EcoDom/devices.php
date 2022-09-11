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
<script src="https://cdn.plot.ly/plotly-2.14.0.min.js"></script>
<script> 
	var powerValues = [];
	var chartLabels = [];
</script>
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
		$sum_of_kWh = 0;
		$sql = "SELECT * FROM urzadzenia WHERE id_pomieszczenia = '".$_GET['room_id']."'";
		$r = mysqli_query($conn, $sql);
		echo
			'<div class="table-wrapper"><table class="fl-table">
				<thead>
				<tr>
					<th>Nazwa</th>
					<th>Zużycie energii</th>
					<th>Usuń urządzenie</th>
				</tr>
				</thead>
				<tbody>';
		while($rez = mysqli_fetch_array($r))
		{
			echo '
				<form name="deletedevice" method="POST" action="delete_device.php">
					<tr>
						<td>
							<a>'.$rez['nazwa'].'</a>
						</td>
						<td>
							<b>'.$rez['zuzycie_energii'].' W</b>
						</td>
						<td>
							<input type="submit" name="usun" value="Usuń">
						</td>
					</tr>
					<input type="text" name="id_device" class="ukryty" value="'.$rez['id'].'">
					<input type="text" name="id_room" class="ukryty" value="'.$_GET['room_id'].'">
				</form>';
			echo '<script>powerValues.push(' . $rez['zuzycie_energii'] . '); chartLabels.push("' . $rez['nazwa'] . '");</script>';
			$sum += $rez['zuzycie_energii'];
			$sum_of_kWh += ($rez['sredni_czas_pracy']*$rez['zuzycie_energii']);
		}
		echo '</tbody></table></div>';
		$sum_of_kWh /= 1000;
		echo "Całkowita moc sprzętów: <b>".$sum." W</b></br>";
		echo "Całkowita zużyta energia: <b>".$sum_of_kWh." kWh</b></br>";
		$sql = "SELECT * FROM prad where id = '1'";
		$r = mysqli_query($conn, $sql);
		$rez = mysqli_fetch_array($r);

		$sum_of_kWh *= $rez['cena_za_kWh'];
		$sum_of_kWh = round($sum_of_kWh, 2);
		echo "Szacunkowy koszt przy cenie ".$rez['cena_za_kWh']."zł/kWh to: <b>".$sum_of_kWh." zł/dzień</b>";
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

		<div id="plot" class="plot"></div>

		<script>
       		var data = [{
			  values: powerValues,
			  labels: chartLabels,
			  type: 'pie'
			}];
			
			var layout = {
			    title: 'Wykres zużycia energii przez urządzenia',
				width: '20%',
				paper_bgcolor: 'rgb(85,164,78)'
			};
			
			var config = {
			  showEditInChartStudio: false,
			  plotlyServerURL: "https://chart-studio.plotly.com"
			};

			Plotly.newPlot('plot', data, layout, config);
    	</script>
	</div>
</div>
</body>
</html>
