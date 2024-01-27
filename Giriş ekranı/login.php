<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yorum_sitesi";

$connect = new mysqli($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("Bağlantı hatası: " . $connect->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST["Email"];
    $Sifre = $_POST["Sifre"];

    if (trim($Email) === "") {
        echo "E-posta  yalnızca boşluklardan oluşamaz.";
        exit;
      }
      if (trim($Sifre) === "") {
        echo " Şifre yalnızca boşluklardan oluşamaz.";
        exit;
      }
    }

$stmt = $connect->prepare("SELECT * FROM uye_bilgileri WHERE Email = ? AND Sifre = ?");
$stmt->bind_param("ss", $Email, $Sifre);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Kullanıcı doğrulandı, giriş işlemi başarılı
    header("Location:http://localhost/FilmYorumSitesi/Ana%20Sayfa/anasayfa.html");
} else {
    // Kullanıcı doğrulanamadı, giriş işlemi başarısız
    echo "Kullanıcı adı ya da şifre hatalı !";
}

$stmt->close();
$connect->close();


?>