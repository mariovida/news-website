<?php
  include 'connect.php';
  define('UPLPATH', 'img/');

  if ($dbc && isset($_POST['submit'])) {
    $datum = date('d.m.Y.');
    $vrijeme = date('H:i');
    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $slika = $_FILES['slika']['name'];
    $tempSlika = $_FILES['slika']['tmp_name'];
    if (isset($_POST['arhiva'])) {
      $arhiva = 1;
    } else {
      $arhiva = 0;
    }

    move_uploaded_file($_FILES['slika']['tmp_name'], __DIR__.'/img/'. $_FILES["slika"]['name']);
    
    $query = "INSERT INTO vijesti (datum, vrijeme, naslov, sazetak, tekst, slika, kategorija, arhiva) VALUES ('$datum', '$vrijeme', '$naslov', '$sazetak', '$tekst', '$slika', '$kategorija', '$arhiva')";

    $result = mysqli_query($dbc,$query) or die('Error querying database.');
    header('Location:unos.php');
  }

  mysqli_close($dbc);
?>
