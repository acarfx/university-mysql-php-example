<?php
session_start();
ob_start();

if(!isset($_SESSION["giris"]))
{
echo str_repeat("<br>", 8)."<center><img src=images/hata.gif border=0 />Bu sayfayı görüntüleyebilmek için lütfen giriş yapmalısın.</center>";
header("Refresh: 2; url= index.php");
return;
}
include("baglanti.php");

$sorgula = mysql_query("SELECT * FROM uyeler WHERE kullanici_adi='".$_COOKIE["kullanici_adi"]."' and parola='".$_COOKIE["parola"]."'") or die (mysql_error());

$uyeler = mysql_fetch_array($sorgula);
if($uyeler['yetki']=="1")
{
$_SESSION["yetki"]="true";	
echo str_repeat("<br>", 8)."<center><img src=images/yukleniyor.gif border=0 /> Yetkili paneline yönlendiriliyorsunuz lütfen bekleyin....</center>";	
header("Refresh: 2; url= admin.php");
return;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>ACAR - Kontrol Paneli</title>
<link href="css/stil.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center><p><img src="images/uye.png" width="32" height="32" /><p>
<p>Hoşgeldin! <?php echo $uyeler['isim']; ?> <?php echo $uyeler['soyisim']; ?> <a href="cikis.php">( Çıkış Yap )</a></p>
<p>&nbsp;</p></center>
<form name="guncelle" method="post" action="anasayfa.php?id=<?php echo $uyeler['id']; ?>">
<table align="center" width="300" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="114">İsim:</td>
    <td width="179"><?php echo $uyeler['isim']; ?></td>
  </tr>
  <tr>
    <td width="114">Soyisim:</td>
    <td width="179"><?php echo $uyeler['soyisim']; ?></td>
  </tr>
  <tr>
    <td width="114">Kullanıcı Adı:</td>
    <td width="179"><?php echo $uyeler['kullanici_adi']; ?></td>
  </tr>
  <tr>
    <td>Şifre (Değiştir):</td>
    <td><input type="password" name="parola" value=""  /></td>
  </tr>
  <tr>
    <td>E-Posta:</td>
    <td><input type="text" name="eposta" value="<?php echo $uyeler['eposta']; ?>"  /></td>
  </tr>
  <tr>
    <td>Üyelik Tarihi:</td>
    <td>
	<?php echo $uyeler['tarih'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" value="Güncelle" /></td>
  </tr>
</table>
</form>
</body>
</html>
<?php 

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
$g_id = $_GET["id"];
$g_parola = md5(md5($_POST["parola"]));
$g_eposta = $_POST["eposta"];	
	

if(!$_POST["parola"]=="")
{
$guncelle = mysql_query("Update uyeler Set parola='$g_parola', eposta='$g_eposta' Where id='$g_id'");
$_SESSION["parola"] = $g_parola;
setcookie("parola",$g_parola,time()+60*60*24);
}
else
{
$guncelle = mysql_query("Update uyeler Set eposta='$g_eposta' Where id='$g_id'");
}
	if($guncelle)
	{
	
	echo "<center><img src=images/ok.gif border=0 /> Bilgileriniz Güncellendi.</center>";

	header("Refresh: 1; url= anasayfa.php");

	}
	else
	{

	echo "<center><img src=images/hata.gif border=0 /> Bilgileriniz güncellenmedi!</center>";

	header("Refresh: 2; url= anasayfa.php");

	}

}
mysql_close();
ob_end_flush();	
?>