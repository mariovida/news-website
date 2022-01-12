<?php
	session_start();
	include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="shortcut icon" type="image/ico" href="img/favicon.ico"/>
	<title>
		<?php
			$kategorija = $_GET['kategorija'];
			echo strtoupper($kategorija);
		?>
	</title>
	<style>
		article {
			margin-bottom: 10px;
			padding-bottom: 10px;
		}
	</style>
</head>
<body>
  <div class="logo">
    <a href="index.php"><img src="img/logo.svg" /></a>
  </div>

  <div class="nav">
    <div class="wrapper">
			<a href="index.php">HOME</a>
			<?php
				$kategorija = $_GET['kategorija'];
				if($kategorija == 'svijet') {
					echo "<a class='foc' href='kategorija.php?kategorija=svijet'>SVIJET</a>";
				} else {
					echo "<a href='kategorija.php?kategorija=svijet'>SVIJET</a>";
				}
				if($kategorija == 'ekonomija') {
					echo "<a class='foc' href='kategorija.php?kategorija=ekonomija'>EKONOMIJA</a>";
				} else {
					echo "<a href='kategorija.php?kategorija=ekonomija'>EKONOMIJA</a>";
				}
				if(isset($_SESSION['username'])) {
					echo "<a href='administracija.php'>ADMINISTRACIJA</a>";
					echo "<a href='unos.php'>UNOS</a>";
					echo "<a href='logout.php'>ODJAVA</a>";
				} else {
					echo "<a href='registracija.php'>REGISTRACIJA</a>";
					echo "<a href='login.php'>PRIJAVA</a>";
				}
			?>
    </div>
  </div>

  <div class="main">
    <div class="wrapper">
				<?php

					define('UPLPATH', 'img/');
					$kategorija = $_GET['kategorija'];
					$query = "SELECT * FROM vijesti WHERE kategorija='$kategorija' AND arhiva=0";
					$result = mysqli_query($dbc, $query);
					echo "<h1>$kategorija</h1>";
					while($row = mysqli_fetch_array($result)) {
						echo "<article>
							<div class='news'>
							<div class='news_image'><img src='" .UPLPATH.$row['slika']. "'></div>
							<h4><a href='clanak.php?id=".$row['id']."'>".$row['naslov']."</a></h4>
							<h5>".$row['sazetak']."</h5>
							</div>
							</article>";
					}
				?>
    </div>
  </div>

  <footer>
		<div class="wrapper">
      <br/><p>Projektni zadatak iz kolegija <i>Programiranje Web Aplikacija</i></p>
      <br/><p>Autor projekta: <b>Mario Vidović</b><br/>mvidovic@tvz.hr</p>
			<br/><p>Godina izrade: 2021.</p>
    </div>
  </footer>
</body>
</html>
