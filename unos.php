<?php
  session_start();
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
  <title>UNOS PODATAKA</title>
  <style>
    .main {
      height: 1150px;
    }
    h1 {
      text-align: center;
      padding: 35px 0;
    }
    textarea {
      width: 420px;
      height: 250px;
      margin-top: 5px;
      margin-bottom: 15px;
      padding: 9px 0 0 11px;
    }
    .sazetak {
      height: 70px;
    }
    input {
      width: 290px;
      height: 35px;
      padding-left: 10px;
      margin-bottom: 15px;
    }
    .naslov, .kategorija {
      width: 350px;
      height: 30px;
      margin-top: 5px;
      margin-left: 10px;
    }
    .slika {
      width: 420px;
      margin-top: 10px;
    }
    .kategorija {
      width: 190px;
      height: 35px;
      padding-left: 4px;
    }
    .option {
      width: 16px;
      height: 17px;
      margin-left: 5px;
    }
    .button_yes, .button_no {
      border: 1.5px solid black;
      width: 135px;
      height: 35px;
      margin-top: 20px;
      margin-left: 30px;
      background-color: #D9D9D9;
      box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
    	border-radius: 7px;
    }
    .button_yes:hover {
      background-color: #2EB82E;
      color: white;
    }
    .button_no:hover {
      background-color: #CC0000;
      color: white;
    }
    .bojaPoruke {
      margin-top: -10px;
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
			<a href="administracija.php">ADMINISTRACIJA</a>
			<a class="foc" href="unos.php">UNOS</a>
			<a href="logout.php">ODJAVA</a>
    </div>
  </div>

  <div class="main">
    <div class="wrapper">
      <?php
      include 'connect.php';
      if(isset($_SESSION['username'])) {
      echo '<h1>FORMA ZA UNOS SADRŽAJA<br/>U BAZU PODATAKA</h1>
      <form enctype="multipart/form-data" method="POST" action="skripta.php">
        <label for="naslov" required>Naslov vijesti:</label>
        <input name="naslov" id="naslov" type="text" class="naslov" required/>
        <span id="porukaTitle" class="bojaPoruke"></span>
        <br/><br/>

        <label for="sazetak">Kratki sadržaj vijesti (do 100 znakova):</label>
        <br/>
        <span id="porukaAbout" class="bojaPoruke"></span>
        <textarea name="sazetak" id="sazetak" type="text" class="sazetak" required></textarea>
        <br/><br/>

        <label for="tekst">Sadržaj vijesti:</label>
        <br/>
        <span id="porukaContent" class="bojaPoruke"></span>
        <textarea name="tekst" id="tekst" required></textarea>
        <br/><br/>

        <label for="slika">Slika</label>
        <br/>
        <input name="slika" id="slika" type="file" class="slika" required/>
        <span id="porukaSlika" class="bojaPoruke"></span>
        <br/>

        <label for="kategorija" required>Kategorija vijesti:</label>

        <select name="kategorija" id="kategorija" class="kategorija" required>
          <option value="" disabled selected>Odaberite kategoriju</option>
          <option value="svijet">Svijet</option>
          <option value="ekonomija">Ekonomija</option>
        </select>
        <span id="porukaKategorija" class="bojaPoruke"></span>
        <br/><br/>

        <label for="arhiva">Spremiti u arhivu?</label>
        <input type="checkbox" name="arhiva" class="option" value="option">
        <br/>

        <input type="reset" class="button_no" value="Poništi" />
        <input name="submit" type="submit" class="button_yes" id="slanje" value="Pohrani" />
      </form>';
    }?>
    </div>
  </div>

  <footer>
    <div class="wrapper">
      <br/><p>Projektni zadatak iz kolegija <i>Programiranje Web Aplikacija</i></p>
      <br/><p>Autor projekta: <b>Mario Vidović</b><br/>mvidovic@tvz.hr</p>
			<br/><p>Godina izrade: 2021.</p>
    </div>
  </footer>

  <script src="check.js"></script>
</body>
</html>
