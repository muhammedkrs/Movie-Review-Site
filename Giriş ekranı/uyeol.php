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
    $Ad = $_POST["Ad"];
    $Soyad = $_POST["Soyad"];
    $Email = $_POST["Email"];
    $Sifre = $_POST["Sifre"];
    $SifreTekrar = $_POST["SifreTekrar"];
    

    if (trim($Ad) === "") {
        echo "Ad yalnızca boşluklardan oluşamaz."; // Sadece boşluk tuşuyla boş geçilmesini engelle
        exit;
      }
     if (trim($Soyad) === "") {
      echo "Soyad yalnızca boşluklardan oluşamaz.";
      exit;
      }
      if (trim($Email) === "") {
        echo "E-posta  yalnızca boşluklardan oluşamaz.";
        exit;
      }
      if (trim($Sifre) === "") {
        echo " Şifre yalnızca boşluklardan oluşamaz.";
        exit;
      }
      if (trim($SifreTekrar) === "") {
        echo " Şifre Tekrar yalnızca boşluklardan oluşamaz.";
        exit;
      }
      if($Sifre!=$SifreTekrar)
    {
      echo"Şifre ile şifre tekrar aynı olmalıdır !";
      exit;
    }
      $sql = "SELECT * FROM uye_bilgileri WHERE Email = '$Email'";
      $result = $connect->query($sql);
      
      if ($result->num_rows > 0) {
          // E-posta adresi veritabanında zaten kayıtlıysa, login sayfasına yönlendir
         /* header("Location: login.php");*/
         echo"bu mail adresi zaten kayıtlı lütfen giriş yapın";
          exit();
      }
     else
      { header("Location:http://localhost/FilmYorumSitesi/Ana%20Sayfa/anasayfa.html");
        
      }
    }
    

  $Ad = htmlspecialchars($_POST['Ad']);
  $Soyad = htmlspecialchars($_POST['Soyad']);
  $Email= htmlspecialchars($_POST['Email']);
  $Sifre = htmlspecialchars($_POST['Sifre']);
  $SifreTekrar = htmlspecialchars($_POST['SifreTekrar']);

  $stmt = $connect->prepare("INSERT INTO uye_bilgileri (Ad, Soyad,  Email, Sifre,Tarih)
  VALUES (?, ?, ?, ?, NOW())");

  $stmt->bind_param("ssss", $Ad, $Soyad, $Email, $Sifre);

  if ($stmt->execute()) {
    echo "Kayıt başarıyla eklendi.<br>";
  } else {
    echo "Kayıt eklenirken hata oluştu.<br>";
  }
  echo $stmt->error;
  $stmt->close();
  $connect->close();
 
?>
