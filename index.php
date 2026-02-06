<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Basit Hesap Makinesi</title>
    <link rel="stylesheet" href="syle.css">
</head>
<body>
  <div class="assa"> 

    <h3>Basit Hesap Makinesi</h3>
    

    <form method="post">
        <input type="number" name="sayi1" placeholder="1. Sayı" required step="any">
        
        <select name="islem" select class="is">
            <option value="topla">Topla (+)</option>
            <option value="cikar">Çıkar (-)</option>
            <option value="carp">Çarp (*)</option>
            <option value="bol">Böl (/)</option>
        </select>

        <input type="number" name="sayi2" placeholder="2. Sayı" required step="any">
        
        <button type="submit" name="hesapla">Hesapla</button>
    </form>
</div>
    

    <br>
    <hr>

    <?php

    if (isset($_POST['hesapla'])) {
        $s1 = $_POST['sayi1'];
        $s2 = $_POST['sayi2'];
        $islem = $_POST['islem'];
        $sonuc = "";

        if ($islem == "topla") {
            $sonuc = $s1 + $s2;
        } elseif ($islem == "cikar") {
            $sonuc = $s1 - $s2;
        } elseif ($islem == "carp") {
            $sonuc = $s1 * $s2;
        } elseif ($islem == "bol") {
            if ($s2 != 0) {
                $sonuc = $s1 / $s2;
            } else {
                $sonuc = "Tanımsız (Sıfıra bölünemez)";
            }
        }
        echo "<b>Sonuç: $sonuc</b>";
    }
    ?>

</body>

</html>
