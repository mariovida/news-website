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
	<title>PRIJAVA</title>
	<style>
    .main {
      height: 350px;
      padding-top: 50px;
    }
    input {
      width: 96%;
      height: 25px;
      padding: 3px 4px 3px 10px;
      margin-bottom: 7px;
			box-shadow: rgba(255, 255, 255, 0.2) 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.9) 0px 0px 0px 1px;
			border: none;
			border-radius: 3px;
    }
    .main p {
      margin-top: 10px;
      margin-left: 20px;
      font-size: 18px;
      font-weight: bold;
      color: #EA212D;
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
      <a href="kategorija.php?kategorija=svijet">SVIJET</a>
      <a href="kategorija.php?kategorija=ekonomija">EKONOMIJA</a>
			<?php
				if(isset($_SESSION['username'])) {
					echo "<a href='administracija.php'>ADMINISTRACIJA</a>";
					echo "<a href='unos.php'>UNOS</a>";
					echo "<a href='logout.php'>ODJAVA</a>";
				} else {
					echo "<a href='registracija.php'>REGISTRACIJA</a>";
					echo "<a class='foc' href='login.php'>PRIJAVA</a>";
				}
			?>
    </div>
  </div>

  <div class="main">
    <div class="wrapper">
			<div class="log">
			<h2>PRIJAVA</h2>
      <form enctype="multipart/form-data" method="POST" action="">
				<input name="username" id="username" type="text" class="username" placeholder="Korisničko ime" required/>
				<br/><span id="porukaUsername" class="bojaPoruke"></span>
				<br/>

				<input name="pass" id="lozinka" type="password" class="pass" placeholder="Lozinka" required/>
				<br/><input type="checkbox" class="showpass" onclick="myFunction1()">Prikaži lozinku
				<br/><span id="porukaPass" class="bojaPoruke mes"></span>
        <br/>

        <input name="prijava" type="submit" class="prijava" id="prijava" value="Prijava" />

        <?php
          include 'connect.php';

          if (isset($_POST['prijava'])) {
    	 			$prijavaImeKorisnika = $_POST['username'];
    	 			$prijavaLozinkaKorisnika = $_POST['pass'];
    	 			$sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    	 			$stmt = mysqli_stmt_init($dbc);
    	 			if (mysqli_stmt_prepare($stmt, $sql)) {
    	 				mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
    	 				mysqli_stmt_execute($stmt);
    	 				mysqli_stmt_store_result($stmt);
    	 			}
    	 			mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    	 			mysqli_stmt_fetch($stmt);

    	 			if (password_verify($_POST['pass'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
    	 				$uspjesnaPrijava = true;
    	 				if($levelKorisnika == 1) {
    	 					$admin = true;
    	 				} else {
    	 					$admin = false;
    	 				}

    	 				$_SESSION['username'] = $imeKorisnika;
    	 				$_SESSION['razina'] = $levelKorisnika;
              header('Location: administracija.php');
    	 			} else {
    	 				$uspjesnaPrijava = false;
              echo '<p>Prijava nije uspjela!</p>';
    	 			}
    			}
        ?>
      </form></div>
    </div>
  </div>

  <footer>
		<div class="wrapper">
      <br/><p>Projektni zadatak iz kolegija <i>Programiranje Web Aplikacija</i></p>
      <br/><p>Autor projekta: <b>Mario Vidović</b><br/>mvidovic@tvz.hr</p>
			<br/><p>Godina izrade: 2021.</p>
    </div>
  </footer>
  <script src="reg.js"></script>
</body>
</html>
