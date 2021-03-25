<?php
$sunucu = "localhost"; 
$kullanici = "root"; 
$parola = ""; 
$veritabani = "";
$baglanti = mysql_connect($sunucu, $kullanici, $parola); 

if(!$baglanti) die("MySQL sunucusuna baglanti saglanamadi!"); 

mysql_select_db($veritabani, $baglanti) or die ("Veritabanina baglanti saglanamadi!");
?>