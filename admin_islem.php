<?php
session_start();
ob_start();
if(!isset($_SESSION["yetki"]))
{
echo str_repeat("<br>", 8)."<center><img src=images/hata.gif border=0 /> Yönetim paneline sadece yetkililer girebilir!</center>";
header("Refresh: 2; url= anasayfa.php");
return;
}

$islem = $_GET["islem"];
$id = $_GET["id"];

include("baglanti.php");

$sorgula = mysql_query("SELECT * FROM uyeler WHERE id='".$id."'") or die (mysql_error());
$uyeler = mysql_fetch_array($sorgula);

if($islem=="sil")
{

$uye_sil = "DELETE FROM uyeler WHERE id='$id'";
$sil_sonuc = mysql_query($uye_sil);	
echo str_repeat("<br>",8)."<center><img src=images/ok.gif border=0 /> Üye Silindi.</center>";
header("Refresh: 1; url= admin.php");
return;
}

elseif($islem=="guncelle")
{

$g_id = $_GET["id"];
$g_isim = $_POST["isim"];
$g_soyisim = $_POST["soyisim"];
$g_kullanici_adi = $_POST["kullanici_adi"];
$g_parola = md5(md5($_POST["parola"]));
$g_eposta = $_POST["eposta"];
$g_yetki = $_POST["yetki"];
$g_button = $_POST["button"];


if($g_button){

if(!$_POST["parola"]=="")
{
$guncelle = mysql_query("Update uyeler Set isim='$g_isim',soyisim='$g_soyisim',kullanici_adi='$g_kullanici_adi', parola='$g_parola', eposta='$g_eposta', yetki='$g_yetki' Where id='$g_id'");
$_SESSION["parola"] = $g_parola;
setcookie("parola",$g_parola,time()+60*60*24);
}
else
{
$guncelle = mysql_query("Update uyeler Set isim='$g_isim',soyisim='$g_soyisim',kullanici_adi='$g_kullanici_adi', eposta='$g_eposta' , yetki='$g_yetki' Where id='$g_id'");
}
	if($guncelle)
	{
	
	echo str_repeat("<br>",8)."<center><img src=images/ok.gif border=0 /> Üye bilgileri güncellendi.</center>";

	header("Refresh: 1; url= admin.php");
	return;
	}
	else
	{

	echo "<center><img src=images/hata.gif border=0 /> Üye Bilgileri Güncellenemedi!</center>";

	header("Refresh: 2; url= admin.php");

	}

}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>(<?php echo $uyeler['isim']; ?> <?php echo $uyeler['soyisim']; ?>) Üye Bilgi Güncelle</title>
<link href="css/stil.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center><p><img src="images/uye.png" width="32" height="32" /></p>
<p><?php echo $uyeler['isim']; ?> <?php echo $uyeler['soyisim']; ?> <a href="admin.php">kişisini düzenlemeden çık</a></p></center>
<form name="guncelle" method="post" action="admin_islem.php?islem=guncelle&id=<?php echo $uyeler['id']; ?>">
<table align="center" width="400" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="114">İsim:</td>
    <td width="179"><input type="text" name="isim" value="<?php echo $uyeler['isim']; ?>" /></td>
  </tr>
  <tr>
    <td width="114">Soyisim:</td>
    <td width="179"><input type="text" name="soyisim" value="<?php echo $uyeler['soyisim']; ?>" /></td>
  </tr>
  <tr>
    <td width="114">Kullanıcı Adı:</td>
    <td width="179"><input type="text" name="kullanici_adi" value="<?php echo $uyeler['kullanici_adi']; ?>" /></td>
  </tr>
  <tr>
    <td>Şifre Değiştir:</td>
    <td><input type="password" name="parola" value=""  /></td>
  </tr>
  <tr>
    <td>E-Posta:</td>
    <td><input type="text" name="eposta" value="<?php echo $uyeler['eposta']; ?>"  /></td>
  </tr>
    <tr>
    <td>Yetki:</td>
    <td><select name="yetki">
	<?php if($uyeler['yetki'] =="0")
	echo "<option value=\"0\" selected=\"selected\" style=\"background-color:#FF9;\">Üye</option>
	<option value=\"1\">Yetkili</option>";
	elseif($uyeler['yetki'] =="1")
	echo "<option value=\"1\" selected=\"selected\" style=\"background-color:lightyellow;\">Yetkili</option>
	<option value=\"0\">Normal Üye</option>";
	?>

	</select></td>
  </tr>
  <tr>
    <td>Üyelik Tarihi:</td>
    <td>
	<?php echo $uyeler['tarih'];?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" value="<?php echo $uyeler['kullanici_adi']; ?>'yi Güncelle" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>

<?php 
mysql_close();
ob_end_flush();	
?>