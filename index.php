<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="shortcut icon" type="image/ico" href="img/favicon.ico"/>
	<title>NASLOVNICA</title>
	<style>

	</style>
</head>
<body>
  <div class="logo">
    <a href="index.php"><img src="img/logo.svg" /></a>
  </div>

  <div class="nav">
    <div class="wrapper">
      <a class="foc" href="index.php">HOME</a>
      <a href="kategorija.php?kategorija=svijet">SVIJET</a>
      <a href="kategorija.php?kategorija=ekonomija">EKONOMIJA</a>
			<?php
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
      <h1 id="svijet">SVIJET</h1>
			<?php
				include 'connect.php';
				define('UPLPATH', 'img/');
			?>
			<div class="sport">
				<?php
					$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='svijet' LIMIT 4";
					$result = mysqli_query($dbc, $query);
					while($row = mysqli_fetch_array($result)) {
						echo "<article>
							<div class='news'>
							<div class='news_image'><img src='" .UPLPATH.$row['slika']. "'></div>
							<h4><a href='clanak.php?id=".$row['id']."'>".$row['naslov']."</a></h4>
							<h5>".$row['sazetak']."</h5>
							</div>
							</article>";
					}?>
			</div>

			<h1 id="ekonomija">EKONOMIJA</h1>
			<div class="ekonomija">
				<?php
					$query = "SELECT * FROM vijesti WHERE arhiva=0 AND kategorija='ekonomija' LIMIT 4";
					$result = mysqli_query($dbc, $query);
					while($row = mysqli_fetch_array($result)) {
						echo "<article>
							<div class='news'>
							<div class='news_image'><img src='" .UPLPATH.$row['slika']. "'></div>
							<h4><a href='clanak.php?id=".$row['id']."'>".$row['naslov']."</a></h4>
							<h5>".$row['sazetak']."</h5>
							</div>
							</article>";
					}?>
			</div>
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
