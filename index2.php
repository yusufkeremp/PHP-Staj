<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PHP Hesap Makinesi</title>
    <link rel="stylesheet" href="stylecalc.css">
</head>
<body>
    
    <?php
    $ekran_verisi = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mevcut_veri = isset($_POST['ekran_verisi']) ? $_POST['ekran_verisi'] : "";
        $tus = isset($_POST['tus']) ? $_POST['tus'] : "";

        if ($tus == "C") {
            $ekran_verisi = "";
        } elseif ($tus == "=") {
            if (preg_match('/^[0-9+\-*\/.\s]+$/', $mevcut_veri)) {
                try {
                    $kontrol = @eval("\$sonuc = $mevcut_veri;");
                    if ($kontrol === false && error_get_last()) {
                        $ekran_verisi = "Hata";
                    } else {
                        $ekran_verisi = $sonuc;
                    }
                } catch (Throwable $t) {
                    $ekran_verisi = "Hata";
                }
            } else {
                $ekran_verisi = "Gecersiz";
            }
        } else {
            $ekran_verisi = $mevcut_veri . $tus;
        }
    }
    ?>

    <div class="hesap-makinesi">
        <form method="post">
            <input type="text" class="ekran" name="ekran_verisi" value="<?php echo htmlspecialchars($ekran_verisi); ?>" readonly>
            
            <div class="tus-takimi">

                <button type="submit" name="tus" value="C" class="tus temizle">C</button>
                <button type="submit" name="tus" value="/" class="tus islem">/</button>
                <button type="submit" name="tus" value="*" class="tus islem">*</button>
                <button type="submit" name="tus" value="-" class="tus islem">-</button>
                
                <button type="submit" name="tus" value="7" class="tus">7</button>
                <button type="submit" name="tus" value="8" class="tus">8</button>
                <button type="submit" name="tus" value="9" class="tus">9</button>
                <button type="submit" name="tus" value="+" class="tus islem" style="grid-row: span 2;">+</button>

                <button type="submit" name="tus" value="4" class="tus">4</button>
                <button type="submit" name="tus" value="5" class="tus">5</button>
                <button type="submit" name="tus" value="6" class="tus">6</button>

                <button type="submit" name="tus" value="1" class="tus">1</button>
                <button type="submit" name="tus" value="2" class="tus">2</button>
                <button type="submit" name="tus" value="3" class="tus">3</button>
                <button type="submit" name="tus" value="=" class="tus esittir">=</button>
                
                <button type="submit" name="tus" value="0" class="tus" style="grid-column: span 2;">0</button>
                <button type="submit" name="tus" value="." class="tus">.</button>
            </div>
        </form>
    </div>

</body>
</html>
