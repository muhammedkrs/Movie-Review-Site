<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yorum_sitesi";

$connect = new mysqli($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Bağlantı hatası: " . $connect->connect_error);
}

$yorum = $_POST['yorum']; // Kullanıcının girdiği yorum

// Ad ve Soyad bilgilerini sorgulama
$sorgu = $connect->prepare("SELECT uye_bilgileri.Ad, uye_bilgileri.Soyad, yorumlar.yorum, filmler.filmAd
FROM yorumlar
INNER JOIN uye_bilgileri ON yorumlar.uyeid = uye_bilgileri.ID
INNER JOIN filmler ON yorumlar.filmid = filmler.filmid
WHERE uye_bilgileri.Ad = ?");
$sorgu->bind_param("s", $uyeAdi); // $uyeAdi, yorumu yapan üyenin adını içerir
$uyeAdi = "Belirli Üye Adı";
$sorgu->execute();
$sorgu->bind_result($ad, $soyad, $yorum, $filmAd);
$sorgu->fetch();

// Yorumu kaydetme
$ekle = $connect->prepare("INSERT INTO yorumlar (yorum, filmid, uyeid)
SELECT ?, filmler.filmid, uye_bilgileri.ID
FROM filmler, uye_bilgileri
WHERE filmler.filmAd = 'sahsiyet' AND uye_bilgileri.Ad = ?");
$ekle->bind_param("ss", $yorum, $uyeAdi);
$ekle->execute();

if ($ekle->affected_rows > 0) {
    echo "Kayıt başarıyla eklendi.<br>";
} else {
    echo "Kayıt eklenirken hata oluştu.<br>";
}

$ekle->close();
$sorgu->close();
$connect->close();
?>