<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Web Güvenlik Deneyleri</title>
    <style>
        body { font-family: sans-serif; background: #ecf0f1; padding: 30px; }
        .deney-karti { background: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        .kod-alani { background: #2c3e50; color: #ecf0f1; padding: 10px; border-radius: 5px; font-family: monospace; font-size: 13px; }
        .uyari { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body>

    <div class="deney-karti">
        <h2>HTML Engeli</h2>
        
        <form method="POST">
            <input type="text" name="test_metin" required minlength="10" placeholder="En az 10 karakter...">
            <button type="submit" name="deney1">Formu Gönder</button>
        </form>

        <?php
        if (isset($_POST['deney1'])) {
            echo "<div class='kod-alani'>PHP'ye Gelen Veri: '" . $_POST['test_metin'] . "' (Gönderildi!)</div>";
        }
        ?>
    </div>

    <div class="deney-karti">
        <h2>Fiyat Değiştirme</h2>
        
        <div style="border: 1px solid #ddd; padding: 10px; width: 200px; text-align: center;">
            <img src="https://images.unsplash.com/photo-1510557880182-3d4d3cba35a5?w=200" alt="phone" style="width: 100px;">
            <h4>iPhone 15 - 1000$</h4>
            <form method="POST">
                <input type="hidden" name="urun_id" value="123">
                <input type="hidden" name="fiyat" value="1000">
                <button type="submit" name="deney2">Satın Al</button>
            </form>
        </div>

        <?php
        if (isset($_POST['deney2'])) {
            echo "<div class='kod-alani'>Ödeme Alındı! Çekilen Tutar: " . $_POST['fiyat'] . "$</div>";
        }
        ?>
    </div>

    <div class="deney-karti">
        <h2>XSS (Script Çalıştırma)</h2>

        <p class="uyari"><code>&lt;script&gt;alert('HackedByIntern')&lt;/script&gt;</code></p>
        
        <form method="POST">
            <input type="text" name="kullanici_adi" placeholder="Adın nedir?">
            <button type="submit" name="deney3">Selamla</button>
        </form>

        <?php
        if (isset($_POST['deney3'])) {
            $isim = $_POST['kullanici_adi'];
            echo "<h3>Merhaba " . $isim . "</h3>";
        }
        ?>
    </div>

</body>
</html>
