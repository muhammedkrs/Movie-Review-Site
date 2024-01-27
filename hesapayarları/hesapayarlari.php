<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yorum_sitesi";

$connect = new mysqli($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Bağlantı hatası: " . $connect->connect_error);
}

$htmlsayfa="C:\\xampp\\htdocs\\FilmYorumSitesi\\Ana Sayfa\\steyle.css";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $Sifre = $_POST["Sifre"];
    $YeniSifre = $_POST["YeniSifre"];
    $YeniSifreTekrar = $_POST["YeniSifreTekrar"];

    if (trim($Email) === "") {
        echo "Email yalnızca boşluklardan oluşamaz."; // Sadece boşluk tuşuyla boş geçilmesini engelle
        exit;
      }
     if (trim($Sifre) === "") {
      echo "Şifre yalnızca boşluklardan oluşamaz.";
      exit;
      }
      if (trim($YeniSifre) === "") {
        echo "Yeni Şifre yalnızca boşluklardan oluşamaz.";
        exit;
      }
      if (trim($YeniSifreTekrar) === "") {
        echo " Yeni Şifre Tekrar yalnızca boşluklardan oluşamaz.";
        exit;
      }
     
    $sorgu = $connect->prepare("SELECT Email, Sifre FROM uye_bilgileri WHERE Email = ?");
    $sorgu->bind_param("s", $Email);
    $sorgu->execute();
    $sorgu->store_result();

    if ($sorgu->num_rows > 0) {
        $sorgu->bind_result($kullaniciEposta, $kullaniciSifre);
        $sorgu->fetch();

        if ($Sifre == $kullaniciSifre) {
            // E-posta adresi ve mevcut şifre eşleşiyor, güncelleme işlemi yapılabilir
            if ($YeniSifre == $YeniSifreTekrar) {
                // Yeni şifre ve tekrarı eşleşiyor, güncelleme işlemi başarılı olacak
                $guncelle = $connect->prepare("UPDATE uye_bilgileri SET Sifre = ? WHERE Email = ?");
                $guncelle->bind_param("ss", $YeniSifre, $Email);
                if ($guncelle->execute()) {
                    header("Location: http://localhost/FilmYorumSitesi/Ana%20Sayfa/anasayfa.html");
                } else {
                    echo "Şifre güncelleme işlemi başarısız. Hata: " . $guncelle->error . "<br>";
                }
            } else {
                // Yeni şifre ve tekrarı eşleşmiyor, hata mesajı gösterilecek
                echo "Yeni şifre ve tekrarı eşleşmiyor. Şifre güncelleme işlemi başarısız.<br>";
            }
        } else {
            // E-posta adresi veya mevcut şifre eşleşmiyor, hata mesajı gösterilecek
            echo "E-posta adresi veya mevcut şifre eşleşmiyor. Şifre güncelleme işlemi başarısız.<br>";
        }
    } else {
        // Kullanıcı bulunamadı, hata mesajı gösterilecek
        echo "Kullanıcı bulunamadı. Şifre güncelleme işlemi başarısız.<br>";
    }
    

    $sorgu->close();
}
?>