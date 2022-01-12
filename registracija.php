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
	<title>REGISTRACIJA</title>
	<style>
    .main {
      height: 620px;
      padding-top: 50px;
    }
    input {
			width: 96%;
      height: 25px;
      padding: 3px 4px 3px 10px;
			margin-bottom: 0px;
			box-shadow: rgba(255, 255, 255, 0.2) 0px 0px 0px 1px inset, rgba(0, 0, 0, 0.9) 0px 0px 0px 1px;
			border: none;
			border-radius: 3px;
    }
		.bojaPoruke {
			color: #EA212D;
			position: absolute;
			text-align: center;
			margin-top: -8px;
		}
		.mes {
			margin-top: -18px;
		}
		.pass_mes {
			margin-top: 15px;
		}
		.showpass {
			width: 15px;
			height: 15px;
			margin: 15px 3px 0 8px;
			padding: 0;
			position: relative;
			box-shadow: none;
		}
    .main p {
    	position: absolute;
			top: 740px;
			left: 38%;
      font-size: 18px;
      font-weight: bold;
    }
		@media (max-width: 600px) {
			.main p {
				top: 920px;
				left: 25%;
	    }
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
			<a class="foc" href="registracija.php">REGISTRACIJA</a>
			<a href="login.php">PRIJAVA</a>
    </div>
  </div>

  <div class="main">
    <div class="wrapper">
			<div class="log">
			<h2>REGISTRACIJA</h2>
      <form enctype="multipart/form-data" method="POST" action="">
				<input name="ime" id="ime" type="text" class="ime" placeholder="Ime" required/>
				<br/><span id="porukaIme" class="bojaPoruke"></span>
        <br/><br/>

				<input name="prezime" id="prezime" type="text" class="ime" placeholder="Prezime" required/>
				<br/><span id="porukaPrezime" class="bojaPoruke"></span>
        <br/><br/>

        <input name="username" id="username" type="text" class="username" placeholder="Korisničko ime" required/>
				<br/><span id="porukaUsername" class="bojaPoruke"></span>
				<br/><br/>

        <input name="pass" id="lozinka" type="password" class="pass" placeholder="Lozinka" required/>
				<br/><input type="checkbox" class="showpass" onclick="myFunction1()">Prikaži lozinku
				<br/><span id="porukaPass" class="bojaPoruke mes"></span>
        <br/>

				<input name="pass" id="lozinkaRep" type="password" class="pass pass_mes" placeholder="Lozinka" required/>
				<br/><input type="checkbox" class="showpass" onclick="myFunction2()">Prikaži lozinku
				<br/><span id="porukaPassRep" class="bojaPoruke mes"></span>
        <br/>

        <input name="submit" type="submit" class="prijava" id="prijava" value="Registracija" />
      </form></div>

      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $basename = "sadrzaj";

        $dbc = mysqli_connect($servername, $username, $password, $basename) or
        die('Error connecting to MySQL server.'.mysqli_connect_error());

        if ($dbc && isset($_POST['submit'])) {
          $ime = $_POST['ime'];
          $prezime = $_POST['prezime'];
          $username = $_POST['username'];
          $lozinka = $_POST['pass'];
          $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
          $razina = 0;
          $registriranKorisnik = false;

          $sql = "SELECT * FROM korisnik WHERE korisnicko_ime = ?";
          $stmt = mysqli_stmt_init($dbc);
          if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
          }
          if (mysqli_stmt_num_rows($stmt) > 0) {
            echo "<p style='color:#EA212D;font-weight:bold'>Korisničko ime već postoji!</p>";
          } else {
            $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $sql)) {
              mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
              mysqli_stmt_execute($stmt);
              $registriranKorisnik = true;
            }
          }

          if($registriranKorisnik == true) {
            echo '<p>Korisnik je uspješno registriran!</p>';
          }
        }

        mysqli_close($dbc);
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
  <script src="reg.js"></script>
</body>
</html>
