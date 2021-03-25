<?php
ob_start();
session_start();
session_destroy();

setcookie ("kullanici_adi", "", time() - 3600);
setcookie ("parola", "", time() - 3600);

echo str_repeat("<br>", 8)."<center><img src=images/yukleniyor.gif border=0 /> Çıkış işlemi yapıldı anasayfaya yönlendiriliyorsun.</center>";
header("Refresh: 2; url=index.php");
ob_end_flush();
?>